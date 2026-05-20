@extends('layouts.app')
@section('content')

    <div class="container animate-in">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <p class="section-kicker">Welcome back</p>
                            <h1 class="section-title h2">Login</h1>
                        </div>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('login') }}" method="post">@csrf
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" name="email" value="{{ old('email') }}"
                                    class="form-control @error('email') is-invalid @enderror" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group d-flex flex-column flex-sm-row justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}">Forgot password?</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Login</button>

                            <hr>
                            <a class="btn btn-facebook btn-block" href="{{ url('auth/facebook') }}">
                                <i class="fab fa-facebook mr-2"></i>Login with Facebook
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
