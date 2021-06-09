@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Create Product</h3>
    <br>
    <form action="{{ route('admin.products.update',$product->id) }}" method="POST" class="ml-6 mr-6 mb-6"
          enctype="multipart/form-data">
        @method("Put")
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
            <input type="text" class="form-control" name="name" value="{{ old('name') ?? $product->name }}" required>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="price" class="form-label">Price <small class="text-danger"> ( Required )</small></label>
                <input type="number" step="0.01" class="form-control" name="price"
                       value="{{ old('price') ?? $product->price }}" required>
            </div>
            <div class="col">
                <label for="discount" class="form-label">Discount</label>
                <input type="number" step="0.01" class="form-control" name="discount"
                       value="{{ old('discount') ?? $product->discount }}">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col">
                <label for="quantity_available" class="form-label">Quantity Available<small class="text-danger"> (
                        Required )</small></label>
                <input type="number" step="1" class="form-control" name="quantity_available"
                       value="{{ old('quantity_available') ?? $product->quantity_available }}"
                       required>
            </div>
            <div class="col">
                <label for="quantity_sold" class="form-label">Quantity Sold</label>
                <input type="number" step="1" class="form-control" name="quantity_sold"
                       value="{{ old('quantity_sold') ?? $product->quantity_sold }}">
            </div>
        </div>
        <div class="mb-3">
            <label for="product_category" class="form-label">Product Category<small class="text-danger"></small></label>
            <select step="1" class="form-control" name="product_category">
                <option value="">-- Select None --</option>
                @foreach (\App\Models\ProductCategory::all() as $pc)
                    <?php $selected = ""; ?>
                    @isset($product->ProductCategory)
                        @if($pc->id == $product->ProductCategory->id)
                            <?php $selected = "selected=\"selected\""; ?>
                        @endif
                    @endisset
                    <option value="{{ $pc->id }}" {{ $selected }}>{{ $pc->name }}, Id: {{ $pc->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description"
                      class="form-control ckeditor">{!! old('description') ?? $product->description !!}</textarea>
            <div class="form-text">Write about the product in the description.</div>
        </div>
        <input type="submit" value="Save Product" class="btn btn-primary float-right">
    </form>
    <br>
    <br>
    <br>
@endsection
