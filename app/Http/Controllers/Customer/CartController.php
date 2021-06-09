<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carts = \App\Models\Cart::where('user_id',auth()->user()->id)->get();
        foreach($carts as $cart){
            $cart->updateCartQuantity();
        }
        return view('customer.cart',compact(['carts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:\App\Models\Product,id',
            'user_id' => 'required|exists:\App\Models\User,id',
            'quantity' => 'required|min:1',
        ]);
        $cart = \App\Models\Cart::where('product_id', $request->product_id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($cart == null) {
            $cart = new \App\Models\Cart();
        }
        else{
            $request->quantity = $request->quantity + $cart->quantity;
        }
        $cart->product_id = $request->product_id;
        $cart->user_id = $request->user_id;
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = \App\Models\Cart::findOrFail($id);
        $request->validate([
           'quantity' => 'required|min:1|max:'.$cart->Product->quantity_available,
        ]);
        $cart->quantity = $request->quantity;
        $cart->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = \App\Models\Cart::findOrFail($id);
        $cart->delete();
        return redirect()->back();
    }
}
