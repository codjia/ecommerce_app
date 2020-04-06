<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use Response;
use Validator;

class CategoryController extends Controller
{

    public function index(){

        $data['categories'] = Category::all();
        $data['status']=true;

        return Response::json(['data'=>$data],200, [], JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

    }

    public function show($id){
        $data['products']=Products::where('category_id', $id)->get();
        $data['status']=true;

        return Response::json(['data'=>$data],200, [], JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

    }

    public function create(Request $request){

        $validator= Validator::make($request->all(),[
            'category_name'=> 'required|string',
            'category_desc'=> 'required|string'
        ]);

        if($validator->fails()){

            return Response::json(['error'=>$validator->errors()],401,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

        }

        $categories = new Category();

        $categories->category_name=$request->input('category_name');
        $categories->category_desc=$request->input('category_desc');
        $categories->save();

        // $data['token']=$categories->createToken('EcommerceApp')->accessToken;
        $data['category_name']=$categories->category_name;
        $data['category_desc']=$categories->category_desc;

        return Response::json(['data'=>$data],200,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);
    }

}
