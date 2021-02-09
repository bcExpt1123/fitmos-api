<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class ChatController extends Controller
{
    public function verify(Request $request)
    {
        return response()->json(['status'=>'ok','cart'=>null]);
    }
    public function verifyLocal(Request $request)
    {   
        $userId = $request->id;
        $token = $request->token;
        $publicKey = file_get_contents(storage_path('oauth-public.key'));
        try {
            $res = JWT::decode($token, $publicKey, array('RS256'));
            if($userId == $res->sub) return response()->json(['status'=>'ok','uid'=>$res->sub,'user'=>['id'=>$res->sub]]);

        }catch(\Exception $e){
            return response()->json(['status'=>'failed'],403);
        }
        // print_r($res->sub);die;
        return response()->json(['status'=>'failed'],403);
    }
}