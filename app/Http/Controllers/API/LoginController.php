<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use Response;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     protected $success='200';
     protected $error='401';

     public function login( Request $request){

        $email=$request->input('email');
        $password=$request->input('password');

        if(Auth::attempt(['email' => $email, 'password' => $password]))
        {
            $user=Auth::user();

            $data['token']=$user->createToken('EcommerceApp')->accessToken;
            $data['id']=$user->id;
            $data['email']=$user->email;
        }
        return Response::json(['data'=>$data],$this->success, [], JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

     }

}
