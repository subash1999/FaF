@extends('layouts.admin-dashboard-layout')
@section('admin-content')
    <br>
    <h3 class="text-center">Create Admin</h3>
    <br>
    <form action="{{ route('admin.admins.store') }}" method="POST" class="ml-6 mr-6 mb-6"
          enctype="multipart/form-data">
    @method("POST")
    @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="mb-3 row">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3 row">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
        </div>
        <div class="mb-3 row">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
        </div>
        <div class="mb-3 row">
            <label for="password_confirmation" class="form-label">Password Confirmation</label>
            <input type="password" class="form-control" name="password_confirmation" required>
        </div>
        <input type="submit" value="Add Admin" class="btn btn-success float-right">
    </form>
    <br>
    <br>
    <br>
    <br>
@endsection
