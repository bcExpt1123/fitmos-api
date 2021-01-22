<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Jobs\CompleteUploadJob;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = ['customer_id','content','activity_id','location','tag_followers'];
    protected $lastId;
    protected $casts = [
        'tag_followers' => 'array',
        'json_content' => 'array',
    ];
    //   (\@\{\$([^$]+)\$\}\(([0-9]+)\))
    //   \@\[(\w.+\w)\]\(([0-9]*)\) 
    public static function validateRules($id=null){
        return array(
            'content'=>'max:5000',
            'medias'=>'array|max:50',
            'medias.*'=>'image|max:209715200, mimetypes:mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:209715200',
            'tag_followers'=>'array|max:191',
            'location'=>'max:191',
        );
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function medias()
    {
        return $this->hasMany('App\Models\Media', 'post_id');
    }
    public function uploadMedias($files){
        foreach($files as $file){
            $media = new Media;
            $media->post_id = $this->id;
            $media->uploadSingle($file);
        }
        CompleteUploadJob::dispatch($this->id);
    }
    public function assignFrontSearch($request){
        $this->customer_id = $request->customer_id;
        if($request->post_id)$this->lastId = $request->post_id;
    }
    public function search(){
        $where = self::with(['customer','medias'])->whereStatus(1);
        if($this->lastId)$where->where('id','<',$this->lastId);
        $where->whereCustomerId($this->customer_id);
        $posts =  $where->orderBy('id','desc')->limit(3)->get();
        foreach($posts as $index=>$post){
            $post->extend();
        }
        return $posts;
    }
    public function extend(){
        $tagFollowers = [];
        if($this->customer){
            $this->customer->getAvatar();
        }
        if(is_array($this->tag_followers)){
            foreach($this->tag_followers as $customerId){
                $customer = \App\Customer::find($customerId);
                $customer->getSocialDetails();
                $tagFollowers[] = $customer;
            }
        }
        if(is_array($this->json_content)){
            $contentFollowers = [];
            foreach($this->json_content as $index=>$line){
                foreach($line['ids'] as $customerId){
                    $customer = \App\Customer::find($customerId);
                    $customer->getSocialDetails();
                    $contentFollowers[] = $customer;
                }
            }
            $this->contentFollowers = $contentFollowers;
        }
        $this->tagFollowers = $tagFollowers;
        $this->medias;
    }
}
