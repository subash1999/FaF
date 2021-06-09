@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <h2 class="text-center text-break m-3">Edit Order : {{ $order->id }}
        <div class="float-right">
            <a href="{{ route('admin.orders.show',$order->id) }}" class="btn btn-outline-primary btn-sm">View</a>
            <form action="{{ route('admin.orders.destroy',[$order->id]) }}" method="POST"
                  onsubmit="return confirm('Do you really want to delete order with id {{ $order->id }}?');">
                @method('delete')
                @csrf
                <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
            </form>
        </div>
    </h2>
    <h6 class="text-center text-info">You can only edit shipping status</h6>
    <h6>Order Id : <b>{{ $order->id }}</b></h6>
    <h6>Product Name : <a href="{{ route('admin.products.show',$order->Product->id) }}">{{ $order->Product->name }}</a>
    </h6>
    <h6>Quantity : <b>${{ $order->quantity }}</b></h6>
    <h6>Price : <b>${{ $order->price }}</b></h6>
    <h6>Discount : <b>${{ $order->discount }}</b></h6>
    <h6>Final Price : <b>${{ $order->final_price }}</b></h6>
    <h6>Total : <b>${{ $order->final_price * $order->quantity }}</b></h6>
    <h6>View Bill : <a href="{{ route('admin.bills.show',$order->Bill->id) }}">Bill : {{ $order->Bill->id }}</a></h6>
    <h6>User : <a href="{{ route('admin.customers.show', $order->User->id) }}">{{ $order->User->name }}</a></h6>
    <hr>
    <h4><u>Shipping</u></h4>
    <h6>User : <a href="{{ route('admin.customers.show', $order->Shipping->User->id) }}">{{ $order->Shipping->User->name }}</a></h6>
    <h6>Name : <b>{{ $order->Shipping->name }}</b></h6>
    <h6>Street Address 1 : <b>{{ $order->Shipping->street_address1 }}</b></h6>
    <h6>Street Address 2 : <b>{{ $order->Shipping->street_address2 }}</b></h6>
    <h6>City : <b>{{ $order->Shipping->city }}</b></h6>
    <h6>State : <b>{{ $order->Shipping->state }}</b></h6>
    <h6>Country : <b>{{ $order->Shipping->country }}</b></h6>
    <h6>Postal Code : <b>{{ $order->Shipping->postal_code }}</b></h6>
    <h6>Shipping Status :
        <br>
        <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">
            @csrf
            @method('put')
            <input type="text" name="shipping_status" id="shipping_status"
                   value="{{ $order->Shipping->shipping_status }}"
                   class="form-control" list="shipping_lists">
            <datalist id="shipping_lists">
                <option value="Pending"></option>
                <option value="Processing"></option>
                <option value="Ready to Ship"></option>
                <option value="Shipped"></option>
                <option value="Delivered"></option>
                <option value="Could not be Delivered"></option>
                <option value="Cancelled"></option>
                <option value="Cancelled by Admin"></option>
                <option value="Cancelled on Customer Request"></option>
            </datalist>
            <br>
            <input type="submit" class="btn btn-success" value="Update Shipping Status">
        </form>
    </h6>
    <br>
    <br>
@endsection
