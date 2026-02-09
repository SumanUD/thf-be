<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Assorted Collection | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
</head>
<body>
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
            <div class="product-card" data-product-id="1">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/best_seller/THF Assorted Collection Delight Box.jpg') }}" alt="Assorted Collection Delight Box">
                    <div class="price-badge">₹599</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(1)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(1)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Assorted Collection Delight Box</h3>
                    <p>Our signature assorted collection brings together premium ingredients and fine craftsmanship.</p>
                </div>
            </div>

            <div class="product-card" data-product-id="2">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.2.jpg') }}" alt="Classic Assorted Collection">
                    <div class="price-badge">₹749</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(2)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(2)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Classic Assorted Collection Selection</h3>
                    <p>Traditional assorted crafted with layers of phyllo, nuts, and aromatic honey syrup.</p>
                </div>
            </div>

            <div class="product-card" data-product-id="3">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.1.jpg') }}" alt="Premium Assorted Collection">
                    <div class="price-badge">₹899</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(3)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(3)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Assorted Collection Assortment</h3>
                    <p>A luxurious creation featuring our finest assorted varieties in an elegant gift box.</p>
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
