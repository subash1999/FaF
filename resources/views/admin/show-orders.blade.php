@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <h2 class="text-center text-break m-3">Show Order : {{ $order->id }}
        <div class="float-right">
            <a href="{{ route('admin.orders.edit',$order->id) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
            <form action="{{ route('admin.orders.destroy',[$order->id]) }}" method="POST"
                  onsubmit="return confirm('Do you really want to delete order with id {{ $order->id }}?');">
                @method('delete')
                @csrf
                <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
            </form>
        </div>
    </h2>
    <h6>Order Id : <b>{{ $order->id }}</b></h6>
    <h6>Product Name : <a href="{{ route('admin.products.show',$order->Product->id) }}">{{ $order->Product->name }}</a>
    </h6>
    <h6>Quantity : <b>${{ $order->quantity }}</b></h6>
    <h6>Price : <b>${{ $order->price }}</b></h6>
    <h6>Discount : <b>${{ $order->discount }}</b></h6>
    <h6>Final Price : <b>${{ $order->final_price }}</b></h6>
    <h6>Total : <b>${{ $order->final_price * $order->quantity }}</b></h6>
    <h6>View Bill : <a href="{{ route('admin.bills.show',$order->Bill->id) }}">Bill : {{ $order->Bill->id }}</a></h6>
    <h6>User : @isset($order->User)<a href="{{ route('admin.customers.show', $order->User->id) }}">{{ $order->User->name }}</a>@endisset</h6>
    <hr>
    <h4><u>Shipping</u></h4>
    <h6>User : @isset($order->Shipping->User)<a href="{{ route('admin.customers.show', $order->Shipping->User->id) }}">{{ $order->Shipping->User->name }}</a>@endisset</h6>
    <h6>Name : <b>{{ $order->Shipping->name }}</b></h6>
    <h6>Street Address 1 : <b>{{ $order->Shipping->street_address1 }}</b></h6>
    <h6>Street Address 2 : <b>{{ $order->Shipping->street_address2 }}</b></h6>
    <h6>City : <b>{{ $order->Shipping->city }}</b></h6>
    <h6>State : <b>{{ $order->Shipping->state }}</b></h6>
    <h6>Country : <b>{{ $order->Shipping->country }}</b></h6>
    <h6>Postal Code : <b>{{ $order->Shipping->postal_code }}</b></h6>
    <h6>Shipping Status : <b>{{ $order->Shipping->shipping_status }}</b></h6>
    <br>
    <br>
@endsection
