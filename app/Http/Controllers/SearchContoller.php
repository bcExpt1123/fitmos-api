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


class SearchController extends Controller
{
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
                return response()->json($company);
            }
        }else{
            $company = Company::where('username','=',$username)->whereStatus('Active')->first();
            if($company){
                $company->type = 'company';
                return response()->json($company);
            }
        }
        return response()->json(null);
    }
    public function notifications(Request $request){
        $user = $request->user('api');
        $notifications = \App\Models\Notification::whereCustomerId($user->customer->id)->orderBy('id','desc')->limit(30)->first();
        return response()->json(['notifications'=>$notifications]);
    }
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