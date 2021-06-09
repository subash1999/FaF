@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <h2 class="text-center text-break m-3">Checkout</h2>
    <div class="m-3">
        @if($carts->count()<=0)
            <h3 class="ml-3 mt-2 mb-1">No Products in Cart to checkout</h3>
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
        <form action="{{ route('customer.payment.create') }}" method="post">
            @method('post')
            @csrf
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
                </thead>
                <tbody>
                @foreach ($carts as $cart)
                    <tr>
                        <input type="hidden" name="carts[]" value="{{ $cart->id }}">
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{ $cart->Product->id }}</td>
                        <td>{{ $cart->Product->name }}</td>
                        <td>{{ $cart->quantity }}</td>
                        <td>${{ $cart->Product->price }}</td>
                        <td>@isset($cart->Product->discount) $@endisset{{ $cart->Product->discount }}</td>
                        <td>${{ $cart->Product->final_price }}</td>
                        <td>${{ ($cart->quantity*$cart->Product->final_price) }}</td>
                        <td><a href="{{ route('products.show',$cart->Product->id) }}"
                               class="btn btn-sm btn-outline-primary">View Product</a></td>
                        @php
                            $payable_amount += ($cart->quantity*$cart->Product->final_price);
                        @endphp
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>

            <div class="float-right">
                <h5 class="m-3">Payable Amount : ${{ $payable_amount }}</h5>

                @if($carts->count()>0)
                    <input type="submit" class="btn btn-primary btn-lg m-3 float-right" value="Pay by Paypal">
                @endif
            </div>

@endsection
