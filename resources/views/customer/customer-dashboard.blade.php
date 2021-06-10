{{--https://www.youtube.com/watch?v=QV4hod3j5CQ&list=PL8p2I9GklV47EWeJZlC-_dgj7kdBWYd56&index=13&ab_channel=CodeStepByStepCodeStepByStep--}}
@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <br>
    <h3 class="text-center">Summary Table</h3>
    <br>
    <table class="table table-striped">
        <thead>
        <th>Name</th>
        <th>Count</th>
        <th>View All</th>
        </thead>
        <tbody>
        <tr>
            <th>Cart</th>
            <td>{{ \App\Models\Cart::where('user_id',auth()->user()->id)->get()->count() }}</td>
            <td><a href="{{ route('customer.carts.index') }}" class="btn btn-outline-info">View Cart</a></td>
        </tr>
        <tr>
            <th>Wishlist</th>
            <td>{{ \App\Models\Wishlist::where('user_id',auth()->user()->id)->get()->count() }}</td>
            <td><a href="{{ route('customer.wishlist.index') }}" class="btn btn-outline-info">View Wishlist</a></td>
        </tr>
        <tr>
            <th>My Bills</th>
            <td>{{ \App\Models\Bill::where('user_id',auth()->user()->id)->get()->count() }}</td>
            <td><a href="{{ route('customer.bills.index') }}" class="btn btn-outline-info">View Bills</a></td>
        </tr>
        <tr>
            <th>My Orders</th>
            <td>{{ \App\Models\Order::where('user_id',auth()->user()->id)->get()->count() }}</td>
            <td><a href="{{ route('customer.orders.index') }}" class="btn btn-outline-info">View Orders</a></td>
        </tr>

        </tbody>
    </table>
@endsection
