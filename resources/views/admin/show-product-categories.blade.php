@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <div class="container ml-4 mr-4">
        <br>
        <h3 class="text-center">Show Product Category : {{ $pc->name }}</h3>
        <br>
        <h6 class="float-right">
            <a href="{{ route('admin.product-categories.edit',[$pc->id]) }}" class="btn btn-sm btn-secondary m-2">Edit</a>
            <br>

            <form action="{{ route('admin.product-categories.destroy',[$pc->id]) }}" method="POST"
                  onsubmit="return confirm('Do you really want to delete product category with id {{ $pc->id }}?');">
                @method('delete')
                @csrf
                <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
            </form>

        </h6>
        <h6>Product Category ID : <b>{{ $pc->id }}</b></h6>
        <h6>Product Category Name: <b>{{ $pc->name }}</b></h6>
        <h6>Product Category Description:</h6>
        <div class="border border-dark text-break">
            {!! $pc->description !!}
        </div>
        <p>Created at: {{ $pc->created_at }}</p>
        <p>Updated at: {{ $pc->updated_at }}</p>
        <br>
        <hr>
        <h4 class="text-center">Products of this Product Category</h4>
        <br>

        <table class="table w-100 datatable">
            <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Final Price</th>
            <th>Quantity Available</th>
            <th>Quantity Sold</th>
            <th>View</th>
            </thead>
            <tbody>
            @foreach ($pc->Products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>${{ $product->final_price }}</td>
                    <td>{{ $product->quantity_available }}</td>
                    <td>{{ $product->quantity_sold }}</td>
                    <td><a href="{{ route('admin.products.show',$product->id) }}" class="btn btn-outline-primary">View Product</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <br>
@endsection
