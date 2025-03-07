@extends('frontpanel.layouts.app')

@section('content')
    <div class="m-0 p-0" id="appContent" style="min-height: 234.016px;">
        <div class="breadcrumb-wrap">
            <div class="container d-flex justify-content-between">
                <ul class="breadcrumb">
                    <li>
                        <i class="bi bi-house-door-fill home-icon"></i>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <a href="/account">Account</a>
                    </li>
                </ul>

            </div>
        </div>


        <div class="container">
            <div class="row">
                @include('frontpanel.account.components.side')
                <div class="col-12 col-lg-9">
                    <div class="account-card-box account-info">
                        <div class="account-card-title d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Hi, {{ Auth::user()->username }}</span>
                            <a href="/account/edit" class="text-secondary">Edit Profile <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>

                        <div class="account-data">
                            <div class="row">
                                <div class="col-6 col-md-4">
                                    <div class="account-item-data">
                                        <div class="value">0</div>
                                        <div class="title text-secondary">Orders</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="account-item-data">
                                        <div class="value">0</div>
                                        <div class="title text-secondary">Favorites</div>
                                    </div>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="account-item-data">
                                        <div class="value">0</div>
                                        <div class="title text-secondary">Addresses</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="account-card-title d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Orders</span>
                            <a href="/account/orders" class="text-secondary">View All <i
                                    class="bi bi-arrow-right"></i></a>
                        </div>

                        <div class="no-order alert">
                            <a href="">
                                <i class="bi bi-check-lg"></i>
                                <span class="\\&quot;text-decoration-underline\\&quot;">Make your first order</span>
                                <span>You haven't placed any orders yet. </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
