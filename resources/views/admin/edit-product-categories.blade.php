@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Edit Product Category : {{ $pc->name }}</h3>
    <br>
    <form action="{{ route('admin.product-categories.update',[$pc->id]) }}" method="POST" class="ml-6 mr-6 mb-6">
        @method("put")
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
            <input type="text" class="form-control" name="name" required value="{{ $pc->name }}">
        </div>
        <div class="mb-3">
            <label for="description">Description</label>
            <textarea name="description"
                      class="form-control ckeditor">{!! $pc->description !!}</textarea>
            <div class="form-text">Write about what kind of products do you enter in this category.</div>
        </div>
        <input type="submit" value="Update Product Category" class="btn btn-primary float-right">
    </form>
    <br>
    <br>
    <br>
@endsection
