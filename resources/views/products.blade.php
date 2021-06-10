{{--shows the product--}}
@extends('layouts.layout')
@section('app-content')
    <h1 class="text-center text-truncate m-3">Products</h1>
    <form action="{{ route('products.index') }}" class="text-center">
        <div class="row m-3">
            <div class="col">
                <label for="search">Search : </label>
                <input type="search" name="search" id="search" class="">
            </div>
        </div>
        <div class="row m-3">
            <div class="col">
                <label for="product_category">Product Category : </label>
                <select name="product_category" id="product_category" class="">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\ProductCategory::all() as $pc)
                        <option value="{{ $pc->id }}">{{ $pc->name }}</option>
                    @endforeach

                </select>
            </div>
        </div>
        <div class="row m-3">
            <div class="col">
                <label for="min">Minimum Price ($)</label>
                <input type="number" name="min" id="min" step="0.01" class="">
            </div>
        </div>
        <div class="row m-3">
            <div class="col">
                <label for="max">Maximum Price ($)</label>
                <input type="number" name="max" id="max" step="0.01" class="">
            </div>
        </div>
        <div class="row">
            <div class="col">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Search" class="btn btn-outline-info">
            </div>
        </div>
    </form>
    <hr>
{{--    if else code, look time to figure out--}}
    @if (request()->filled('search') || request()->filled('product_category') || request()->filled('min') || request()->filled('max'))
        <h5><u>Search Results</u></h5>
        <h5>Products Found: {{ $products_count }}</h5>
        @if (request()->filled('search'))
            <h6>Search By: {{ request()->search }}</h6>
        @endif
        @if (request()->filled('product_category'))
            @php
            $pc = \App\Models\ProductCategory::findOrFail(request()->product_category);
            @endphp
            <h6>Product Category: {{ $pc->name }}</h6>
        @endif
        @if (request()->filled('min'))
            <h6>Minimum Price: ${{ request()->min }}</h6>
        @endif
        @if (request()->filled('max'))
            <h6>Maximum Price: ${{ request()->max }}</h6>
        @endif
    @endif
    <hr>
    {!! $products->appends(Request::all())->links() !!}
{{--    dispaly product, html and bootstrap, bootstrap documentation used to display all the products--}}
{{--    idea referenced from https://bbbootstrap.com/snippets/bootstrap-product-comparison-template-99013072--}}
    <div class="row">
        @foreach($products as $product)
            <div class="col-md m-3 p-2 border border-info" style="max-width: 230px; min-width: 190px;">
                <h4 class="text-truncate text-center">{{ $product->name }}</h4>
                <hr>
                <br>
                @include('snippets.product-carousel',['product'=>$product,'height_in_px'=>150,'width_in_px'=>150])
                <hr>

                @if(isset($product->discount) && $product->discount>0)
                    <h6 class="text-break fw-normal">Price: <span
                            class="text-decoration-line-through">${{ $product->price }}</span></h6>
                    <h6 class="text-break fw-normal">Discount: ${{ $product->discount }}</h6>
                    <h6 class="text-break fw-normal">Final Price: ${{ $product->final_price }}</h6>
                @else
                    <h6 class="text-break fw-normal">Price: ${{ $product->price }}</h6>
                @endif
                <h6 class="fw-normal">Available: {{ $product->quantity_available }}</h6>
                @if($product->quantity_available <= 0)
                    <small class="text-danger text-center text-break">Product Not Available</small>
                @else
                    <br>
                @endif
                @if(!isset($product->discount))
                    <br>
                    <br>
                @endif
                <a href="{{ route('products.show',$product->id) }}" class="btn btn-primary m-2 text-center">View</a>
                @include('snippets.add-to-wishlist-btn')
                <hr>
                @include('snippets.add-to-cart-btn')
            </div>
        @endforeach
    </div>
    {!! $products->appends(Request::all())->links() !!}
    <br>
    <br>
    <br>
    <br>
@endsection
