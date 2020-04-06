<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Products;
use Response;

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

}
