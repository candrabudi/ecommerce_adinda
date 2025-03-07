@php
    use App\Helpers\CategoryHelper;
    $categories = CategoryHelper::getCategories();
@endphp
<div class="header-desktop">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="left">
            <h1 class="logo">
                <a href="en.html">
                    <img src="{{ asset('/storage/' . $web_logo) }}" class="img-fluid">
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
                                    <a class="nav-link dropdown-toggle" href="{{ url('category/' . $category->slug) }}"
                                        id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        {{ $category->name }}
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        @foreach ($category->children as $child)
                                            <li><a class="dropdown-item"
                                                    href="{{ url('category/' . $child->slug) }}">{{ $child->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ url('category/' . $category->slug) }}">{{ $category->name }}</a>
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
            <form action="" method="get" class="search-group">
                <input type="text" class="form-control" name="keyword" placeholder="Search" value="">
                <button type="submit" class="btn"><i class="bi bi-search"></i></button>
            </form>

            <div class="icons">
                @if (Auth::user())
                    <div class="item">
                        <div class="dropdown account-icon">
                            <a class="btn dropdown-toggle px-0" href="account">
                                <img src="{{ asset('frontpanel/icon/account.svg') }}" class="img-fluid">
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="account" class="dropdown-item">Account</a>
                                <a href="account/orders" class="dropdown-item">Orders</a>
                                <a href="account/favorites"
                                    class="dropdown-item">Favorites</a>
                                <a href="account/logout" class="dropdown-item">Logout</a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="item">
                        <div class="dropdown account-icon">
                            <a class="btn dropdown-toggle px-0" href="en/login.html">
                                <img src="{{ asset('frontpanel/icon/account.svg') }}" class="img-fluid">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="/login" class="dropdown-item">Login</a>
                                <a href="/register" class="dropdown-item">Register</a>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="item">
                    <a href="javascript:void(0);" onclick="wishlistComingSoon()">
                        <img src="{{ asset('frontpanel/icon/love.svg') }}" class="img-fluid">
                        <span class="icon-quantity">0</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" onclick="addToCart()">
                        <img src="{{ asset('frontpanel/icon/cart.svg') }}" class="img-fluid">
                        <span class="icon-quantity">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    var isLoggedIn = false;

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
                    window.location.href = "/login";
                }
            });
        } else {
            Swal.fire({
                icon: 'success',
                title: 'Added to Cart',
                text: 'The item has been added to your cart!',
            });
        }
    }

    function wishlistComingSoon() {
        Swal.fire({
            icon: 'info',
            title: 'Coming Soon',
            text: 'Wishlist feature is coming soon!'
        });
    }
</script>
