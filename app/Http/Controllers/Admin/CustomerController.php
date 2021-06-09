<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = \App\Models\User::where('user_type','customer')->get();
        return view('admin.customers',compact('customers'));
    }

    public function show($id){
        $customer = \App\MOdels\User::find($id);
        if(!$customer->is_customer){
            abort(404);
        }
        return view('admin.show-customers',compact('customer'));
    }
}
