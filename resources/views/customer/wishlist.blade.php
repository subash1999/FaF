@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <h2 class="text-center text-break m-3">Wishlist</h2>
    <div class="m-3">
        @if($wishlists->count()<=0)
            <h3 class="ml-3 mt-2 mb-1">No Products in wishlist</h3>
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
        <table class="table table-striped w-100 datatable">
            <thead>
            <th>SN</th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Quantity Available</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Final Price</th>
            <th>View Product</th>
            <th>Add Product In Cart</th>
            <th>Delete From Wishlist</th>
            </thead>
            <tbody>
            @foreach ($wishlists as $wishlist)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $wishlist->Product->id }}</td>
                    <td>{{ $wishlist->Product->name }}</td>
                    <td>{{ $wishlist->Product->quantity_available }}</td>
                    <td>${{ $wishlist->Product->price }}</td>
                    <td>@isset($wishlist->Product->discount) $@endisset{{ $wishlist->Product->discount }}</td>
                    <td>${{ $wishlist->Product->final_price }}</td>
                    <td><a href="{{ route('products.show',$wishlist->Product->id) }}"
                           class="btn btn-sm btn-outline-primary">View Product</a></td>
                    <td>
                        @include('snippets.add-to-cart-btn',[
                            'product' => $wishlist->Product,
                        ])
                    </td>
                    <td>
                        <form action="{{ route('customer.wishlist.destroy',[$wishlist->id]) }}" method="POST"
                              onsubmit="return confirm('Do you really want to delete product \'{{ $wishlist->Product->name }}\' with product id {{ $wishlist->Product->id }} from wishlist?');">
                            @method('delete')
                            @csrf
                            <input type="Submit" class="btn btn-sm btn-danger" value="Delete From Wishlist">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
@endsection
