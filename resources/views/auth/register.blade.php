@extends('layouts.auth')

@section('style')
    <style>
        html,
        body {
            height: 100%;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-signup {
            width: 100%;
            padding: 30px 80px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-signup .form-floating:focus-within {
            z-index: 2;
        }

        .form-signup input[type="text"],
        .form-signup input[type="email"],
        .form-signup input[type="password"] {
            border-radius: 8px;
        }

        .btn-success {
            background: #28a745;
            border: none;
            font-size: 16px;
            font-weight: bold;
        }

        .btn-success:hover {
            background: #218838;
        }

        .text-danger {
            font-size: 14px;
        }

        .alert {
            font-size: 14px;
        }
    </style>
@endsection

@section('content')
    <main class="form-signup">
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="text-center">
                <img class="mb-3 rounded-circle" src="{{ asset('assets/img/login.jpeg') }}" alt="" width="100"
                    height="80" />
                <h1 class="h4 mb-3 fw-bold">Sign Up</h1>
            </div>

            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    id="floatingName" placeholder="Enter your name">
                <label for="floatingName">Full Name</label>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="floatingEmail" placeholder="name@example.com">
                <label for="floatingEmail">Email address</label>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <button class="btn btn-primary w-100 py-2" type="submit">Sign Up</button>

            <div class="text-center mt-3">
                <p> Already have an account? <a href="{{ route('login') }}" class="text-decoration-none text-muted">Sign in</a>
                </p>
            </div>
        </form>
    </main>
@endsection
