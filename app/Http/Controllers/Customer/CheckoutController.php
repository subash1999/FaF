<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(){
        $carts = \App\Models\Cart::where('user_id',auth()->user()->id)->get();
        foreach($carts as $cart){
            $cart->updateCartQuantity();
        }
        return view('customer.checkout',compact(['carts']));
    }
}
