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
                    <div class="account-card-box wishlist-box">
                        <div class="account-card-title d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Favorites</span>
                        </div>

                        <div class="d-flex align-items-center flex-column py-5">
                            <img src="https://demo.innoshop.cn/icon/no-data-3.svg" class="img-fluid mb-4"
                                style="width: 300px">
                            <span class="fs-4 text-secondary">No data ~</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
