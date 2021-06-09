@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <h2 class="text-center text-break m-3">Bills</h2>
    <table class="table table-striped w-100 datatable">
        <thead>
        <th>SN</th>
        <th>Bill Id</th>
        <th>Name</th>
        <th>Total Price</th>
        <th>Total Discount</th>
        <th>Final Total Price</th>
        <th>User</th>
        <th>View Bill</th>
        <th>Delete Bill</th>
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
                <td>@isset($bill->User)<a href="{{ route('admin.customers.show',$bill->User->id) }}">{{ $bill->User->name }}</a>@endisset</td>
                <td><a href="{{ route('admin.bills.show',$bill->id) }}"
                       class="btn btn-sm btn-outline-primary"><small>View Bill</small></a></td>
                <th>
                    <form action="{{ route('admin.bills.destroy',[$bill->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete bill with id {{ $bill->id }}? After deleting the bills all the order in the bill will also be deleted');">
                        @method('delete')
                        @csrf
                        <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
                    </form>
                </th>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
