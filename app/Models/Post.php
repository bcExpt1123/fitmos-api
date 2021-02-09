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
    public function readingCustomers(){
        return $this->belongsToMany('App\Customer','reading_posts','post_id','customer_id')->wherePivot('status','completed');
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
    public function search($user=null){
        $where = self::with(['customer','medias'])->whereStatus(1);
        if($this->lastId)$where->where('id','<',$this->lastId);
        $where->whereCustomerId($this->customer_id);
        $posts =  $where->orderBy('id','desc')->limit(3)->get();
        foreach($posts as $index=>$post){
            $post->extend(null,$user);
        }
        return $posts;
    }
    public function extend($condition=null, $user=null){
        $tagFollowers = [];
        if($this->customer){
            $this->customer->getAvatar();
            if($user)$this->customer->getSocialDetails($user->customer->id);
        }
        if(is_array($this->tag_followers)){
            foreach($this->tag_followers as $customerId){
                $customer = \App\Customer::find($customerId);
                $tagFollowers[] = $customer;
            }
        }
        if(is_array($this->json_content)){
            $contentFollowers = [];
            foreach($this->json_content as $index=>$line){
                foreach($line['ids'] as $customerId){
                    $customer = \App\Customer::find($customerId);
                    $contentFollowers[] = $customer;
                }
            }
            $this->contentFollowers = $contentFollowers;
        }
        $this->tagFollowers = $tagFollowers;
        $this->medias;
        if($condition && $condition['from_id']>-1){
            list($previousComments, $viewComments, $nextComments) = Comment::findByCondition($condition, $user);
            $this->previousCommentsCount = $previousComments->count();
            $this->comments = $viewComments;//->get()->toArray();
            $this->nextCommentsCount = $nextComments->count();
        }else{
            if($condition&&isset($condition['count'])&&$condition['count']==-1){
                $this->previousCommentsCount = 0;
                $viewComments = Comment::wherePostId($this->id)->where('level1', 0)->orderBy('level0')->get();
                foreach($viewComments as $index=>$comment){
                    $comment->customer->getAvatar();
                    $likes = Like::whereActivityId($comment->activity_id)->get();
                    $comment->likesCount = $likes->count();
                    $comment->like=false;
                    $comment->extends();
                    if(isset($user->customer)){
                        $comment->getLike($user);
                    }
                }                    
                $this->comments = $viewComments;//->get()->toArray();
            }else{
                $latestComment = Comment::with('customer')->wherePostId($this->id)->where('level1',0)->orderBy('level0','desc')->first();
                if($latestComment){
                    $comments = Comment::wherePostId($this->id)->where('level1',0)->get();
                    // $replyComments = Comment::whereParentActivityId($latestComment->activity_id)->orderBy('id')->get();
                    // $this->comments = $replyComments->prepend($latestComment);
                    $latestComment->customer->getAvatar();
                    $likes = Like::whereActivityId($latestComment->activity_id)->get();
                    $latestComment->likesCount = $likes->count();
                    $latestComment->like=false;
                    $latestComment->extends();
                    if(isset($user->customer)){
                        $like = Like::whereActivityId($latestComment->activity_id)->whereCustomerId($user->customer->id)->first();
                        $latestComment->like = $like?true:false;    
                    }
                    $this->comments = [$latestComment];
                    $this->previousCommentsCount = $comments->count()-1;
                }else{
                    $this->comments = [];
                    $this->previousCommentsCount = 0;
                }
            }
            $this->nextCommentsCount = 0;
        }
        $this->commentsCount = Comment::wherePostId($this->id)->count();
        $likes = Like::whereActivityId($this->activity_id)->get();
        $this->likesCount = $likes->count();
        if($user && $user->customer){
            $like = Like::whereActivityId($this->activity_id)->whereCustomerId($user->customer->id)->first();
            $this->like = $like?true:false;
        }
    }
}
