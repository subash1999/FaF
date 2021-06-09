@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Create Product</h3>
    <br>
    <form action="{{ route('admin.products.store') }}" method="POST" class="ml-6 mr-6 mb-6"
          enctype="multipart/form-data">
        @method("POST")
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
        <div class="mb-3">
            <label for="name" class="form-label">Product Name <small class="text-danger"> ( Required )</small></label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="row mb-3">
            <label for="images" class="form-label">Product Images<small class="text-danger"> ( At least Image no 1 Required )</small></label>
            <div class="col-lg">
                <label for="image1" class="text-break">Image 1<small class="text-danger">( * )</small></label>
                <input type="file" class="form-control" name="image1" accept="image/png, image/jpeg" required>
            </div>
            <div class="col-lg">
                <label for="image2">Image 2</label>
                <input type="file" class="form-control" name="image2" accept="image/png, image/jpeg">
            </div>
            <div class="col-lg">
                <label for="image3">Image 3</label>
                <input type="file" class="form-control" name="image3" accept="image/png, image/jpeg">
            </div>
            <div class="col-lg">
                <label for="image4">Image 4</label>
                <input type="file" class="form-control" name="image4" accept="image/png, image/jpeg">
            </div>
            <div class="col-lg">
                <label for="image5">Image 5</label>
                <input type="file" class="form-control" name="image5" accept="image/png, image/jpeg">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="price" class="form-label">Price <small class="text-danger"> ( Required )</small></label>
                <input type="number" step="0.01" class="form-control" name="price" required>
            </div>
            <div class="col">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" step="0.01" class="form-control" name="discount" >
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="quantity_available" class="form-label">Quantity Available<small class="text-danger"> ( Required )</small></label>
                <input type="number" step="1" class="form-control" name="quantity_available" required>
            </div>
            <div class="col">
                <label for="quantity_sold" class="form-label">Quantity Sold</label>
                <input type="number" step="1" class="form-control" name="quantity_sold" >
            </div>
        </div>
        <div class="mb-3">
            <label for="product_category" class="form-label">Product Category<small class="text-danger"></small></label>
            <select step="1" class="form-control" name="product_category">
                <option value="">-- Select None --</option>
                @foreach (\App\Models\ProductCategory::all() as $pc)
                    <option value="{{ $pc->id }}">{{ $pc->name }}, Id: {{ $pc->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description"
                      class="form-control ckeditor">{!! old('description') !!}</textarea>
            <div class="form-text">Write about product in the description.</div>
        </div>
        <input type="submit" value="Add Product" class="btn btn-success float-right">
    </form>
    <br>
    <br>
    <br>
@endsection
