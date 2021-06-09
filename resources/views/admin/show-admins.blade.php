@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <div class="container ml-4 mr-4">
        <br>
        <h3 class="text-center">Show Admin : {{ $admin->name }}</h3>
        <h6 class="float-right">
            <form action="{{ route('admin.admins.destroy',[$admin->id]) }}" method="POST"
                  onsubmit="return confirm('Do you really want to delete admin with id {{ $admin->id }}?');">
                @method('delete')
                @csrf
                <input type="Submit" class="btn btn-sm btn-danger" value="Delete">
            </form>

        </h6>
        <br>
        <h6>ID: <b>{{ $admin->id }}</b></h6>
        <h6>Name: <b>{{ $admin->name }}</b></h6>
        <h6>Email: <b>{{ $admin->email }}</b></h6>
        <hr>
        <p>Created at: {{ $admin->created_at }}</p>
        <p>Updated at: {{ $admin->updated_at }}</p>

        <br>
        <br>
    </div>
@endsection
