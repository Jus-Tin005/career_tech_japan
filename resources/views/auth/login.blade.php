@extends('auth.partials.app')

@section('auth_content')

<div class="row vh-100">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
                <h1 class="h2">Welcome back!</h1>
                <p class="lead">
                    Sign in to your account to continue
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="m-sm-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" autocomplete="username" placeholder="Enter your email"/>
                                @error('email')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" autocomplete="current-password" placeholder="Enter password" />
                                @error('password')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <div class="form-check align-items-center">
                                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                    <label class="form-check-label text-small" for="remember_me">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                @if (Route::has('password.request'))
                    <a class="underline text-md" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif
                <br>
                <div class="mt-2">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}">Sign up</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
