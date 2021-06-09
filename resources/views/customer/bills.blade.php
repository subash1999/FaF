@extends('layouts.customer-dashboard-layout')
@section('customer-content')
    <h2 class="text-center text-break m-3">My Bills</h2>
    <table class="table table-striped w-100 datatable">
        <thead>
        <th>SN</th>
        <th>Bill Id</th>
        <th>Name</th>
        <th>Total Price</th>
        <th>Total Discount</th>
        <th>Final Total Price</th>
        <th>View Bill</th>
        </thead>
        <tbody>
        @foreach($bills as $bill)
            <tr>
                <td>{{ $loop->index + 1 }}</td>
                <td>{{ $bill->id }}</td>
                <td>{{ $bill->name }}</td>
                <td>${{ $bill->total_price }}</td>
                <td>${{ $bill->total_discount }}</td>
                <td>${{ $bill->final_total_price }}</td>
                <td><a href="{{ route('customer.bills.show',$bill->id) }}"
                       class="btn btn-sm btn-outline-primary"><small>View Bill</small></a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
