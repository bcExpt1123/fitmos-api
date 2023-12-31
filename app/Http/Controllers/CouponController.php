<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\CouponEmail;
use App\User;
use App\Customer;
use App\Setting;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Mail;
use App\Mail\CouponInvitationEmail;


class CouponController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user('api');
        if($user->can('coupons')){
            $validator = Validator::make($request->all(), Coupon::validateRules());
            if ($validator->fails()) {
                return response()->json(array('status'=>'failed','errors'=>$validator->errors()),422);
            }
            $coupon = new Coupon;
            $coupon->fill($request->all());
            $coupon->save();
            if($coupon->type == 'InvitationEmail'){
                if($request->email_list){
                    $emails = explode("\n",$request->email_list);
                    foreach($emails as $email){
                        $validator = Validator::make(['mail'=>$email], ['mail'=>'email|max:255']);
                        if (!$validator->fails()) {
                            $couponEmail = CouponEmail::create(['coupon_id'=>$coupon->id,'email'=>$email]);
                            Mail::to($email)->send(new CouponInvitationEmail($couponEmail->id,$coupon->expiration));
                        }
                    }
                }
            }
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(array('status'=>'ok','coupon'=>$coupon));
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function update($id,Request $request)
    {
        $user = $request->user('api');
        if($user->can('coupons')){
            $validator = Validator::make($request->all(), Coupon::validateRules($id));
            if ($validator->fails()) {
                return response()->json(array('status'=>'failed','errors'=>$validator->errors()));
            }
            $coupon = Coupon::find($id);
            $coupon->fill($request->all());
            $coupon->save();
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(array('status'=>'ok','coupon'=>$coupon));
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function show($id,Request $request){
        $user = $request->user('api');
        if($user->can('coupons')){
            $coupon = Coupon::find($id);
            if($coupon->mail==null){
                $coupon->mail = "";
            }
            if($coupon->type == "InvitationEmail"){
                $coupon->emails = CouponEmail::whereCouponId($coupon->id)->get();
            }
            return response()->json($coupon);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function destroy($id,Request $request){
        $user = $request->user('api');
        if($user->can('coupons')){
            $coupon = Coupon::find($id);
            if($coupon){
                $destroy=Coupon::destroy($id);
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
    public function index(Request $request){
        $user = $request->user('api');
        if($user->can('coupons')){
            $coupon = new Coupon;
            $coupon->assignSearch($request);
            return response()->json($coupon->search());
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function disable($id,Request $request){
        $user = $request->user('api');
        if($user->can('coupons')){
            $coupon = Coupon::find($id);
            $coupon->status = "Disabled";
            $coupon->save();
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json($coupon);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function active($id,Request $request){
        $user = $request->user('api');
        if($user->can('coupons')){
            $coupon = Coupon::find($id);
            $coupon->status = "Active";
            $coupon->save();
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json($coupon);
        }else{
            return response()->json(['status'=>'failed'],403);
        }
    }
    public function check(Request $request){
        $inputs = $request->input('voucher');
        $code = $inputs['token'];
        $coupon = Coupon::whereCode($code)->whereType('Public')->whereStatus('Active')->first();
        if($coupon===null){
            $user = $request->user('api');
            $coupon = Coupon::whereCustomerId($user->customer->id)->whereType('Private')->whereCode($code)->whereStatus('Active')->first();    
        }
        if($coupon){
            $userId = $inputs['user_id'];
            $user = User::find($userId);
            $coupon['token'] = $code;
            $coupon->renewal = (int)$coupon->renewal;
            if($coupon->renewal === 0 && $user->customer->hasSubscription()){
                return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);    
            }
            return response()->json(['voucher'=>$coupon]);
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
    public function generateFirstPay(Request $request){
        $user = $request->user('api');
        $coupon = Coupon::createFirstPay($user);
        if($coupon){
            $coupon['token'] = $coupon->code;
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(['voucher'=>$coupon]);
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
    public function private(Request $request){
        $inputs = $request->input('voucher');
        $code = $inputs['code'];
        $user = $request->user('api');
        $coupon = Coupon::whereCustomerId($user->customer->id)->whereType('Private')->whereCode($code)->whereStatus('Active')->first();
        if($coupon){
            $coupon['token'] = $code;
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(['voucher'=>$coupon]);
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
    public function public(Request $request){
        $inputs = $request->input('voucher');
        $code = $inputs['code'];
        $coupon = Coupon::whereIn('type',['Public','InvitationCode'])->whereCode($code)->whereStatus('Active')->first();
        if($coupon){
            $coupon['token'] = $code;
            $coupon->renewal = (int)$coupon->renewal;
            switch($coupon->type){
                case 'Public':
                    return response()->json(['voucher'=>$coupon]);
                    break;
                case 'InvitationCode':
                    if($coupon->max_user_count==null || $coupon->max_user_count == 0 || $coupon->max_user_count>0&&$coupon->max_user_count>$coupon->current_user_count){
                        return response()->json(['voucher'=>$coupon]);
                    }
                    break;
            }
        }
        return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
    }
    public function email(Request $request){
        $id = $request->input('id');
        $couponEmail = CouponEmail::find($id);
        if($couponEmail && $couponEmail->used == "no" && $couponEmail->coupon->type == "InvitationEmail"){
            $coupon = $couponEmail->coupon;
            $coupon['token'] = $coupon->code;
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(['voucher'=>$coupon]);
        }
        return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
    }
    public function publicWithUser(Request $request){
        $inputs = $request->input('voucher');
        $couponId = $inputs['id'];
        $coupon = Coupon::find($couponId);
        if($coupon && $coupon->type=='Public' && $coupon->status == 'Active'){
            $coupon['token'] = $coupon->code;
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(['voucher'=>$coupon]);
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
    public function referral(Request $request){
        $inputs = $request->input('voucher');
        $code = $inputs['code'];
        $customerId = substr($code,1);
        $customer = Customer::find($customerId);
        $user = $request->user('api');
        if($customer && $customer->hasActiveSubscription()){
            $coupon = Coupon::whereCode($code)->first();
            $coupon['token'] = $code;
            if($user){
                if($user->customer->hasSubscription()){
                    return response()->json(['voucher'=>$coupon],403);
                }
                return response()->json(['voucher'=>$coupon]);
            }else{
                return response()->json(['voucher'=>$coupon]);
            }
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
    public function createRenewal(Request $request){
        $user = $request->user('api');
        $coupon = Coupon::createRenewal($user);
        if($coupon){
            $coupon['token'] = $coupon->code;
            $coupon->renewal = (int)$coupon->renewal;
            return response()->json(['voucher'=>$coupon]);
        }else{
            return response()->json(['errors' => ['token'=>[['error'=>'invalid']]]],422);
        }
    }
}
