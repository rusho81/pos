<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    function CreateCustomer (Request $request) {
        $user_id=$request->header('id');
        return Customer::create([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'mobile' =>$request->input('mobile'),
            'user_id' => $user_id
        ]);
    }

    function CustomerList (Request $request) {
        $user_id=$request->header('id');
        return Customer::where('user_id', $user_id)->get();

    }

    function CustomerDelete (Request $request) {
        $user_id = $request->header('id');
        $customer_id = $request->input('id');
        return Customer::where('user_id',$user_id)->where('id', $customer_id)->delete();
    }

    function CustomerUpdate (Request $request) {
        $user_id = $request->header('id');
        $customer_id = $request->input('id');
        return Customer::where('user_id',$user_id)->where('id', $customer_id)->update([
            'name' =>$request->input('name'),
            'email' =>$request->input('email'),
            'mobile' =>$request->input('mobile'),
        ]);
    }
}
