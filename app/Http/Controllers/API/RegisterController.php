<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Response;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=>'required'
        ]);

        if($validator->fails()){

            return Response::json(['error'=>$validator->errors()],401,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

        }

        $user = new User();

        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('name'));
        $user->save();

        $data['token']=$user->createToken('EcommerceApp')->accessToken;
        $data['id']=$user->id;
        $data['email']=$user->email;

        return Response::json(['data'=>$data],200,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);



    }
}
