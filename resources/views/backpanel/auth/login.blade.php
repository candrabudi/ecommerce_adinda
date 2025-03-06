<!doctype html>
<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default"
    data-backpanel-path="{{ asset('backpanel') }}" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Login | Adinda Shop</title>
    <meta property="og:description"
        content="Vuexy is the best bootstrap 5 dashboard for responsive web apps. Streamline your app development process with ease." />
    <meta property="og:site_name" content="Pixinvent" />
    <link rel="canonical"
        href="https://themeforest.net/item/vuexy-vuejs-html-laravel-admin-dashboard-template/23328599" />
    <link rel="icon" type="image/x-icon" href="{{ asset('backpanel/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/fonts/iconify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/libs/@form-validation/form-validation.css') }}" />
    <link rel="stylesheet" href="{{ asset('backpanel/vendor/css/pages/page-auth.css') }}" />
    <script src="{{ asset('backpanel/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('backpanel/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('backpanel/js/config.js') }}"></script>
</head>

<body>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mb-1">Welcome to Adinda Shop! 👋</h4>
                        <p class="mb-6">Masuk untuk melakukan pengelolaan</p>
                        <form id="formAuthentication" class="mb-4" action="{{ route('login.process') }}" method="POST">
                            @csrf
                            <div class="mb-6 form-control-validation">
                                <label for="email-username" class="form-label">Username or Email</label>
                                <input type="text" class="form-control" id="email-username" name="email-username"
                                    placeholder="Enter your email or username" autofocus />
                                @error('email-username')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-6 form-password-toggle form-control-validation">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="••••••••••••" aria-describedby="password" />
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            @if ($errors->has('loginError'))
                                <div class="text-danger mb-4">
                                    {{ $errors->first('loginError') }}
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary d-grid w-100">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
