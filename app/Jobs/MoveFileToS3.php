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
        $result = Storage::disk('s3')->putFileAs(
            '/',
            new File(storage_path('app/' . $this->filename)),
            $media->src
        );
        $media->url = \Storage::disk('s3')->url($result);
        $media->save();
        // Forces collection of any existing garbage cycles
        // If we don't add this, in some cases the file remains locked
        gc_collect_cycles();

        if ($result == false) {
            throw new Exception("Couldn't upload file to S3");
        }
        // if(unlink(storage_path('app/' . $this->filename))){
        //     throw new Exception('File could not be deleted from the local filesystem '.storage_path('app/' . $this->filename));
        // }
        // delete file from local filesystem
        Storage::disk('local')->delete($this->filename);
        
    }
}
