<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

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

    function UpdateProduct(Request $request){
        $user_id=$request->header('id');
        $product_id=$request->input('id');
        //Upload new file
        if($request->hasFile('img')) {
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="uploade/{$img_name}";
            $img->move(public_path('uploads'),$img_name);

            //Delete old file
            $file_path = $request->input('file_path');
            File::delete($file_path);

            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'img_url'=>$img_url,
                'category_id'=>$request->input('category_id')
            ]);
        }else {
            return Product::where('id',$product_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'category_id'=>$request->input('category_id'),
            ]);
        }
    }
    function DeleteProduct(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        $file_path = $request->input('file_path');
        File::delete($file_path);
        return Product::where('id', $product_id)->where('user_id', $user_id)->delete();
    }
    function ProductById(Request $request){
        $user_id = $request->header('id');
        $product_id = $request->input('id');
        return Product::where('id', $product_id)->where('user_id', $user_id)->first();

    }
    
    function ProductList(Request $request){
        $user_id=$request->header('id');
        return Product::where('user_id',$user_id)->get();
    }
}
