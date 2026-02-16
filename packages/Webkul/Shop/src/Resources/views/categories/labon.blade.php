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
            <a href="{{ url('/labon-delight-box') }}" class="product-card" data-product-id="18">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/Labon Delight Box.jpg') }}" alt="Labon Delight">
                    <div class="price-badge">₹649</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(18)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(18)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Labon Delight Box</h3>
                    <p>Our signature Labon® collection featuring premium flavors in an elegant presentation.</p>
                </div>
            </a>
            <a href="{{ url('/premium-labon®-assortment') }}" class="product-card" data-product-id="19">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/360640 Labon.jpg') }}" alt="Classic Labon">
                    <div class="price-badge">₹799</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(19)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(19)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Labon® Assortment</h3>
                    <p>A curated selection of our finest Labon® varieties in multiple flavors.</p>
                </div>
            </a>
            <a href="{{ url('/royal-labon®-collection') }}" class="product-card" data-product-id="20">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/19201080Labon.jpg') }}" alt="Labon Royal">
                    <div class="price-badge">₹999</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(20)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(20)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Royal Labon® Collection</h3>
                    <p>The ultimate Labon® experience with exotic flavors and premium packaging.</p>
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
