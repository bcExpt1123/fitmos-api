<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Customer;

class FollowController extends Controller
{
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $requests = DB::table("follows")->select("*")->where('customer_id',$user->customer->id)->whereIn('status',['pending'])->get();
        foreach( $requests as $request ){
            $request->customer = Customer::find($request->follower_id);
            $request->customer->getAvatar();
        }
        return response()->json(['requests'=>$requests]);
    }
    public function store(Request $request)
    {
        $user = $request->user();
        $customerId = $request->customer_id;
        $follow = DB::table("follows")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->first();
        if($follow == null){
            $customer = Customer::find($customerId);
            if($customer->profile == 'private'){
                DB::table('follows')->insert([
                    'customer_id' => $customerId,
                    'follower_id' => $user->customer->id,
                    'status' =>'pending'
                ]);
                $status = 'pending';
            }else{
                DB::table('follows')->insert([
                    'customer_id' => $customerId,
                    'follower_id' => $user->customer->id,
                    'status' =>'accepted'
                ]);
                $status = 'accepted';
            }
            $customer = $this->findCustomer($customerId, $user);
            return response()->json(array('status'=>$status,'customer'=>$customer));
        }
        return response()->json(array('status'=>'ok'));
    }
    public function accept($id,Request $request)
    {
        $user = $request->user();
        $follow = DB::table("follows")->select("*")->where('id',$id)->first();
        if($follow->status == 'pending' && $follow->customer_id == $user->customer->id){
            $customerId = $follow->customer_id;
            DB::table("follows")->select("*")->where('id',$id)->update(['status'=>'accepted']);
            $customer = $this->findCustomer($customerId, $user);
            return response()->json(array('status'=>'accepted','customer'=>$customer));
        }
        return response()->json(array('status'=>'failed'),403);    
    }
    public function reject($id,Request $request)
    {
        $user = $request->user();
        $follow = DB::table("follows")->select("*")->where('id',$id)->first();
        if($follow->status == 'pending' && $follow->customer_id == $user->customer->id){
            $customerId = $follow->customer_id;
            DB::table("follows")->select("*")->where('id',$id)->update(['status'=>'rejected']);
            $customer = $this->findCustomer($customerId, $user);
            return response()->json(array('status'=>'rejected','customer'=>$customer));
        }
        return response()->json(array('status'=>'failed'),403);    
    }
    public function unfollow(Request $request){
        $user = $request->user();
        $customerId = $request->customer_id;
        DB::table("follows")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->delete();
        $customer = $this->findCustomer($customerId, $user);
        return response()->json(array('status'=>'ok','customer'=>$customer));
    }
    public function block(Request $request){
        $user = $request->user();
        $customerId = $request->customer_id;
        DB::table('customers_relations')->updateOrInsert(
            ['status' =>'blocked'],
            ['customer_id' => $customerId,
            'follower_id' => $user->customer->id]
        );
        $customer = $this->findCustomer($customerId, $user);
        return response()->json(array('status'=>'ok','customer'=>$customer));
    }
    public function unblock(Request $request){
        $user = $request->user();
        $customerId = $request->customer_id;
        DB::table("customers_relations")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->delete();
        $customer = $this->findCustomer($customerId, $user);
        return response()->json(array('status'=>'ok','customer'=>$customer));
    }
    public function mute(Request $request){
        $user = $request->user();
        $customerId = $request->customer_id;
        $relation = DB::table("follows")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->first();
        if($relation && $relation->status == 'blocked'){
            return response()->json(array('status'=>'failed'),421);    
        }
        DB::table('customers_relations')->updateOrInsert(
            ['status' =>'muted'],
            ['customer_id' => $customerId,
            'follower_id' => $user->customer->id]
        );        
        $customer = $this->findCustomer($customerId, $user);
        return response()->json(array('status'=>'ok','customer'=>$customer));
    }
    public function unmute(Request $request){
        $user = $request->user();
        $customerId = $request->customer_id;
        $relation = DB::table("follows")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->first();
        if($relation && $relation->status == 'blocked'){
            return response()->json(array('status'=>'failed'),421);    
        }
        DB::table("customers_relations")->select("*")->where('customer_id',$customerId)->whereFollowerId($user->customer->id)->delete();
        $customer = $this->findCustomer($customerId, $user);
        return response()->json(array('status'=>'ok','customer'=>$customer));
    }
    private function findCustomer($customerId, $user){
        $customer = Customer::find($customerId);
        $customer->type="customer";
        $customer->getSocialDetails($user->customer->id);
        $customer['medals'] = $customer->findMedal();
        $user->customer->touch();
        return $customer;
    }

}