@extends('frontpanel.layouts.app')

@section('content')
    <style>
        .product-grid-item {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .product-grid-item:hover {
            transform: translateY(-5px);
        }

        .product-grid-item .image {
            width: 100%;
            height: 200px;
            /* Atur tinggi gambar */
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .product-grid-item .image a {
            display: block;
            width: 100%;
            height: 100%;
        }
    </style>
    <section class="module-line">
        <div class="swiper" id="module-swiper-1">
            <div class="module-swiper swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide">
                        <a href="#">
                            <img src="{{ asset('storage/' . $banner->image_path) }}" class="img-fluid">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <script>
        var swiper = new Swiper('#module-swiper-1', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>


    <section class="module-line">
        <div class="module-product-tab">
            <div class="container">
                <div class="module-title-wrap">
                    <div class="module-title">Feature Product</div>
                    <div class="module-sub-title">Embrace your style with this chic garment, blending comfort
                        and elegance. A must-have for any occasion, it&#039;s the perfect addition to your
                        wardrobe.</div>

                </div>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="module-product-tab-x-1">
                        <div class="row gx-3 gx-lg-4">
                            @foreach ($products as $product)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product-grid-item">
                                        <div class="image"
                                            style="background-image: url('{{ $product->singleImage ? asset('storage/' . $product->singleImage->image_path) : asset('storage/default-image.jpg') }}');">
                                            <a href=""></a>
                                            <div class="wishlist-container add-wishlist"
                                                data-in-wishlist="{{ $product->in_wishlist }}" data-id="{{ $product->id }}"
                                                data-price="{{ $product->price }}">
                                                <i class="bi bi-heart"></i> Add to Wish List
                                            </div>
                                        </div>
                                        <div class="product-item-info">
                                            <div class="product-name">
                                                <a href="" data-toggle="tooltip" title="{{ $product->name }}"
                                                    data-placement="top">
                                                    {{ $product->name }}
                                                </a>
                                            </div>
                                            <div class="product-bottom">
                                                <div class="product-bottom-btns">
                                                    <div class="btn-add-cart cursor-pointer" data-id="{{ $product->id }}"
                                                        data-price="{{ $product->price }}"
                                                        data-sku-id="{{ $product->sku_id }}">
                                                        Add to cart
                                                    </div>
                                                </div>
                                                <div class="product-price">
                                                    @if ($product->old_price)
                                                        <div class="price-old">
                                                            Rp{{ number_format($product->old_price, 2) }}</div>
                                                    @endif
                                                    <div class="price-new">Rp{{ number_format($product->price, 2) }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
