@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <h2 class="text-center text-break m-3">Orders</h2>
    <table class="table table-striped w-100 datatable">
        <thead>
        <th>SN</th>
        <th>Order Id</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Discount</th>
        <th>Final Price</th>
        <th>Total</th>
        <th>Shipping Status</th>
        <th>View Bill</th>
        <th>User</th>
        <th>View</th>
        <th>Edit</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $order->id }}</td>
                <td><a href="{{ route('admin.products.show',$order->Product->id) }}"
                       class=""><small>{{ $order->Product->name }}</small></a></td>
                <td>{{ $order->quantity }}</td>
                <td>${{ $order->price }}</td>
                <td>@isset($order->discount) $@endisset{{ $order->discount }}</td>
                <td>${{ $order->final_price }}</td>
                <td>${{ ($order->quantity*$order->final_price) }}</td>
                <th>{{ $order->Shipping->shipping_status }}</th>
                <td><a href="{{ route('admin.bills.show',$order->Bill->id) }}"
                       class="btn btn-sm btn-outline-primary"><small>View Bill : {{ $order->Bill->id }}</small></a></td>
                <td>@isset($order->User)<a href="{{ route('admin.customers.show',$order->User->id) }}">{{ $order->User->name }}</a>@endisset</td>
                <td><a href="{{ route('admin.orders.show',[$order->id]) }}"
                       class="btn btn-sm btn-outline-primary">View</a></td>
                <td><a href="{{ route('admin.orders.edit',[$order->id]) }}"
                       class="btn btn-sm btn-outline-secondary">Edit</a></td>
                <td>
                    <form action="{{ route('admin.orders.destroy',[$order->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete order with id {{ $order->id }}?');">
                        @method('delete')
                        @csrf
                        <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
