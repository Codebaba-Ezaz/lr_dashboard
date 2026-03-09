@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Login</h4>
            </div>
            <div class="card-body">

                {{-- success message after registration --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- error message --}}
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- show validation errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    {{-- email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>

                    {{-- password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="Enter your password" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don't have an account? <a href="{{ route('register') }}">Register here</a>
                </p>

            </div>
        </div>
    </div>
</div>
@endsection
