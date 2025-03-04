<div class="header-desktop">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="left">
            <h1 class="logo">
                <a href="en.html">
                    <img src="images/logo.png" class="img-fluid">
                </a>
            </h1>
            <div class="menu">
                <nav class="navbar navbar-expand-md navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="en.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" href="en/category-hijab-collections.html">Hijab Collections</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="en/category-casual-hijab.html">Casual Hijab</a>
                                    </li>
                                    <li><a class="dropdown-item" href="en/category-formal-hijab.html">Formal Hijab</a>
                                    </li>
                                    <li><a class="dropdown-item" href="en/category-sport-hijab.html">Sport Hijab</a>
                                    </li>
                                    <li><a class="dropdown-item" href="en/category-modest-wear.html">Modest Wear</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link" href="en/category-hijab-accessories.html">Hijab Accessories</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="en/category-pins.html">Hijab Pins</a></li>
                                    <li><a class="dropdown-item" href="en/category-scarves.html">Scarves</a></li>
                                    <li><a class="dropdown-item" href="en/category-inner-caps.html">Inner Caps</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="en/about.html">About</a>
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
                            <img src="icon/account.svg" class="img-fluid">
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="en/login.html" class="dropdown-item">Login</a>
                            <a href="en/register.html" class="dropdown-item">Register</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" onclick="wishlistComingSoon()">
                        <img src="icon/love.svg" class="img-fluid">
                        <span class="icon-quantity">0</span>
                    </a>
                </div>
                <div class="item">
                    <a href="javascript:void(0);" onclick="addToCart()">
                        <img src="icon/cart.svg" class="img-fluid">
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
