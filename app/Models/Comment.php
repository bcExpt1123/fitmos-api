<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $type;
    protected $fillable = ['customer_id','post_id','activity_id','parent_activity_id','level0','level1','content'];
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id');
    }
    public function activity()
    {
        return $this->belongsTo('App\Models\Activity', 'activity_id');
    }
    public function post()
    {
        return $this->belongsTo('App\Models\Post', 'post_id');
    }
    public function assignFrontSearch($request){
        $this->post_id = $request->post_id;
        $this->level0 = $request->level0;
        $this->level1 = $request->level1;
        $this->type = $request->type;
    }
    public function search(){
        $where = self::with(['customer'])->wherePostId($this->post_id);
        switch($this->type){
            case "appendNext":
                $where->where(function($query){
                    $query->where('level0','>',$this->level0);
                    $query->orWhere(function($q){
                        $q->where('level0','=',$this->level0);
                        $q->where('level1','>',$this->level1);
                    });
                });
                $where->orderBy('level0')->orderBy('level1');
                break;
            case "append":
                $where->where(function($query){
                    $query->where('level0','<',$this->level0);
                    $query->orWhere(function($q){
                        $q->where('level0','=',$this->level0);
                        $q->where('level1','<',$this->level1);
                    });
                });
                $where->orderBy('level0','desc')->orderBy('level1','desc')->limit(10);
                break;
            }
        $comments = $where->get();
        foreach($comments as $comment){
            $comment->customer->getAvatar();
        }
        return $comments;
    }
    public static function findByCondition($condition,$user){
        $previousComments = Comment::wherePostId($condition['id'])->where(function($query) use ($condition){
            $query->where('level0','<',$condition['minLevel0']);
            $query->orWhere(function($q) use ($condition){
                $q->where('level0','=',$condition['minLevel0']);
                $q->where('level1','<',$condition['minLevel1']);
            });
        })->get();
        $viewComments = Comment::wherePostId($condition['id'])->where(function($query) use ($condition){
            $query->where('level0','>',$condition['minLevel0']);
            $query->orWhere(function($q) use ($condition){
                $q->where('level0','=',$condition['minLevel0']);
                $q->where('level1','>=',$condition['minLevel1']);
            });
        })->where(function($query) use ($condition){
            $query->where('level0','<',$condition['maxLevel0']);
            $query->orWhere(function($q) use ($condition){
                $q->where('level0','=',$condition['maxLevel0']);
                $q->where('level1','<=',$condition['maxLevel1']);
            });
        })->get();
        foreach($viewComments as $index=>$comment){
            $comment->customer->getAvatar();
            $likes = Like::whereActivityId($comment->activity_id)->get();
            $comment->likesCount = $likes->count();
            $comment->like=false;
            if(isset($user->customer)){
                $like = Like::whereActivityId($comment->activity_id)->whereCustomerId($user->customer->id)->first();
                $comment->like = $like?true:false;    
            }
        }    
        $nextComments = Comment::wherePostId($condition['id'])->where(function($query) use ($condition){
            $query->where('level0','>',$condition['maxLevel0']);
            $query->orWhere(function($q) use ($condition){
                $q->where('level0','=',$condition['maxLevel0']);
                $q->where('level1','>',$condition['maxLevel1']);
            });
        })->get();
        return [$previousComments, $viewComments, $nextComments];
    }
}
