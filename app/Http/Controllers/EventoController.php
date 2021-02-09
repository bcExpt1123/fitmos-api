<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Evento;

class EventoController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            $validator = Validator::make($request->all(), Evento::validateRules());
            if ($validator->fails()) {
                return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
            }
            $evento = new Evento;
            $evento->fill($request->input());
            $evento->save();
            if(isset($request->images)){
                $evento->uploadMedias($request->images);
                $evento->save();
            }
            return response()->json(array('status'=>'ok','evento'=>$evento));
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function update($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            $validator = Validator::make($request->all(), Evento::validateRules());
            if ($validator->fails()) {
                return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
            }
            $evento = Evento::find($id);
            $oldImages = collect($evento->medias);
            if(isset($request->image_ids)){
                $imageIds = $request->image_ids;
                foreach($imageIds as $imageId){
                    $oldImages = $oldImages->reject(function($image,$key) use ( $imageId ){
                        return $image == $imageId;
                    });
                }
                $evento->medias = $imageIds;
            }
            if(isset($request->images)){
                $evento->uploadMedias($request->images);
            }
            $evento->fill($request->input());
            $evento->save();
            if($oldImages&&$oldImages->count()>0){
                $oldImages->each(function($id){
                    $media = \App\Models\Media::find($id);
                    Storage::disk('s3')->delete($media->src);
                    $media->delete();
                });
            }
            return response()->json(array('status'=>'ok','evento'=>$evento));
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function destroy($id,Request $request){
        $user = $request->user('api');
        if($user->can('events')){
            $asset = Evento::find($id);
            if($asset){
                $destroy=Evento::destroy($id);
            }
            if ($destroy){
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
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function show($id,Request $request){
        $user = $request->user('api');
        $evento = Evento::find($id);
        $evento->getImages();
        $evento['created_date'] = date('M d, Y',strtotime($evento->done_date));
        if($evento->done_date){
            $dates = explode(' ',$evento->done_date);
            $evento['spanish_date'] = iconv('ISO-8859-2', 'UTF-8', strftime("%B %d, %Y ", strtotime($evento->done_date)));
            $evento['spanish_time'] = date("j:i a",strtotime($evento->done_date));
            $evento['participants'] = $evento->customers->count();
            $evento['date'] = $dates[0];
            $evento['datetime'] = substr($dates[1],0,5);
            if( $user && $user->customer ){
                $participant = false;
                foreach($evento->customers as $customer){
                    if($customer->id == $user->customer->id)$participant = true;
                }
                $evento['participant'] = $participant;
            }
        }
        return response()->json($evento);
    }
    public function index(Request $request){
        $user = $request->user('api');
        if($user->can('events')){
            $evento = new Evento;
            $evento->assignSearch($request);
            return response()->json($evento->search());
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function home(Request $request){
        $evento = new Evento;
        $evento->assignFrontSearch($request);
        $user = $request->user('api');
        if($user&&$user->customer)\App\Jobs\Activity::dispatch($user->customer);
        return response()->json($evento->search());
    }
    public function disable($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            $evento = Evento::find($id);
            if ($evento) {
                $evento->status = 'Draft';
                $evento->save();
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => 'error'], 422);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function restore($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            $evento = Evento::find($id);
            if ($evento) {
                $evento->status = 'Publish';
                $evento->save();
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => 'error'], 422);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function recent(){
        $items = Evento::whereStatus('Publish')->where('done_date','<',date("Y-m-d H:i:s"))->take(3)->orderBy('created_at','desc')->get();
        foreach($items as $index=> $evento){
            $items[$index]['created_date'] = date('M d, Y',strtotime($evento->created_at));
            $evento->category;
            $items[$index]['excerpt'] = $evento->extractExcerpt($evento->description);
            if($evento->image)  $evento->image = url('storage/'.$evento->image);            
        }
        return response()->json($items);
    }
    public function toggleAttend($id,Request $request){
        $user = $request->user('api');
        $evento = Evento::find($id);
        if($user && $user->customer->id){
            $evento->toggleAttend($user->customer);
            return response()->json(['event'=>$evento]);
        }
        return response()->json(['status'=>'failed'],403);
    }
}