<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dates | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
    <style>
        body { background: #000; color: #fff; }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
            padding: 40px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')
    
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>
        <div class="banner-overlay"></div>
        <div class="banner-texts">
            <h1 class="active">Royal <span>Dates</span></h1>
            <h1>Natures <span>Sweetness</span></h1>
            <h1>Premium <span>Quality</span></h1>
            <h1>Nutritious <span>Indulgence</span></h1>
        </div>
    </section>

    <section class="content">
        <div class="section-header" style="text-align: center; padding: 60px 20px 20px;">
            <h2 style="font-family: 'Forum', serif; font-size: 3rem; color: #d4af37;">Dates Collection</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 800px; margin: 20px auto;">Handcrafted dates made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div class="product-grid">
            @php
                $categoryRepository = app('Webkul\Category\Repositories\CategoryRepository');
                $category = $categoryRepository->findBySlug('dates');
                $products = $category ? $category->products : collect();
            @endphp

            @forelse($products as $product)
                <x-shop::products.card :product="$product" />
            @empty
                <p style="text-align: center; grid-column: 1/-1;">No products found in this collection.</p>
            @endforelse
        </div>
    </section>
    
    @include('shop::partials.thf-footer')
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
</body>
</html>
