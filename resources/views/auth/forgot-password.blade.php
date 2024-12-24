@extends('auth.partials.app')

@section('auth_content')

<div class="row vh-100">
    <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
        <div class="d-table-cell align-middle">

            <div class="text-center mt-4">
                <h1 class="h2">Forgot your password?</h1>
                <p class="lead">
                    No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="m-sm-3">

                        {{-- Session Status  --}}
                        <span class="mb-4">{{ session('status') }}</span>

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" autofocus placeholder="Enter your email"/>
                                @error('email')
                                    <span class="mt-2 invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="d-grid gap-2 mt-3">
                                <button type="submit" class="btn btn-lg btn-primary">Email Password Reset Link</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
