@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Customers</h3>
    <br>
    <table class="table w-100 datatable">
        <thead>
        <th>S.N.</th>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Street Address</th>
        <th>City</th>
        <th>State</th>
        <th>Postal Code</th>
        <th>View</th>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <td>{{ $loop->index +1 }}</td>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->street_address }}</td>
            <td>{{ $customer->city }}</td>
            <td>{{ $customer->state }}</td>
            <td>{{ $customer->postal_code }}</td>
            <td><a href="{{ route('admin.customers.show',$customer->id) }}" class="btn btn-outline-primary">View</a></td>
        @endforeach

        </tbody>
    </table>
@endsection
