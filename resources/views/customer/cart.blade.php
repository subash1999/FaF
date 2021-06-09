@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <h2 class="text-center text-break m-3">Cart</h2>
    @if($carts->count()<=0)
        <h3 class="ml-3 mt-2 mb-1">No Products in Cart</h3>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @php
        $payable_amount = 0;
    @endphp
    <h6 class="m-3">Click on update quantity after you make changes to quantity of product</h6>
    <table class="table table-striped w-100 m-3">
        <thead>
        <th>SN</th>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Final Price</th>
        <th>Total</th>
        <th>View Product</th>
        <th>Delete Form Cart</th>
        </thead>
        <tbody>
        @foreach ($carts as $cart)
            <tr>
                <td>{{ $loop->index+1 }}
                <td>{{ $cart->Product->id }}</td>
                <td>{{ $cart->Product->name }}</td>
                <td>
                    <small>Qty Available: {{ $cart->Product->quantity_available }}</small>
                    <form action="{{ route('customer.carts.update',$cart->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <input type="number" min="1" max="{{ $cart->Product->quantity_available }}"
                               class="form-control form-control-sm" step="1"
                               value="{{ $cart->quantity }}" name="quantity">
                        <br>
                        <input type="submit" value="Update Quantity"
                               class="btn btn-sm btn-outline-success">
                    </form>
                </td>


                <td>${{ $cart->Product->price }}</td>
                <td>@isset($cart->Product->discount) $@endisset{{ $cart->Product->discount }}</td>
                <td>${{ $cart->Product->final_price }}</td>
                <td>${{ ($cart->quantity*$cart->Product->final_price) }}</td>
                <td><a href="{{ route('products.show',$cart->Product->id) }}" class="btn btn-sm btn-outline-primary">View
                        Product</a></td>
                <td>
                    <form action="{{ route('customer.carts.destroy',[$cart->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete product \'{{ $cart->Product->name }}\' with product id {{ $cart->Product->id }} from cart?');">
                        @method('delete')
                        @csrf
                        <input type="Submit" class="btn btn-sm btn-danger" value="Delete From Cart">
                    </form>
                </td>
                @php
                    $payable_amount += ($cart->quantity*$cart->Product->final_price);
                @endphp
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <div class="float-right m-3">
        <h5>Payable Amount : ${{ $payable_amount }}</h5>
        <br>
        @if($carts->count()>0)
            <a href="{{ route('customer.checkout.index') }}" class="btn btn-success btn-lg float-right">Checkout</a>
        @endif
    </div>
@endsection
