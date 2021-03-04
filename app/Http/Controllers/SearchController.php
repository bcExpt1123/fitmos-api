<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
//use App\Rules\UniqueEmail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Company;
use App\Config;
use App\Models\Post;

/**
 * @group Search   
 *
 * APIs for searching people, eventos, posts
 */

class SearchController extends Controller
{
    /**
     * search customers, shops, posts.
     * 
     * This endpoint searchs customers and shops and posts
     * @authenticated
     * @bodyParam search string required
     * @response {
     *  "people":[{customer}],
     *  "shop":[{company}],
     *  "posts":[{post}],
     * }
     */
    public function all(Request $request){
        $user = $request->user('api');
        if($user->customer){
            $search = $request->search;
            $customers = Customer::where(function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search){
                    $q->where('active','=','1');
                    $q->where('name','like',"%$search%");
                });
                $query->whereHas('subscriptions', function($q){
                    $q->where('status','=',"Active");
                });
            })->where('id','!=',$user->customer->id)->limit(4)->get();
            foreach($customers as $customer){
                $customer->getAvatar();
            }
            // DB::enableQueryLog();
            $shops = Company::where('name','like',"%$search%")
                ->whereStatus('active')
                ->where(function($q) use ($user){
                    $q->whereHas('countries',function($query) use ($user){
                        $query->where('country','=',strtoupper($user->customer->country_code));
                    })
                    ->where('is_all_countries','=','no')
                    ->orWhere('is_all_countries','=','yes');
                    // ->whereHas('products',function($query) use ($user){
                    //     $query->where('status', '=', "Active")
                    //         ->where('expiration_date', '>=', $user->customer->currentDate());
                    // })
                })
                ->limit(4)->get();
            $size = 'x-small';
            foreach($shops as $index=>$item){
                $logo= $shops[$index]['logo'];
                $shops[$index]['logo'] = $item->getImageSize($logo,$size);
            }        
            $posts = \App\Models\Post::with('medias')->where('searchable_content','like',"%$search%")->limit(4)->get();
            foreach($posts as $post){
                $post->extend(null, $user);
            }    
            // dd(DB::getQueryLog());
            return response()->json([
                'searchResult' => ['people'=>$customers,'shops'=>$shops,'posts'=>$posts]
            ]);
        }
        return response()->json([
            'errors' => ['result'=>[['error'=>'failed']]]
        ], 403);
    }
    /**
     * search customers.
     * 
     * This endpoint.
     * @authenticated
     * @bodyParam search string required
     * @response {
     *  "customers":[{customer}],
     * }
     */
    public function customers(Request $request){
        $user = $request->user('api');
        if($user->customer){
            $search = $request->search;
            $where = Customer::where(function($query) use ($search) {
                $query->whereHas('user', function($q) use ($search){
                    $q->where('active','=','1');
                    $q->where('name','like',"%$search%");
                });
                $query->whereHas('subscriptions', function($q){
                    $q->where('status','=',"Active");
                });
            })->where('id','!=',$user->customer->id);
            if($request->id>0){
                $where = $where->where('id','<',$request->id);
            }
            $customers = $where->orderBy('id','desc')->limit(20)->get();
            foreach($customers as $customer){
                $customer->getAvatar();
            }
            return response()->json([
                'customers'=>$customers
            ]);
        }
        return response()->json([
            'errors' => ['result'=>[['error'=>'failed']]]
        ], 403);
    }
    /**
     * search companies.
     * 
     * This endpoint.
     * @authenticated
     * @bodyParam search string required
     * @response {
     *  "companies":[{company}],
     * }
     */
    public function companies(Request $request){
        $user = $request->user('api');
        if($user->customer){
            $search = $request->search;
            $where = Company::where('name','like',"%$search%")
            ->whereStatus('active')
            ->where(function($q) use ($user){
                $q->whereHas('countries',function($query) use ($user){
                    $query->where('country','=',strtoupper($user->customer->country_code));
                })
                ->where('is_all_countries','=','no')
                ->orWhere('is_all_countries','=','yes');
                // ->whereHas('products',function($query) use ($user){
                //     $query->where('status', '=', "Active")
                //         ->where('expiration_date', '>=', $user->customer->currentDate());
                // })
            });
            if($request->id>0){
                $where = $where->where('id','<',$request->id);
            }
            $companies = $where->orderBy('id','desc')->limit(20)->get();
            $size = 'x-small';
            foreach($companies as $index=>$item){
                $logo= $companies[$index]['logo'];
                $companies[$index]['logo'] = $item->getImageSize($logo,$size);
            }        
            return response()->json([
                'companies'=>$companies
            ]);
        }
        return response()->json([
            'errors' => ['result'=>[['error'=>'failed']]]
        ], 403);
    }
    /**
     * search posts.
     * 
     * This endpoint.
     * @authenticated
     * @bodyParam search string required
     * @response {
     *  "posts":[{post}],
     * }
     */
    public function posts(Request $request){
        $user = $request->user('api');
        if($user->customer){
            $search = $request->search;
            $where = \App\Models\Post::with('medias')->where('searchable_content','like',"%$search%");
            if($request->id>0){
                $where = $where->where('id','<',$request->id);
            }
            $posts = $where->orderBy('id','desc')->limit(20)->get();
            foreach($posts as $post){
                $post->extend(null, $user);
            }
            return response()->json([
                'posts'=>$posts
            ]);
        }
        return response()->json([
            'errors' => ['result'=>[['error'=>'failed']]]
        ], 403);
    }
    /**
     * find customer or shop by username.
     * 
     * This endpoint
     * It find only shop unauthenticated, and it searchs customer or shop when authenticated.
     * @bodyParam u string required
     * @response scenario=customer{
     *      "id":5,
     *      "type":"customer",
     *      "username":"unique_user_name",    
     *      "first_name":"First",
     *      "last_name":"Last",
     *      "postCount":10,
     *      "following":{follow},
     *      "followers":[{follow}],
     *      "followings":[{follow}],
     *      "relation":false,//it shows blocked or muted
     *      "medals":{
     *           'fromWorkout':100,// current level workout number
     *           'fromWorkoutImage':$src,//image
     *           'toWorkout':200,// next level workout number
     *           'toWorkoutImage':$toWorkoutImage,//image
     *           'workoutCount':75,// this total completed workout count
     *           'levelMedalImage':$src // level medal image
     *           'fromMonthWorkout':15,// current level month workout number
     *           'fromMonthWorkoutImage':$src,// current level month workout image
     *           'toMonthWorkout':25,// next level month workout number
     *           'toMonthWorkoutImage':$src,// next level month workout image
     *           'monthWorkoutCount':45, // this month total completed workout count 
     *           'monthWorkoutTotal':46, // this month total workout count
     *           'monthShortName':"Feb",// spanish month short name
     *           'monthPercent':$monthPercent
     *      },
     * }
     * @response scenario=company{
     *      "id":5,
     *      "type":"company",
     *      "username":"unique_user_name",    
     *      "name":"name",
     *      "description":"description",
     *      "phone":"phone",
     *      "mail":"email@gmail.com",
     *      "is_all_countries":"yes",// or "no"
     *      "mobile_phone":"1231231",
     *      "website_url":"https://www.fitemos.com",
     *      "address":"address",
     *      "facebook":"facebook",
     *      "instagram":"instagram",
     *      "twitter":"twitter",
     *      "horario":"horario",
     *      "logo":"src"
     * }
     * @response  status=403 scenario="Not found"{
     * }
     */
    public function username(Request $request){
        $user = $request->user('api');
        $username = $request->u;
        if($user && $user->customer){
            $customer = Customer::whereUsername($username)->first();
            if($customer && $customer->hasActiveSubscription()){
                $customer->type = 'customer';
                $customer->getSocialDetails($user->customer->id);
                $customer['medals'] = $customer->findMedal();    
                return response()->json($customer);
            }
            $company = Company::whereUsername($username)->first();
            if($company){
                $company->type = 'company';
                if($company->logo)$company->logo = url("storage/".$company->logo);                
                return response()->json($company);
            }
        }else{
            $company = Company::where('username','=',$username)->whereStatus('Active')->first();
            if($company){
                $company->type = 'company';
                if($company->logo)$company->logo = url("storage/".$company->logo);                
                return response()->json($company);
            }
        }
        return response()->json(null, 403);
    }
    /**
     * get notifications.
     * 
     * This endpoint shows latest 30 notifications.
     * @authenticated
     * @response {
     *  notifications:[{notification}]
     * }
     */
    public function notifications(Request $request){
        $user = $request->user('api');
        $notifications = \App\Models\Notification::whereCustomerId($user->customer->id)->orderBy('id','desc')->limit(30)->get();
        foreach($notifications as $notification){
            if($notification->action_type=="customer"){
                $notification->action = Customer::find($notification->action_id);
                $notification->action->getAvatar();
            }
        }
        return response()->json(['notifications'=>$notifications]);
    }
    /**
     * sync.
     * 
     * This endpoint.
     * @authenticated
     * @response {
     * }
     */
    public function sync($id){
        $customer = Customer::find($id);
        if($customer) {
          $customer = strtotime($customer->updated_at);
        }
        else $customer = null;
        $config = new Config;
        $publicProfile = $config->findByName('public_profile');        
        $newsfeed = null;
        $notification = null;
        return response()->json([
            'customer'=>$customer,
            'publicProfile'=>$publicProfile,
            'notification'=>$notification,
            'newsfeed'=>$newsfeed,
        ]);
    }
}