<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\File;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\Media;

class MoveFileToS3 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $filename;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $filename)
    {
        $this->filename = $filename;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Upload file to S3
        // $path = $image->storeAs('', #$path
        // $this->src, #$fileName
        // ['disk'=>'s3', 'visibility'=>'public']);
        // $this->url = \Storage::disk('s3')->url($path);
        $media = Media::find($this->id);
        $file = new File(storage_path('app/' . $this->filename));
        $result = Storage::disk('s3')->putFileAs(
            '/',
            $file,
            $media->src
        );
        $cdnWebsite = "https://s3.fitemos.com/";
        if (App::environment('local')) {
            $cdnWebsite = "https://devs3.fitemos.com/";
        }        
        if (App::environment('staging')) {
            $cdnWebsite = "https://s3.fitemos.com/";
        }        
        $media->url = $cdnWebsite.$media->src;
        $media->save();
        // Forces collection of any existing garbage cycles
        // If we don't add this, in some cases the file remains locked
        gc_collect_cycles();
        if($media->type=='image')$this->resizeImage($file, $media->src);

        if ($result == false) {
            throw new Exception("Couldn't upload file to S3");
        }
        // if(unlink(storage_path('app/' . $this->filename))){
        //     throw new Exception('File could not be deleted from the local filesystem '.storage_path('app/' . $this->filename));
        // }
        // delete file from local filesystem
        Storage::disk('local')->delete($this->filename);
        
    }
    public function resizeImage($image, $src)
    {   
        $sizes = \App\Setting::convertSizes();
        $fileExtension = $image->extension();
        $src = substr($src,0,strlen($src)-strlen($fileExtension) -1 );
        for($i = 0; $i < count($sizes); $i++) {
            $size = $sizes[$i];
            $resizeImg = Image::make($image);
            if($size[0]==$size[1]){
                $height = $resizeImg->height();
                $width = $resizeImg->width();
                if($width > $height) {
                    $cropStartPointX = round(($width - $height) / 2);
                    $cropStartPointY = 0;
                    $cropWidth = $height;
                    $cropHeight = $height;
                }
                else {
                    $cropStartPointX = 0;
                    $cropStartPointY = round(($height - $width) / 2);
                    $cropWidth = $width;
                    $cropHeight = $width;
                }
            }
            else{
                if($size[0] > $size[1]){
                    $height = $resizeImg->height();
                    $width = $resizeImg->width();
                    if($width > $height) {
                        $sizeRate = $size[0]/$size[1];
                        $cropStartPointX = round(($width - ($height*$sizeRate)) / 2);
                        $cropStartPointY = 0;
                        $cropWidth = round($height*$sizeRate);
                        $cropHeight = $height;
                    }
                    else {
                        $sizeRate = $size[1]/$size[0];
                        $cropStartPointX = 0;
                        $cropStartPointY = round(($height - ($width*$sizeRate)) / 2);
                        $cropWidth = $width;
                        $cropHeight = round($width*$sizeRate);
                    }
                }
            }
            
            $resizeImg->crop($cropWidth, $cropHeight, $cropStartPointX, $cropStartPointY)
            ->resize($size[0], $size[1], function($constraint) {
                $constraint->aspectRatio();
            })->encode($fileExtension);
            $len = strlen($fileExtension);
            $resizeImg->save('storage/app/files/'. $this->id . '-' . $size[0] . 'X' . $size[1] . '.' . $fileExtension);
            $result = Storage::disk('s3')->putFileAs(
                '/',
                new File(storage_path('app/files/' . $this->id . '-' . $size[0] . 'X' . $size[1] . '.' . $fileExtension)),
                $src . '-' . $size[0] . 'X' . $size[1] . '.' . $fileExtension
            );            
            Storage::disk('local')->delete('files/'.$this->id . '-' . $size[0] . 'X' . $size[1] . '.' . $fileExtension);
        }
    }
}
