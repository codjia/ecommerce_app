<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use Response;
use Validator;

class ProductController extends Controller
{
    public function index() {

        $product=Products::all();
        return Response::json(['data'=>$product],200, [], JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

    }

    public function create(Request $request){

        $validator= Validator::make($request->all(),[
            'products_name'=> 'required|string',
            'category_id'=>'required',
            'products_desc'=> 'required|string',
            'products_unit_price'=> 'required'
        ]);

        if($validator->fails()){

            return Response::json(['error'=>$validator->errors()],401,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

        }

        $products = new Products();

        $products->product_name=$request->input('product_name');
        $products->category_id=$request->input('category_id');
        $products->product_desc=$request->input('product_desc');
        $products->product_unit_price=$request->input('product_unit_price');
        $products->product_image=$request->input('product_image');
        $products->save();

        // $data['token']=$products->createToken('EcommerceApp')->accessToken;
        $data['product_name']=$products->product_name;
        $data['category_id']=$products->category_id;
        $data['product_desc']=$products->product_desc;
        $data['product_unit_price']=$products->product_unit_price;
        $data['product_image']=$products->product_image;

        return Response::json(['data'=>$data],200,[],JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);
    }
}
