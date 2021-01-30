<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Comment;
use App\Models\Post;
use App\Customer;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    public function index(Request $request){
        $comment = new Comment;
        $comment->assignFrontSearch($request);    
        $comments = $comment->search();
        return response()->json(['comments'=>$comments]);
    }
    public function store(Request $request){
        $user = $request->user();
        try {
            \DB::beginTransaction();
            $activity = new Activity;
            $activity->save();
            if($request->exists("parent_activity_id")){
                $comment = Comment::whereActivityId($request->parent_activity_id)->first();
                if($comment){
                    if($comment->level1 == 0){
                        $parentActivityId = $comment->activity_id;
                        $maxlevel = $comment->level0;
                    }else{
                        $comment = Comment::whereActivityId($comment->parent_activity_id)->first();
                        $parentActivityId = $comment->activity_id;
                        $maxlevel = $comment->level0;
                    }
                    $maxlevel1 = DB::table("comments")->where('parent_activity_id',$parentActivityId)->max('level1');
                    if($maxlevel == null)$maxlevel = 0;
                    $maxlevel1++;
                }else{
                    throw new \Exception('There is no comment.');
                }
            }else{
                $maxlevel = DB::table("comments")->where('post_id',$request->post_id)->max('level0');
                if($maxlevel == null)$maxlevel = 0;
                $post = Post::find($request->post_id);
                $parentActivityId = $post->activity_id;
                $maxlevel++;
                $maxlevel1 = 0;
            }
            $comment = Comment::create([
                'activity_id'=>$activity->id,
                'customer_id'=>$user->customer->id,
                'content'=>$request->content,
                'post_id'=>$request->post_id,
                'parent_activity_id'=>$parentActivityId,
                'level0'=>$maxlevel,
                'level1'=>$maxlevel1,
                ]);
            $comment->save();
            Post::withoutEvents(function () use ($comment) {
                $comment->post->touch();
            });
            \DB::commit();
            $comment->customer->getAvatar();
            $nextCommentsCount = 0;
            $comments = [];
            $previousCommentsCount = 0;
            if($request->condition && $request->condition['maxLevel0']>-1){
                list($previousComments, $viewComments, $nextComments) = Comment::findByCondition($request->condition, $user);
                $previousCommentsCount = $previousComments->count();
                $comments = $viewComments;//->get()->toArray();
                $nextCommentsCount = $nextComments->count();
            }        
            return response()->json([
                'comment'=>$comment,
                'previousCommentsCount'=>$previousCommentsCount,
                'comments'=>$comments,
                'nextCommentsCount'=>$nextCommentsCount]
                );        
        } catch (Throwable $e) {
            \DB::rollback();
            return response()->json(array('status'=>'failed'));
        }
        
    }
    public function destroy($id,Request $request){
        $user = $request->user();
        $comment = Comment::find($id);
        if($comment && $comment->customer_id == $user->customer->id){
            $post = $comment->post;
            if($comment->level1>0){
                $comment->activity->delete();
                $comment->delete();
            }else{
                $comments = Comment::whereLevel0($comment->level0)->get();
                foreach($comments as $item){
                    $item->activity->delete();
                }
                Comment::whereLevel0($comment->level0)->delete();
            }
            Post::withoutEvents(function () use ($post) {
                $post->touch();
            });
            $data=[
                'status'=>'1',
                'msg'=>'success'
            ];
            $nextCommentsCount = 0;
            $comments = [];
            $previousCommentsCount = 0;
            if($request->condition && $request->condition['maxLevel0']>-1){
                list($previousComments, $viewComments, $nextComments) = Comment::findByCondition($request->condition, $user);
                $previousCommentsCount = $previousComments->count();
                $comments = $viewComments;//->get()->toArray();
                $nextCommentsCount = $nextComments->count();
            }        
            return response()->json([
                'previousCommentsCount'=>$previousCommentsCount,
                'comments'=>$comments,
                'nextCommentsCount'=>$nextCommentsCount]
                );
            }
        $data=[
            'status'=>'0',
            'msg'=>'fail'
        ];
        return response()->json($data,403);
    }
    public function show($id,Request $request){
        $comment = Comment::find($id);
        $comment->extend();
        return response()->json($comment);    
    }
    public function update($id,Request $request)
    {
        $comment = Comment::find($id);
        $user = $request->user();
        if($user->customer->id != $comment->customer_id)return response()->json(['status'=>'failed'],403);
        try {
            \DB::beginTransaction();
            $comment->fill(['content'=>$request->content]);
            $comment->save();
            \DB::commit();
            Post::withoutEvents(function () use ($comment) {
                $comment->post->touch();
            });
            $comment->post->touch();
            $comment->customer->getAvatar();
            return response()->json(array('status'=>'ok','comment'=>$comment));
        
        } catch (Throwable $e) {
            \DB::rollback();
            return response()->json(array('status'=>'failed'));
        }
    }

}