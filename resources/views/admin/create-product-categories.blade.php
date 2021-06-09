@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Create Product Category</h3>
    <br>
    <form action="{{ route('admin.product-categories.store') }}" method="POST" class="ml-6 mr-6 mb-6">
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
            <label for="product_category_name" class="form-label">Product Category Name <small class="text-danger">( Required )</small></label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description"
                      class="form-control ckeditor">{!! old('description') !!}</textarea>
            <div class="form-text">Write about what kind of products do you enter in this category.</div>
        </div>
        <input type="submit" value="Add Product Category" class="btn btn-success float-right">
    </form>
    <br>
    <br>
    <br>
@endsection
