@extends('frontpanel.layouts.app')

@section('content')
    <div class="m-0 p-0" id="appContent" style="min-height: 234.016px;">
        <div class="breadcrumb-wrap">
            <div class="container d-flex justify-content-between">
                <ul class="breadcrumb">
                    <li>
                        <i class="bi bi-house-door-fill home-icon"></i>
                        <a href="{{ route('frontpanel.home') }}">Beranda</a>
                    </li>
                    <li>
                        <a href="{{ route('frontpanel.user.login') }}">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="login-register-box ">
                <div class="login-title">Masuk</div>
                <div class="login-sub-title">Silakan masukkan username atau email serta kata sandi Anda untuk masuk</div>

                <form action="{{ route('frontpanel.user.login.process') }}" method="POST" class="needs-validation form-wrap" novalidate>
                    @csrf 

                    <div class="form-group mb-4">
                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login"
                            value="{{ old('login') }}" required autocomplete="username" placeholder="Username atau Email">
                        
                        @error('login')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password" placeholder="Kata Sandi">
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="btn-submit">
                        <button type="submit" class="btn btn-primary form-submit btn-lg">Masuk Sekarang</button>
                        <a href="{{ route('frontpanel.user.register') }}">Belum punya akun? Daftar <i class="bi bi-arrow-up-right-square"></i></a>
                    </div>

                    @if ($errors->has('login'))
                        <div class="alert alert-danger mt-3">
                            <strong>{{ $errors->first('login') }}</strong>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
