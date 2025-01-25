@extends('front.layouts.app')

@section('title', 'Login')

@section('content')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-6">

                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Login</h1>

                        <form action="{{ route('login.authenticate') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror  @if(Session::has('error')) is-invalid @endif"
                                    placeholder="Enter Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror @if(Session::has('error')) is-invalid @endif"
                                    placeholder="Enter Password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if (Session::has('error'))
                                    <div class="invalid-feedback">{{ Session::get('error') }}</div>
                                @endif
                            </div>

                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Login</button>
                                <a href="forgot-password.html" class="mt-3">Forgot Password?</a>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4 text-center">
                        <p>Do not have an account? <a href="{{ route('registration') }}">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-2">&nbsp;</div>
        </div>
    </section>
@endsection
