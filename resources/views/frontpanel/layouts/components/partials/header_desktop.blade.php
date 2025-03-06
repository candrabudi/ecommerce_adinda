@php
    use App\Helpers\CategoryHelper;
    $categories = CategoryHelper::getCategories();
@endphp
<div class="header-desktop">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="left">
            <h1 class="logo">
                <a href="en.html">
                    <img src="{{ asset('/storage/'.$web_logo) }}" class="img-fluid">
                </a>
            </h1>
            <div class="menu">
                <nav class="navbar navbar-expand-md navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        @foreach ($categories as $category)
                            @if ($category->children->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="{{ url('category/'.$category->slug) }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ $category->name }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($category->children as $child)
                                            <li><a class="dropdown-item" href="{{ url('category/'.$child->slug) }}">{{ $child->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('category/'.$category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endif
                        @endforeach
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('about') }}">About</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="right">
            <form action="https://demo.innoshop.cn/en/products" method="get" class="search-group">
                <input type="text" class="form-control" name="keyword" placeholder="Search" value="">
                <button type="submit" class="btn"><i class="bi bi-search"></i></button>
            </form>
            <div class="icons">
                <div class="item">
                    <div class="dropdown account-icon">
                        <a class="btn dropdown-toggle px-0" href="en/login.html">
                            <img src="{{ asset('frontpanel/icon/account.svg') }}" class="img-fluid">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="en/login.html" class="dropdown-item">Login</a>
                            <a href="en/register.html" class="dropdown-item">Register</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" onclick="wishlistComingSoon()">
                        <img src="{{ asset('frontpanel/icon/love.svg') }}" class="img-fluid">
                        <span class="icon-quantity">0</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" onclick="addToCart()">
                        <img src="{{asset('frontpanel/icon/cart.svg') }}" class="img-fluid">
                        <span class="icon-quantity">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Simulasi status login
    var isLoggedIn = false; // Set menjadi 'true' jika pengguna sudah login

    // Fungsi untuk validasi saat menambahkan ke keranjang
    function addToCart() {
        if (!isLoggedIn) {
            Swal.fire({
                icon: 'warning',
                title: 'Not Logged In',
                text: 'Please login to add items to the cart.',
                confirmButtonText: 'Login',
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "en/login.html"; // Arahkan ke halaman login
                }
            });
        } else {
            // Jika sudah login, tambahkan ke keranjang (kode logika penambahan ke keranjang di sini)
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                text: 'The item has been added to your cart!',
            });
        }
    }

    // Fungsi untuk wishlist yang sedang "Coming Soon"
    function wishlistComingSoon() {
        Swal.fire({
            icon: 'info',
            title: 'Coming Soon',
            text: 'Wishlist feature is coming soon!'
        });
    }
</script>
