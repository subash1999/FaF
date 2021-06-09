@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Product Categories</h3>
    <br>
    <table class="table w-100 datatable">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>No of Products</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach($pcs as $pc)
            <tr>
                <td>{{ $pc->id }}</td>
                <td>{{ $pc->name }}</td>
                <td>{{ $pc->Products->count() }}</td>
                <td><a href="{{ route('admin.product-categories.show',[$pc->id]) }}"
                       class="btn btn-sm btn-outline-primary">View</a></td>
                <td><a href="{{ route('admin.product-categories.edit',[$pc->id]) }}"
                       class="btn btn-sm btn-outline-secondary">Edit</a></td>
                <td>
                    <form action="{{ route('admin.product-categories.destroy',[$pc->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete product category with id {{ $pc->id }}?');">
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
