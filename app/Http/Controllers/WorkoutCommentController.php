<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Customer;
use App\User;
use App\Models\WorkoutComment;
/**
 * @group Workout Comments   
 *
 * APIs for managing  likes for post and comment on social part
 */

class WorkoutCommentController extends Controller
{
    /**
     * create a workout comment.
     * 
     * This endpoint.
     * @authenticated
     * @bodyParam publish_date string required date such as '2021-05-23'
     * @bodyParam content string required
     * @bodyParam type string required basic or extra
     * @bodyParam dumbells_weight float
     * @response {
     * }
     */
    public function store(Request $request){
        $validator = Validator::make($request->all(), WorkoutComment::validateRules());
        if ($validator->fails()) {
            return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
        }        
        $user = $request->user('api');
        $comment = WorkoutComment::create([
            'customer_id'=>$user->customer->id,
            'publish_date'=>$request->publish_date,
            'type'=>$request->type,
            'content'=>$request->content,
            'dumbells_weight'=>$request->dumbells_weight
        ]);
        return response()->json([
            'comment'=>$comment
        ]);
    }
     /**
     * get a workout list with a customer's comment.
     * 
     * @authenticated
     * @queryParam customer_id integer required
     * @queryParam page_size integer if not, it is 20
     * @queryParam page_number integer if not, it is 1, from 1
     * @response {
     * [
     *  {
     *   'publish_date':'2021-05-23',
     *   'comment_count':2,
     *   'completed':true
     * }
     * ]
     * }
     */
    public function publish(Request $request){
        if($request->exists('page_size')){
            $pageSize = $request->page_size;
        }else{
            $pageSize = 20;
        }
        if($request->exists('page_number')){
            $pageNumber = (int)$request->page_number;
            if($pageNumber<1)$pageNumber = 1;
        }else{
            $pageNumber = 1;
        }
        $customer = Customer::find($request->customer_id);
        $records = [];
        setlocale(LC_ALL, "es_ES", 'Spanish_Spain', 'Spanish');
        for($i = $pageSize * ($pageNumber -1) ; $i<$pageSize * $pageNumber; $i++){
            $date = date('Y-m-d', strtotime("-$i days"));
            $workout = \App\Workout::wherePublishDate($date)->first();
            if($workout === null){
                $workout = \App\Workout::where('publish_date','<',$date)->first();
                if($workout === null){
                    break;
                }
            }
            // if($workout){
                $workoutSpanishDate = ucfirst(iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B del %Y", strtotime($date))));
                $workoutSpanishShortDate = ucfirst(iconv('ISO-8859-2', 'UTF-8', strftime("%A, %d de %B", strtotime($date))));
                $done = \App\Done::whereDoneDate($date)->whereCustomerId($customer->id)->first();
                $commentsCount = \App\Models\WorkoutComment::wherePublishDate($date)->whereCustomerId($customer->id)->count();
                $records[] = [
                    'publish_date'=>$date,
                    'spanish_date'=>$workoutSpanishDate,
                    'spanish_short_date'=>$workoutSpanishShortDate,
                    'comment_count'=>$commentsCount,
                    'completed'=>$done?true:false,
                ];
            // }
        }
        return response()->json($records);
    }
}