<ul class="navbar-nav flex-row align-items-center ms-md-auto">
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown"
            aria-expanded="true">
            <div class="avatar avatar-online">
                <img src="{{ asset('backpanel/img/avatars/1.png') }}" alt="" class="rounded-circle">
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="static">
            <li>
                <a class="dropdown-item mt-0 waves-effect" href="pages-account-settings-account.html">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                                <img src="{{ asset('backpanel/img/avatars/1.png') }}" alt="" class="rounded-circle">
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0">John Doe</h6>
                            <small class="text-body-secondary">Admin</small>
                        </div>
                    </div>
                </a>
            </li>
            <li>
                <div class="d-grid px-2 pt-2 pb-1">
                    <a class="btn btn-sm btn-danger d-flex waves-effect waves-light" href="auth-login-cover.html"
                        target="_blank">
                        <small class="align-middle">Logout</small>
                        <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                    </a>
                </div>
            </li>
        </ul>
    </li>
</ul>
