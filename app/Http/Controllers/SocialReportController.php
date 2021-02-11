<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Report;

class SocialReportController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user('api');
        $validator = Validator::make($request->all(), Report::validateRules());
        if ($validator->fails()) {
            return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
        }
        $report = new Report;
        $report->fill($request->all());
        $report->customer_id = $user->customer->id;
        $report->save();
        return response()->json(array('status'=>'ok','report'=>$report));
    }
    public function update($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            return response()->json(array('status'=>'ok'));
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function destroy($id,Request $request){
        $user = $request->user('api');
        if($user->can('events')){
            $asset = Report::find($id);
            if($asset){
                $destroy=Report::destroy($id);
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
        $report = Report::find($id);
        return response()->json($report);
    }
    public function index(Request $request){
        $user = $request->user('api');
        if($user->can('events')){
            $report = new Report;
            $report->assignSearch($request);
            return response()->json($report->search());
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function complete($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('events')){
            $report = Report::find($id);
            if ($report) {
                $report->status = 'completed';
                $report->save();
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
            $report = Report::find($id);
            if ($report) {
                $report->status = 'pending';
                $report->save();
                return response()->json(['success' => 'success']);
            }
            return response()->json(['error' => 'error'], 422);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
}