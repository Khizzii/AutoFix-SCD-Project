@extends('layout')

@section('content')
<div class="container d-flex align-items-center justify-content-center" style="min-height: 80vh;">
    <div class="col-md-5">
        <div class="card p-5 border-0 shadow-lg">
            <h2 class="text-center fw-bold mb-4">Welcome Back</h2>

             <!-- Session Status -->
            @if(session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label text-muted">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label text-muted">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label text-muted" for="remember_me">Remember me</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Log in</button>
                </div>

                <div class="text-center mt-3">
                    @if (Route::has('password.request'))
                        <div class="mb-2">
                            <a class="text-muted small text-decoration-none" href="{{ route('password.request') }}">Forgot your password?</a>
                        </div>
                    @endif
                    <div class="small text-muted">
                        Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
