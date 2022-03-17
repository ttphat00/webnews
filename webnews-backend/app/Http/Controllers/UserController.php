<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use JWTAuth;
use JWTAuthException;
use Hash;

class UserController extends Controller
{
    public $loginAfterSignUp = true;
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request){
        $user = $this->user->create([
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'password' => Hash::make($request->get('password')),
          'permission' => $request->get('permission')
        ]);

        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
    }

    public function login(Request $request){
        $input  = $request->only('email', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($input )) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json([
            'status' => true,
            'token' => $token,
        ]);
    }

    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }

}
