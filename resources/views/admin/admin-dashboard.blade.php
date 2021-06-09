@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Summary Table</h3>
    <br>
    <table class="table table-striped">
        <thead>
        <th>Name</th>
        <th>Count</th>
        <th>View All</th>
        <th>Add New</th>
        </thead>
        <tbody>
        <tr>
            <td>Product Categories</td>
            <td>{{ \App\Models\ProductCategory::all()->count() }}</td>
            <td><a href="{{ route('admin.product-categories.index') }}" class="btn btn-outline-info">View All Product Categories</a></td>
            <td><a href="{{ route('admin.product-categories.create') }}" class="btn btn-outline-success">Add New Product Category</a></td>
        </tr>
        <tr>
            <td>Products</td>
            <td>{{ \App\Models\Product::all()->count() }}</td>
            <td><a href="{{ route('admin.products.index') }}" class="btn btn-outline-info">View All Products</a></td>
            <td><a href="{{ route('admin.products.create') }}" class="btn btn-outline-success">Add New Product</a></td>
        </tr>
        <tr>
            <td>Customers</td>
            <td>{{ \App\Models\User::where('user_type','customer')->get()->count() }}</td>
            <td><a href="{{ route('admin.customers.index') }}" class="btn btn-outline-info">View All Customers</a></td>
            <td></td>
        </tr>
        <tr>
            <td>Admins</td>
            <td>{{ \App\Models\User::where('user_type','admin')->get()->count() }}</td>
            <td><a href="{{ route('admin.admins.index') }}" class="btn btn-outline-info">View All Admins</a></td>
            <td><a href="{{ route('admin.admins.create') }}" class="btn btn-outline-success">Add New Admin</a></td>
        </tr>
        <tr>
            <td>Orders</td>
            <td>{{ \App\Models\Order::all()->count() }}</td>
            <td><a href="{{ route('admin.orders.index') }}" class="btn btn-outline-info">View All Orders</a></td>
            <td></td>
        </tr>
        <tr>
            <td>Bills</td>
            <td>{{ \App\Models\Bill::all()->count() }}</td>
            <td><a href="{{ route('admin.bills.index') }}" class="btn btn-outline-info">View All Bills</a></td>
            <td></td>
        </tr>

        </tbody>
    </table>
@endsection
