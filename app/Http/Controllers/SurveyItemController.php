<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\SurveyItem;
use App\SurveySelect;
use Illuminate\Support\Facades\Validator;

class SurveyItemController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), SurveyItem::validateRules());
        if ($validator->fails()) {
            return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
        }
        $surveyitem = new SurveyItem;
        $surveyitem->fill($request->input());
        $surveyitem->save();
        return response()->json(array('status'=>'ok','surveyitem'=>$surveyitem));
    }
    public function update($id,Request $request){
        $requestData=$request->input();
        if($requestData['question']==null){
            $surveyitem = SurveyItem::find($id);
            $surveyitem->label = $requestData['label'];
            $surveyitem->survey_id= $requestData['survey_id'];
            $surveyitem->save();
        }
        else{
            $validator = Validator::make($request->all(), SurveyItem::validateRules());
            if ($validator->fails()) {
                return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
            }
            $surveyitem = SurveyItem::find($id);
            if($surveyitem->question=="select"){
                SurveySelect::where('survey_item_id',$id)->delete();
            }
            $surveyitem->fill($request->input());
            $surveyitem->save();
        }
        return response()->json(array('status'=>'ok'));
    }
    public function index(Request $request){
        $item = new SurveyItem;
        $surveySelect = new SurveySelect;
        $options = $surveySelect->all();
        $item->assignSearch($request);
        return response()->json(array('status'=>'ok','fetchData'=>$item->searchAll(),'options'=>$options)); 
    }
    public function show($id){
        $item = SurveyItem::find($id);
        return response()->json(['item'=>$item,'status'=>"ok"]);
    }
    public function destroy($id){
        $deleteItem = SurveyItem::find($id);
        if($deleteItem){
            $destroy=SurveyItem::destroy($id);
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
    }
    public function selectQuestionSave(Request $request){
        $selectQuestion = new SurveyItem;
        $selectQuestion->fill($request->input());
        $selectQuestion->save();
        return response()->json(array('status'=>'ok','selectQeustion'=>$selectQuestion));
    }
    public function selectOptionSave($id,Request $request){
        $surveySelect = new SurveySelect;
        $surveyItem = new SurveyItem;
        $surveyItem =  SurveyItem::create(array('survey_id'=>$id,'question'=>'select','label'=>$request['question']));
        $surveyItemId = $surveyItem->id;
        $selectData = $request->input();
        unset($selectData['question']);
        foreach($selectData as $itemId){
            SurveySelect::create(array('survey_item_id'=>$surveyItem->id,'option_label'=>$itemId));      
        }
        return response()->json(array('status'=>'ok'));
    }
    public function selectOptionDelete($id){
        $deleteItem = SurveySelect::find($id);
        if($deleteItem){
            $destroy=SurveySelect::destroy($id);
        }
        $options = SurveySelect::all();
        return response()->json(array('status'=>'ok','selectOption'=>$options));
    }
    public function saveOptionItems($id,Request $request){
        $surveySelect = new SurveySelect;
        $optionData = $request->input();
        $surveySelect = SurveySelect::create(array('survey_item_id'=>$id,'option_label'=>$optionData['option_label']));
        $options = SurveySelect::all();
        $optionData = SurveySelect::where('survey_item_id',$id)->get();
        return response()->json(array('status'=>'ok','selectOption'=>$options,'selectOptionData'=>$optionData)); 
    }
    public function selectOptionEdit($id,Request $request){
       $surveySelect = new SurveySelect;
       $requestData = $request->input();
       $surveySelect = SurveySelect::find($id);
       $surveySelect->option_label = $requestData['option_label'];
       $surveySelect->save();
       $options = SurveySelect::all();
       $optionData = SurveySelect::where('survey_item_id',$requestData['survey_item_id'])->get();
       return response()->json(array('status'=>'ok','selectOption'=>$options,'selectOptionData'=>$optionData)); 
    }
}
