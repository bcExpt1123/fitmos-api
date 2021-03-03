<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
/**
 * @group Chat
 *
 * APIs for managing  chat
 */

class ChatController extends Controller
{
    /**
     * verify.
     * 
     * This endpoint.
     * @authenticated
     * @response {
     * }
     */
    public function verify(Request $request)
    {
        return response()->json(['status'=>'ok','cart'=>null]);
    }
    /**
     * verify from local.
     * 
     * This endpoint.
     * @authenticated
     * @response {
     * }
     */
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