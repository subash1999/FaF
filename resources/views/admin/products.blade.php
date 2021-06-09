@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Products</h3>
    <br>
    <table class="table w-100 datatable">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Final Price</th>
        <th>Quantity Available</th>
        <th>Quantity Sold</th>
        <th>Product Category</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>${{ $product->price }}</td>
                <td>@isset($product->discount) $@endisset{{ $product->discount }}</td>
                <td>${{ $product->final_price }}</td>
                <td>{{ $product->quantity_available }}</td>
                <td>{{ $product->quantity_sold }}</td>
                <td>
                    @isset($product->ProductCategory)
                    <a href="{{ route('admin.product-categories.show',[$product->ProductCategory->id]) }}">{{ $product->ProductCategory->name }}</a>
                    @endisset
                </td>
                <td><a href="{{ route('admin.products.show',[$product->id]) }}"
                       class="btn btn-sm btn-outline-primary">View</a></td>
                <td><a href="{{ route('admin.products.edit',[$product->id]) }}"
                       class="btn btn-sm btn-outline-secondary">Edit</a></td>
                <td>
                    <form action="{{ route('admin.products.destroy',[$product->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete product with id {{ $product->id }}?');">
                        @method('delete')
                        @csrf
                        <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <br>
@endsection
