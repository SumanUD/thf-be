<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Labon | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
    <style>
        /* Make product cards clickable */
        a.product-card {
            text-decoration: none;
            color: inherit;
            display: block;
            cursor: pointer;
        }
        a.product-card:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')
    
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>
        <div class="banner-overlay"></div>
        <div class="banner-texts">
            <h1 class="active">Discover <span>Labon®</span></h1>
            <h1>Innovation meets <span>Tradition</span></h1>
            <h1>Laddoo + Bon Bon = <span>Labon®</span></h1>
            <h1>Signature <span>Delight</span></h1>
        </div>
    </section>
    <section class="content">
        <div class="section-header">
            <h2>Labon® Collection</h2>
            <p>THF LABON®, an innovative twist of the traditional Indian laddoo and delectable French Bon Bon.</p>
        </div>
        <div class="product-grid">
            @php
                $labonProducts = [18, 19, 20];
                $productRepository = app('Webkul\Product\Repositories\ProductRepository');
            @endphp

            @foreach($labonProducts as $productId)
                @php
                    $product = $productRepository->find($productId);
                @endphp
                @if($product)
                    <x-shop::products.card :product="$product" />
                @endif
            @endforeach
        </div>
    </section>
    
    @include('shop::partials.thf-footer')
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
    <script src="{{ asset('thf-assets/js/category.js') }}"></script>
</body>
</html>
