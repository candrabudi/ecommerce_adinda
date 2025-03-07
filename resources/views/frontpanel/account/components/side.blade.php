<div class="col-12 col-lg-3">
    <div class="account-sidebar">
        <div class="account-user">
            <div class="profile"><img src="https://cdn-icons-png.flaticon.com/512/847/847969.png " class="img-fluid"></div>
            <div class="account-name">
                <div class="fw-bold name">Hi, {{ Auth::user()->username }}</div>
                <div class="text-secondary email">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <ul class="account-links">
            <li class="{{ Request::is('account') ? 'active' : '' }}">
                <a href="/account"><i class="bi bi-person"></i>Account</a>
            </li>

            <li class="{{ Request::is('account/orders') ? 'active' : '' }}">
                <a href="/account/orders"><i class="bi bi-clipboard2-check"></i>Orders</a>
            </li>

            <li class="{{ Request::is('account/favorites') ? 'active' : '' }}">
                <a href="/account/favorites"><i class="bi bi-heart"></i>Favorites</a>
            </li>

            <li class="{{ Request::is('account/addresses') ? 'active' : '' }}">
                <a href="/account/addresses"><i class="bi bi-geo-alt"></i>Addresses</a>
            </li>

            <li class="{{ Request::is('account/order_returns') ? 'active' : '' }}">
                <a href="/account/order_returns"><i class="bi bi-backpack"></i>RMA</a>
            </li>

            <li class="{{ Request::is('account/edit') ? 'active' : '' }}">
                <a href="/account/edit"><i class="bi bi-pen"></i>Edit Profile</a>
            </li>

            <li class="{{ Request::is('account/password') ? 'active' : '' }}">
                <a href="/account/password"><i class="bi bi-shield-lock"></i>Password</a>
            </li>

            <li>
                <a href="/account/logout"><i class="bi bi-box-arrow-left"></i>Logout</a>
            </li>
        </ul>
    </div>
</div>
