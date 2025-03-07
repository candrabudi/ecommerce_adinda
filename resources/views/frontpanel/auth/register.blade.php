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
                        <a href="{{ route('frontpanel.user.register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="login-register-box">
                <div class="login-title">Daftar</div>
                <div class="login-sub-title">Silakan isi informasi pendaftaran pada formulir di bawah ini</div>
                <form action="{{ route('frontpanel.user.register.process') }}" method="POST" class="needs-validation form-wrap" novalidate="">
                    @csrf
                    <div class="form-group mb-4">
                        <input id="username" type="text" class="form-control" name="username" value=""
                               required="" autocomplete="username" placeholder="Username">
                        <span class="invalid-feedback" role="alert"><strong>Mohon masukkan username Anda</strong></span>
                    </div>

                    <div class="form-group mb-4">
                        <input id="email" type="email" class="form-control" name="email" value=""
                               required="" autocomplete="email" placeholder="Email">
                        <span class="invalid-feedback" role="alert"><strong>Mohon masukkan email Anda</strong></span>
                    </div>

                    <div class="form-group mb-4">
                        <input id="password" type="password" class="form-control" name="password" required=""
                               autocomplete="new-password" placeholder="Kata Sandi">
                        <span class="invalid-feedback" role="alert"><strong>Mohon masukkan kata sandi Anda</strong></span>
                    </div>

                    <div class="btn-submit">
                        <button type="submit" class="btn btn-primary form-submit btn-lg">Daftar Sekarang</button>
                        <a href="{{ route('frontpanel.user.login') }}">Sudah punya akun? Masuk <i class="bi bi-arrow-up-right-square"></i></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
