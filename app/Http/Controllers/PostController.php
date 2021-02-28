<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Activity;
use App\Models\Post;
use App\Customer;
use App\Models\Media;
use App\Jobs\DeleteAsyncPost;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        $post = new Post;
        $indexData = null;            
        $profile = false;
        if($user->customer){
            $profile = $user->customer->findCustomerProfile($request);
            if($profile){
                $post->assignFrontSearch($request);
                $indexData = $post->search($user);
            }
        }
        return response()->json(array('status'=>'ok','posts'=>$indexData,'customerProfile'=>$profile));
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), Post::validateRules());
        $user = $request->user();
        try {
            \DB::beginTransaction();
            $activity = new Activity;
            $activity->save();
            $post = new Post;
            $post->fill(['activity_id'=>$activity->id,'customer_id'=>$user->customer->id,'content'=>$request->content,'location'=>$request->location,'tag_followers'=>json_decode($request->tag_followers)]);
            if($request->exists('workout_date')){
                $post->workout_date = $request->workout_date;
                $post->type = 'workout';
            }
            $post->save();
            if(isset($request->medias)){
                $post->uploadMedias($request->medias);
            }else{
                Post::withoutEvents(function () use ($post) {
                    $post->status = 1;
                    $post->save();
                });
            }
            \DB::commit();
            return response()->json(array('status'=>'ok','post'=>$post));
        
        } catch (Throwable $e) {
            \DB::rollback();
            return response()->json(array('status'=>'failed'));
        }
        
    }
    public function destroy($id,Request $request){
        $post = Post::find($id);
        if($post){
            $post->status = 0;
            $post->save();
            DeleteAsyncPost::dispatch($id);
        }
        if ($post){
            $data=[
                'status'=>'1',
                'msg'=>'success'
            ];
        }else{
            $data=[
                'status'=>'0',
                'msg'=>'fail'
            ];
        }        
        return response()->json($data);
        
    }
    public function show($id,Request $request){
        $user = $request->user();
        $post = Post::find($id);
        $condition = null;
        if($request->comment == 1){
            $condition = ['from_id'=>-1,'count'=>-1];
        }
        $post->extend($condition, $user);
        return response()->json($post);    
    }
    public function update($id,Request $request)
    {
        $post = Post::find($id);
        $validator = Validator::make($request->all(), Post::validateRules());
        $user = $request->user();
        try {
            \DB::beginTransaction();
            $oldMedias = $post->medias;
            $post->fill(['content'=>$request->content,'location'=>$request->location,'tag_followers'=>json_decode($request->tag_followers)]);
            $post->save();
            if(isset($request->media_ids)){
                $mediaIds = $request->media_ids;
                foreach($mediaIds as $mediaId){
                    $oldMedias = $oldMedias->reject(function($media,$key) use ( $mediaId ){
                        return $media->id == $mediaId;
                    });
                }
            }
            if($oldMedias&&$oldMedias->count()){
                $oldMedias->each(function($media){
                    Storage::disk('s3')->delete($media->src);
                    $media->delete();
                });
            }            
            if(isset($request->medias)){
                $post->uploadMedias($request->medias);
            }
            \DB::commit();
            return response()->json(array('status'=>'ok','post'=>$post));
        
        } catch (Throwable $e) {
            \DB::rollback();
            return response()->json(array('status'=>'failed'));
        }
    }
    public function subNewsfeed(Request $request){
        $user = $request->user();
        if($user->customer){
            $posts = Post::with('customer')->whereIn('id',$request->ids)->get();
            $result = [];
            foreach($posts as $post){
                $post->extend(null, $user);
                array_push($result, $post);
            }
            return response()->json(['items'=>$result]);
        }
        return response()->json(['status'=>'failed'], 401);
    }
    public function randomMedias($customerId,Request $request){
        $user = $request->user();
        if($user->customer){
            // DB::enableQueryLog();
            $self = null;            
            $other = null;            
            $profile = false;
            if($user->customer){
                $profile = $user->customer->findCustomerProfile($request);
                if($profile){
                    $self = Media::whereHas('post',function($query) use ($customerId){
                        $query->whereStatus(1)
                              ->whereCustomerId($customerId);
                    })->inRandomOrder()->limit(6)->get();
                    // dd(DB::getQueryLog());            
                    $other = Media::whereHas('post',function($query) use ($customerId){
                        $query->whereStatus(1)
                              ->where('customer_id','!=',$customerId);
                    })->inRandomOrder()->limit(12)->get();
                }
            }    
            return response()->json(['self'=>$self,'other'=>$other]);
        }
        return response()->json(['status'=>'failed'], 401);
    }
    public function medias(Request $request){
        $user = $request->user();
        if($user->customer){
            $profile = $user->customer->findCustomerProfile($request);
            $medias = null;
            if($profile){
                $customerId = $request->customer_id;
                // DB::enableQueryLog();
                $where = Media::whereHas('post',function($query) use ($customerId){
                    $query->whereStatus(1)
                          ->whereCustomerId($customerId);
                });
                if($request->media_id>0){
                    $where = $where->where('id','<',$request->media_id);
                }
                $medias = $where->orderBy('id','desc')->limit(20)->get();
            }

            // dd(DB::getQueryLog());            
            return response()->json(['medias'=>$medias]);
        }
        return response()->json(['status'=>'failed'], 401);
    }
    public function read($id,Request $request){
        $user = $request->user();
        $post = Post::find($id);
        // if($post->customer_id != $user->customer->id){
            $reading = DB::table('reading_posts')->where('post_id',$id)->where('customer_id',$user->customer->id)->first();
            if(!$reading){
                DB::table('reading_posts')->insert([
                    'post_id' => $id,
                    'customer_id' => $user->customer->id,
                    "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);        
            }
        // }
        return response()->json(['status'=>'ok']);
    }
    public function sync(Request $request){
        $ids = [];
        $conditions = [];
        foreach($request->ids as $item){
            $ids[] = $item['id'];
            $conditions[$item['id']] = $item;
        }
        $posts = Post::whereIn('id',$ids)->orderBy('id','desc')->get();
        foreach($posts as $post){
            $post->extend($conditions[$post->id], $request->user());
        }
        return response()->json(['posts'=>$posts]);
    }
}

