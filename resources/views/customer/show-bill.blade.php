{{--https://www.youtube.com/watch?v=QV4hod3j5CQ&list=PL8p2I9GklV47EWeJZlC-_dgj7kdBWYd56&index=13&ab_channel=CodeStepByStepCodeStepByStep--}}
@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <h2 class="text-center text-break m-3">Bill : {{ $bill->id }}</h2>
    <div>
        <h6>Bill ID: <b>{{ $bill->id }}</b></h6>
        <h6>Name: <b>{{ $bill->name }}</b></h6>
        <h6>No of Items in Bill : <b>{{ count($bill->Orders) }}</b></h6>
        <h6>Total Price : <b>${{ $bill->total_price }}</b></h6>
        <h6>Total Discount : <b>${{ $bill->total_discount }}</b></h6>
        <h6>Final Total Price : <b>${{ $bill->final_total_price }}</b></h6>
        <h6>Created at: <b>{{ $bill->created_at }}</b></h6>
        <hr>
        <h4>Orders</h4>
        <table class="table table-striped w-100 datatable">
            <thead>
            <th>SN</th>
            <th>Order Id</th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Final Price</th>
            <th>Total</th>
            <th>Shipping Status</th>
            <th>View Order</th>
            <th>View Bill</th>
            </thead>
            <tbody>
            @foreach ($bill->Orders as $order)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->Product->id }}</td>
                    <td><a href="{{ route('products.show',$order->Product->id) }}">
                            <small>{{ $order->Product->name }}</small></a></td>
                    <td>{{ $order->quantity }}</td>
                    <td>${{ $order->price }}</td>
                    <td>@isset($order->discount) $@endisset{{ $order->discount }}</td>
                    <td>${{ $order->final_price }}</td>
                    <td>${{ ($order->quantity*$order->final_price) }}</td>
                    <th>{{ $order->Shipping->shipping_status }}</th>
                    <td><a href="{{ route('customer.orders.show',$order->id) }}"
                           class="btn btn-sm btn-outline-primary"><small>View Order</small></a></td>
                    <td><a href="{{ route('customer.bills.show',$order->Bill->id) }}"
                           class="btn btn-sm btn-outline-primary"><small>View Bill: {{ $order->Bill->id }}</small></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
