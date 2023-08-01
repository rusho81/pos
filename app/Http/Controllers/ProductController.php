<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    function ProductPage() {
        return view('pages.dashboard.product-page');
    }

    function CreateProduct(Request $request) {
        $user_id=$request->header('id');
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="uploads/{$img_name}";

        $img->move(public_path('uploads'),$img_name);

        return Product::create([
            'name'=>$request->input('name'),
            'price'=>$request->input('price'),
            'unit'=>$request->input('unit'),
            'img_url'=>$img_url,
            'category_id'=>$request->input('category_id'),
            'user_id'=>$user_id
        ]);

    }

    function DeleteProduct(Request $request){}
    function ProductById(Request $request){}
    function ProductList(Request $request){}
    function UpdateProduct(Request $request){}
}
