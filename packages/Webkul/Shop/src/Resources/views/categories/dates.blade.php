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
        a.product-card { text-decoration: none; color: inherit; display: block; cursor: pointer; }
        a.product-card:hover { text-decoration: none; }
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
            <h1 class="active">Royal <span>Dates</span></h1>
            <h1>Natures <span>Sweetness</span></h1>
            <h1>Premium <span>Quality</span></h1>
            <h1>Nutritious <span>Indulgence</span></h1>
        </div>
    </section>

    <!-- Product Section -->
    <section class="content">
        <div class="section-header">
            <h2>Dates Collection</h2>
            <p>Handcrafted dates made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div class="product-grid">
            <a href="{{ url('/dates-delight-box') }}" class="product-card" data-product-id="21">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/THF Dates Delight Box.jpg') }}" alt="Dates Delight Box">
                    <div class="price-badge">₹599</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(21)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(21)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Dates Delight Box</h3>
                    <p>Our signature dates collection brings together premium ingredients and fine craftsmanship.</p>
                </div>
            </a>

            <a href="{{ url('/classic-dates-selection') }}" class="product-card" data-product-id="22">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.2.jpg') }}" alt="Classic Dates">
                    <div class="price-badge">₹749</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(22)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(22)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Classic Dates Selection</h3>
                    <p>Traditional dates crafted with layers of phyllo, nuts, and aromatic honey syrup.</p>
                </div>
            </a>

            <a href="{{ url('/premium-dates-assortment') }}" class="product-card" data-product-id="23">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.1.jpg') }}" alt="Premium Dates">
                    <div class="price-badge">₹899</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(23)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(23)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Dates Assortment</h3>
                    <p>A luxurious creation featuring our finest dates varieties in an elegant gift box.</p>
                </div>
            </a>
        </div>
    </section>

    @include('shop::partials.thf-footer')
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
    <script src="{{ asset('thf-assets/js/category.js') }}"></script>
</body>
</html>
