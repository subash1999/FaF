@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <div class="container ml-4 mr-4">
        <br>
        <h3 class="text-center">Show Customer : {{ $customer->name }}</h3>
        <br>
        <h6>ID: <b>{{ $customer->id }}</b></h6>
        <h6>Name: <b>{{ $customer->name }}</b></h6>
        <h6>Email: <b>{{ $customer->email }}</b></h6>
        <h6>Street Address: <b>{{ $customer->street_address }}</b></h6>
        <h6>City: <b>{{ $customer->city }}</b></h6>
        <h6>State: <b>{{ $customer->state }}</b></h6>
        <h6>Postal Code: <b>{{ $customer->postal_code }}</b></h6>
        <h6>Phone 1: <b>{{ $customer->phone1 }}</b></h6>
        <h6>Phone 2: <b>{{ $customer->phone2 }}</b></h6>
        <hr>
        <p>Created at: {{ $customer->created_at }}</p>
        <p>Updated at: {{ $customer->updated_at }}</p>

        <br>
        <br>
    </div>
@endsection
