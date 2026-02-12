<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assorted Collection | The HazleNut Factory</title>

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
            <h1 class="active">Assorted <span>Collection</span></h1>
            <h1>Best of <span>Everything</span></h1>
            <h1>Perfect <span>Variety</span></h1>
            <h1>Ultimate <span>Gifting</span></h1>
        </div>
    </section>

    <!-- Product Section -->
    <section class="content">
        <div class="section-header">
            <h2>Assorted Collection Collection</h2>
            <p>Handcrafted assorted made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div class="product-grid">
            <a href="{{ url('/assorted-collection-delight-box') }}" class="product-card" data-product-id="27">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/THF Assorted Collection Delight Box.jpg') }}" alt="Assorted Collection Delight Box">
                    <div class="price-badge">₹599</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(27)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(27)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Assorted Collection Delight Box</h3>
                    <p>Our signature assorted collection brings together premium ingredients and fine craftsmanship.</p>
                </div>
            </a>

            <a href="{{ url('/classic-assorted-selection') }}" class="product-card" data-product-id="28">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.2.jpg') }}" alt="Classic Assorted Collection">
                    <div class="price-badge">₹749</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(28)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(28)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Classic Assorted Collection Selection</h3>
                    <p>Traditional assorted crafted with layers of phyllo, nuts, and aromatic honey syrup.</p>
                </div>
            </a>

            <a href="{{ url('/premium-assorted-assortment') }}" class="product-card" data-product-id="29">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.1.jpg') }}" alt="Premium Assorted Collection">
                    <div class="price-badge">₹899</div>
                    <div class="hover-actions">
                        <button onclick="event.preventDefault(); addToCart(29)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="event.preventDefault(); addToWishlist(29)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Assorted Collection Assortment</h3>
                    <p>A luxurious creation featuring our finest assorted varieties in an elegant gift box.</p>
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
