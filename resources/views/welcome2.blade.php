{{-- our creation--}}
@extends('layouts.layout')
@section('app-content')
{{--    carousel from bootsrap https://getbootstrap.com/docs/5.0/components/carousel/--}}
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('img/homepage-banner.jpg') }}" class="d-block w-100" height="400px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/homepage-banner-2.png') }}" class="d-block w-100" height="400px" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('img/homepage-banner-3.jpg') }}" class="d-block w-100" height="400px" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <hr>
    <h3><u>New Products</u></h3>
    <div class="row">
        @foreach(\App\Models\Product::latest()->take(5)->get() as $product)
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
    <footer>

    </footer>

@endsection
