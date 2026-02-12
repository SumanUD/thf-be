<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mewabite | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
    <style>
        a.product-card { text-decoration: none; color: inherit; display: block; cursor: pointer; }
        a.product-card:hover { text-decoration: none; }

        /* Fix product card sizing */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .product-card {
            max-width: 400px;
            width: 100%;
        }

        .card-image img {
            width: 100%;
            height: 300px;
            object-fit: cover;
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
            <h1 class="active">Artisan <span>Mewabites</span></h1>
            <h1>Premium <span>Dry Fruits</span></h1>
            <h1>Natural <span>Flavors</span></h1>
            <h1>Wholesome <span>Goodness</span></h1>
        </div>
    </section>

    <!-- Product Section -->
    <section class="content">
        <div class="section-header">
            <h2>Mewabite Collection</h2>
            <p>Handcrafted mewabite made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div class="product-grid">
            <a href="{{ url('/mewabite-delight-box') }}" class="product-card" data-product-id="24">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/THF Mewabite Delight Box.jpg') }}" alt="Mewabite Delight Box">
                    <div class="price-badge">₹599</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(24)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(24)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Mewabite Delight Box</h3>
                    <p>Our signature mewabite collection brings together premium ingredients and fine craftsmanship.</p>
                </div>
            </a>

            <a href="{{ url('/classic-mewabite-selection') }}" class="product-card" data-product-id="25">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.2.jpg') }}" alt="Classic Mewabite">
                    <div class="price-badge">₹749</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(25)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(25)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Classic Mewabite Selection</h3>
                    <p>Traditional mewabite crafted with layers of phyllo, nuts, and aromatic honey syrup.</p>
                </div>
            </a>

            <a href="{{ url('/premium-mewabite-assortment') }}" class="product-card" data-product-id="26">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.1.jpg') }}" alt="Premium Mewabite">
                    <div class="price-badge">₹899</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(26)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(26)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Mewabite Assortment</h3>
                    <p>A luxurious creation featuring our finest mewabite varieties in an elegant gift box.</p>
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
