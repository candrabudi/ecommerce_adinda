@extends('frontpanel.layouts.app')

@section('content')
    <section class="module-line">
        <div class="breadcrumb-wrap">
            <div class="container d-flex justify-content-between">
                <ul class="breadcrumb">
                    <li>
                        <i class="bi bi-house-door-fill home-icon"></i>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('frontpanel.products.detail', $product->id) }}">{{ $product->name }}</a>
                    </li>
                </ul>

            </div>
        </div>

        <div class="container">
            <div class="page-product-top">
                <div class="row">
                    <div class="col-12 col-lg-6 product-left-col">
                        <div class="product-images">
                            <div class="swiper" id="sub-product-img-swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($product->images as $image)
                                        <div class="swiper-slide" style="background-image: url('{{ asset('storage/' . $image->image_path) }}'); background-size: cover; background-position: center; width: 100%; height: 500px;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="product-info">
                            <h1 class="product-title">{{ $product->name }}</h1>
                            <div class="product-price">
                                <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if ($product->discount)
                                    <span class="discount">-{{ $product->discount }}%</span>
                                @endif
                            </div>
                            <div class="product-categories">
                                <strong>Categories:</strong>
                                <ul>
                                    @foreach ($product->categories as $category)
                                        <li>{{ $category->name }}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="stock-wrap">
                                @if ($product->stock > 0)
                                    <div class="in-stock badge">In Stock</div>
                                @else
                                    <div class="out-stock badge">Out of Stock</div>
                                @endif
                            </div>

                            <div class="long-description mt-2">
                                <p>{{ $product->long_description }}</p>
                            </div>

                            <div class="product-details mt-4">
                                <strong>Product Details:</strong>
                                <ul>
                                    <li>Stock: {{ $product->stock }} pcs</li>
                                    <li>Price: Rp {{ number_format($product->price, 0, ',', '.') }}</li>
                                    <li>Discount: {{ $product->discount }}%</li>
                                </ul>
                            </div>

                            <div class="product-info-bottom mt-4">
                                <div class="quantity-wrap">
                                    <div class="minus"><i class="bi bi-dash-lg"></i></div>
                                    <input type="number" class="form-control product-quantity">
                                    <div class="plus"><i class="bi bi-plus-lg"></i></div>
                                </div>

                                <div class="product-info-btns mt-3">
                                    <button class="btn btn-primary add-cart" data-id="{{ $product->id }}"
                                        data-price="{{ $product->price }}">
                                        Add to Cart
                                    </button>
                                    <button class="btn buy-now ms-2" data-id="{{ $product->id }}"
                                        data-price="{{ $product->price }}">
                                        Buy Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/photoswipe@5/dist/photoswipe.css">
        <script src="https://unpkg.com/photoswipe@5/dist/photoswipe.min.js"></script>


        <style>
            .product-images .main-product-img {
                width: 100%;
                height: 200px;
                background-size: cover;
                background-position: center;
                position: relative;
            }

            .product-images .main-product-img .overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .product-images .main-product-img:hover .overlay {
                opacity: 1;
            }

            .product-images .main-product-img .overlay i {
                font-size: 2rem;
                color: white;
            }

            .product-images .sub-product-imgs img {
                width: 80px;
                height: 80px;
                margin-right: 10px;
                object-fit: cover;
            }

            .product-images .sub-product-imgs a {
                display: inline-block;
                margin-bottom: 10px;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.querySelectorAll('.lightbox-trigger').forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault();

                    const lightbox = new PhotoSwipeLightbox({
                        gallery: '#gallery',
                        children: 'a',
                        pswpModule: () => PhotoSwipe
                    });
                    lightbox.init();

                    const items = [{
                        src: this.href,
                        w: 800,
                        h: 800
                    }];

                    lightbox.loadAndOpen(0, items);
                });
            });
        </script>
    @endpush
@endsection
