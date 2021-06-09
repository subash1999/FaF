@extends('layouts.layout')
@section('app-content')
    <h2 class="text-break mt-4 mb-5"><u> {{ $product->name }}</u></h2>
    <div class="w-50">
        @include('snippets.product-carousel',['product'=>$product,'height_in_px'=>400])
    </div>
    <hr>
    <h5>Product ID : {{ $product->id }}</h5>
    <h5>Product Name : {{ $product->name }}</h5>
    @if(isset($product->discount) && $product->discount>0)
        <h5 class="text-break">Price: <span
                class="text-decoration-line-through">${{ $product->price }}</span></h5>
        <h5 class="text-break">Discount: ${{ $product->discount }}</h5>
        <h5 class="text-break">Final Price: ${{ $product->final_price }}</h5>
    @else
        <h5 class="text-break">Price: ${{ $product->price }}</h5>
    @endif
    <h5>Quantity Available : {{ $product->quantity_available }}</h5>
    @include('snippets.add-to-wishlist-btn')
    @include('snippets.add-to-cart-btn')
    <hr>
    <h5>Product Description</h5>
    <hr>
    {!! $product->description !!}
    <hr>
    <br>
    <br>
    <br>
@endsection
