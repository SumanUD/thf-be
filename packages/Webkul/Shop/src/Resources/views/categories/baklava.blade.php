<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Baklava | The HazleNut Factory</title>

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
    
    <!-- Video Banner -->
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>
        <div class="banner-overlay"></div>
        <div class="banner-texts">
            <h1 class="active">Experience <span>Baklava</span></h1>
            <h1>Layers of <span>Perfection</span></h1>
            <h1>Handcrafted with <span>Love</span></h1>
            <h1>Tradition meets <span>Luxury</span></h1>
        </div>
    </section>

    <!-- Product Section -->
    <section class="content">
        <div class="section-header">
            <h2>Baklava Collection</h2>
            <p>Handcrafted baklava made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div class="product-grid">
            @php
                $baklavaProducts = [15, 16, 17];
                $productRepository = app('Webkul\Product\Repositories\ProductRepository');
            @endphp

            @foreach($baklavaProducts as $productId)
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
