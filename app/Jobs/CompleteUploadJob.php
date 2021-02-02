<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;
use App\Models\Media;
use Illuminate\Support\Facades\Log;

class CompleteUploadJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $post = Post::find($this->id);
        $medias = $post->medias->filter(function($media, $key){
            return $media->url==null;
        });
        if($medias->count()){
            // Log::channel('nmiTrack')->info("---- logging----".$medias->count());
        }else{
            $post->status = 1;
            $post->save();
        }
    }
}
