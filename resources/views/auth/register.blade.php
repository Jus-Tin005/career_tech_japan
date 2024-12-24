@extends('auth.partials.app')

@section('auth_content')

<div class="row vh-100">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
                <h1 class="h2">Let's get start!</h1>
                <p class="lead">
                    Start creating the best possible user experience for your customers.
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="m-sm-3">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" class="form-control form-control-lg @error('name') is-invalid @enderror" type="text" name="name" :value="old('name')" autofocus autocomplete="name" placeholder="Enter your name"/>
                                @error('name')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" autocomplete="username" placeholder="Enter your email"/>
                                @error('email')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" type="password" name="password" autocomplete="new-password" placeholder="Enter password" />
                                @error('password')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" autocomplete="new-password"/>
                                @error('password_confirmation')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Sign up</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                Already have account?
                <a href="{{ route('login') }}">Log In</a>
            </div>
        </div>
    </div>
</div>
@endsection
