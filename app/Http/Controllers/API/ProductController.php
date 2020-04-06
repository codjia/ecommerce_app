<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use Response;

class ProductController extends Controller
{
    public function index() {

        $product=Products::all();
        return Response::json(['data'=>$product],200, [], JSON_UNESCAPED_UNICODE| JSON_UNESCAPED_SLASHES);

    }
}
