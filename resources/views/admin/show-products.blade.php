@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <div class="container ml-4 mr-4">
        <br>
        <h3 class="text-center text-break">Show Product : {{ $product->name }}</h3>
        <h6 class="float-right">
            <a href="{{ route('admin.products.edit',[$product->id]) }}" class="btn btn-sm btn-secondary m-2">Edit</a>
            <br>

            <form action="{{ route('admin.products.destroy',[$product->id]) }}" method="POST"
                  onsubmit="return confirm('Do you really want to delete product with id {{ $product->id }}?');">
                @method('delete')
                @csrf
                <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
            </form>

        </h6>
        <h6>Product ID : <b>{{ $product->id }}</b></h6>
        <h6>Product Name: <b>{{ $product->name }}</b></h6>
        <h6>Product Category: <b>
                @isset($product->ProductCategory)
                    <a href="{{ route('admin.product-categories.show',$product->ProductCategory->id) }}">{{ $product->ProductCategory->name }}</a>
                @endisset
            </b>
        </h6>
        <h6>Price: <b>${{ $product->price }}</b></h6>
        <h6>Discount: <b>@isset($product->discount) $@endisset{{ $product->discount }}</b></h6>
        <h6>Final Price: <b>${{ $product->final_price }}</b></h6>
        <h6>Quantity Available: <b>{{ $product->quantity_available }}</b></h6>
        <h6>Quantity Sold: <b>{{ $product->quantity_sold }}</b></h6>
        <h6>Product Description:</h6>
        <div class="border border-dark text-break">
            {!! $product->description !!}
        </div>
        <p>Created at: {{ $product->created_at }}</p>
        <p>Updated at: {{ $product->updated_at }}</p>
        <br>
        <hr>

        <form action="{{ route('admin.product-images.store') }}" method="POST" enctype="multipart/form-data">
            @method('post')
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="mb-3 mt-2">
                <label for="image" class="form-label">New Product Image: </label>
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="file" class="form-control mb-2" name="image" accept="image/png, image/jpeg">
                <input type="submit" class="btn btn-success" value="Add Product Image">
            </div>
        </form>
        <hr>
        <h5>Product Images: </h5>
        <br>
        <table class="table table-striped w-100">
            <thead>
            <th>S.N</th>
            <th>Image</th>
            <th>View</th>
            <th>Delete</th>
            </thead>
            <tbody>
            @foreach($product->ProductImages as $product_image)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>
                        <img src="{{ asset('product_images/'.$product_image->image) }}" alt="Product Image"
                             height="170px" width="170px" class="p-2 border border-info">
                    </td>
                    <td>
                        <a href="{{ asset('product_images/'.$product_image->image) }}" target="_blank"
                           class="btn btn-outline-primary">View</a>
                    </td>
                    <td>
                        <form action="{{ route('admin.product-images.destroy',$product_image->id) }}" method="POST"
                              onSubmit="return confirm('Do you really want to delete product image with SN :{{ $loop->index+1 }}?');">
                            @method('delete')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Delete">
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr>
        <br>

    </div>
@endsection
