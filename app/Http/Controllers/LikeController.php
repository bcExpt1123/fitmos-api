<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Like;
use App\Customer;
use Illuminate\Support\Facades\Storage;

class LikeController extends Controller
{
    public function store(Request $request){
        $user = $request->user();
        if(!$request->exists('activity_id')){
            return response()->json(array('status'=>'failed'),422);
        }
        $post = Post::whereActivityId($request->activity_id)->first();
        if($post && $post->customer_id == $user->customer->id){
            return response()->json(array('status'=>'you made activity'),423);
        }
        $comment = Comment::whereActivityId($request->activity_id)->first();
        if($comment && $comment->customer_id == $user->customer->id){
            return response()->json(array('status'=>'you made activity'),423);
        }
        $like = Like::whereActivityId($request->activity_id)->whereCustomerId($user->customer->id)->first();
        if($like){
            return response()->json(array('status'=>'already exists'),421);
        }
        $like = new Like;
        $like->activity_id = $request->activity_id;
        $like->customer_id = $user->customer->id;
        $like->save();
        $like->activity->updateLikes();
        return response()->json([
            'like'=>$like]
            );        
        
    }
    public function destroy($id,Request $request){
        $user = $request->user();
        $activity = Activity::find($id);
        $like = Like::whereActivityId($id)->whereCustomerId($user->customer->id)->first();
        if($like){
            $like->delete();
            $activity->updateLikes();
            return response()->json([
                'activity'=>$activity
                ]);
        }
        $data=[
            'status'=>'0',
            'msg'=>'fail'
        ];
        return response()->json($data,403);
    }
}