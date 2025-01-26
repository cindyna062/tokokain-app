@extends('layouts.guest')

@section('content')
    <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">
                    <div class="brand-logo">
                        <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img
                                src="{{ asset('assets/logo/logo-panjang.svg') }}" style="height: 60px" alt="logo" /></a>
                        {{-- <h2 class="brand-logo" style=" color: #9a55ff">TOKOKAIN.</h2> --}}
                    </div>
                    <h4>Hello! Ayo Mulai Belanja</h4>
                    <h6 class="font-weight-light">Login doloo....</h6>
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </div>
                    @endif
                    <form class="forms-sample" action="" method="POST">
                        @csrf
                        <div class="mt-3 mb-3">
                            <input type="text" class="form-control" name="username" id="username"
                                value="{{ old('username') }}" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                autocomplete="current-password" placeholder="Password">
                        </div>
                        <div>
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2 mb-2 mb-md-4">Login</button>
                        </div>
                    </form>
                    <div class="my-2 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <label class="form-check-label text-muted">
                                <input type="checkbox" class="form-check-input" name="remember"> Ingat Saya </label>
                        </div>
                        <a href="#" class="auth-link text-primary">Lupa Password?</a>
                    </div>
                    <div class="text-center mt-4 font-weight-light"> Gapunya Akun? <a href="/register"
                            class="text-primary">Buat la bang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
