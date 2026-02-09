<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Labon | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
</head>
<body>
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
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/Labon Delight Box.jpg') }}" alt="Labon Delight">
                    <div class="price-badge">₹649</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(4)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(4)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Labon Delight Box</h3>
                    <p>Our signature Labon® collection featuring premium flavors in an elegant presentation.</p>
                </div>
            </div>
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/360640 Labon.jpg') }}" alt="Classic Labon">
                    <div class="price-badge">₹799</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(5)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(5)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Labon® Assortment</h3>
                    <p>A curated selection of our finest Labon® varieties in multiple flavors.</p>
                </div>
            </div>
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/19201080Labon.jpg') }}" alt="Labon Royal">
                    <div class="price-badge">₹999</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(6)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(6)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Royal Labon® Collection</h3>
                    <p>The ultimate Labon® experience with exotic flavors and premium packaging.</p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
    <script src="{{ asset('thf-assets/js/category.js') }}"></script>
</body>
</html>
