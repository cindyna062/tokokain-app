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
                    <h4>New here?</h4>
                    <h6 class="font-weight-light">Daftar, Isi Semua form</h6>
                    <form class="pt-3" method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Username -->
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                id="exampleInputUsername1" name="name" placeholder="name" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-lg @error('username') is-invalid @enderror"
                                id="exampleInputName1" name="username" placeholder="Username" value="{{ old('username') }}"
                                required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
                                id="exampleInputEmail1" name="email" placeholder="Email" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                id="exampleInputPassword1" name="password" placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="form-group">
                            <input type="password" class="form-control form-control-lg"
                                id="exampleInputPasswordConfirmation1" name="password_confirmation"
                                placeholder="Confirm Password" required>
                        </div>

                        <!-- Terms -->
                        <div class="mb-4">
                            <div class="form-check">
                                <label class="form-check-label text-muted">
                                    <input type="checkbox" class="form-check-input" name="terms" required> Aku Menyetujui
                                    semua Terms & Conditions
                                </label>
                            </div>
                        </div>

                        <div class="mt-3 d-grid gap-2">
                            <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                                type="submit">SIGN UP</button>
                        </div>
                        <div class="text-center mt-4 font-weight-light"> Udah Punya Akun? <a href="login.html"
                                class="text-primary">Masuk siniii</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
