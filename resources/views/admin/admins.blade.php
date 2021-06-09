@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Admins</h3>
    <br>
    <table class="table w-100 datatable">
        <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>View</th>
        <th>Delete</th>
        </thead>
        <tbody>
        @foreach($admins as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>
                    <a href="{{ route('admin.admins.show', $admin->id ) }}" class="btn btn-sm btn-outline-primary">View</a>
                </td>
                <td>
                    <form action="{{ route('admin.admins.destroy',[$admin->id]) }}" method="POST"
                          onsubmit="return confirm('Do you really want to delete admin with id {{ $admin->id }}?');">
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
