@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between align-items-center bg-dark text-white">
                <h4 class="mb-0">Dashboard</h4>
                {{-- logout button --}}
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
            </div>
            <div class="card-body">

                {{-- show success message after logout if needed --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- welcome the logged in user --}}
                <h5>Welcome, <strong>{{ $user->name }}</strong>!</h5>
                <p class="text-muted">You are successfully logged in.</p>

                <hr>

                {{-- show user info --}}
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $user->phone }}</td>
                    </tr>
                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $user->date_of_birth }}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
