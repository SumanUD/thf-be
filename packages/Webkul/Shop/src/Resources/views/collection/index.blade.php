@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Our Collection | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <style>
        @font-face {
            font-family: "Forum";
            src: url("{{ asset('thf-assets/fonts/forum/Forum-Regular.ttf') }}") format("truetype");
            font-weight: 400;
            font-style: normal;
            font-display: swap;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Forum", serif;
            background: #0a0a0a;
            color: rgba(255, 255, 255, 0.9);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Navigation Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo img {
            height: 50px;
        }

        .menu-toggle {
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 10px;
            transition: color 0.3s ease;
        }

        .menu-toggle:hover {
            color: #d4af37;
        }

        /* Mega Menu */
        .mega-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.98), rgba(20, 20, 20, 0.95));
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            backdrop-filter: blur(20px);
        }

        .mega-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mega-panel {
            max-width: 1400px;
            margin: 0 auto;
            padding: 120px 60px 60px;
        }

        .menu-left {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 40px;
        }

        .links-col .col-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 25px;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .links-col ul {
            list-style: none;
        }

        .links-col ul li {
            margin-bottom: 15px;
        }

        .links-col ul li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .links-col ul li a:hover {
            color: #d4af37;
            transform: translateX(5px);
        }

        @media (max-width: 1024px) {
            .menu-left {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .menu-left {
                grid-template-columns: repeat(2, 1fr);
            }

            .mega-panel {
                padding: 100px 30px 40px;
            }
        }

        @media (max-width: 480px) {
            .menu-left {
                grid-template-columns: 1fr;
            }
        }

        .header-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .header-center img {
            height: 30px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #d4af37;
        }

        /* Video Banner */
        .video-banner {
            position: relative;
            height: 100vh;
            width: 100%;
            overflow: hidden;
        }

        .video-banner video {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.8);
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.3));
            z-index: 1;
        }

        /* Text Animation */
        .banner-texts {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
            color: #fff;
            padding: 0 20px;
        }

        .banner-texts h1 {
            font-size: 4.5rem;
            font-weight: 300;
            letter-spacing: -1px;
            position: absolute;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.5);
            max-width: 900px;
            line-height: 1.2;
        }

        .banner-texts h1 span {
            color: #d4af37;
            font-weight: 400;
            position: relative;
        }

        .banner-texts h1 span::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, #d4af37, transparent);
            opacity: 0.5;
        }

        .banner-texts h1.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Product Section */
        section.content {
            background: linear-gradient(180deg, #0a0a0a 0%, #111111 100%);
            padding: 120px 8% 150px;
            position: relative;
        }

        /* Section Header */
        .section-header {
            text-align: center;
            margin-bottom: 80px;
            position: relative;
        }

        .section-header h2 {
            font-size: 3rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 1px;
            background: #d4af37;
        }

        .section-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Product Grid */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(330px, 1fr));
            gap: 50px;
        }

        /* Product Card */
        .product-card {
            background: rgba(20, 20, 20, 0.8);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            border-color: rgba(212, 175, 55, 0.2);
        }

        /* Image Section */
        .card-image {
            position: relative;
            height: 340px;
            overflow: hidden;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .product-card:hover img {
            transform: scale(1.08);
        }

        /* Price Badge */
        .price-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            color: #d4af37;
            font-weight: 400;
            font-size: 1.2rem;
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid rgba(212, 175, 55, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        /* Hover Actions */
        .hover-actions {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            display: flex;
            gap: 12px;
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 2;
        }

        .product-card:hover .hover-actions {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        .hover-actions button {
            background: rgba(212, 175, 55, 0.9);
            color: #000;
            border: none;
            border-radius: 30px;
            padding: 12px 24px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            font-family: "Forum", serif;
        }

        .hover-actions button:hover {
            background: #d4af37;
            transform: translateY(-2px);
        }

        /* Text Section */
        .card-content {
            padding: 25px;
            text-align: center;
        }

        .card-content h3 {
            font-size: 1.4rem;
            font-weight: 400;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }

        .card-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.6;
            font-weight: 300;
        }

        /* Footer */
        .footer {
            background: rgba(10, 10, 10, 0.95);
            padding: 60px 40px 30px;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            color: #d4af37;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #d4af37;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(20, 20, 20, 0.8);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(212, 175, 55, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(212, 175, 55, 0.5);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .banner-texts h1 {
                font-size: 3.5rem;
            }

            .section-header h2 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-right {
                display: none;
            }

            .banner-texts h1 {
                font-size: 2.5rem;
                padding: 0 20px;
            }

            section.content {
                padding: 80px 5%;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .section-header p {
                font-size: 1.1rem;
                padding: 0 20px;
            }

            .product-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .card-image {
                height: 280px;
            }
        }

        @media (max-width: 480px) {
            .banner-texts h1 {
                font-size: 2rem;
            }

            .product-grid {
                gap: 30px;
            }

            .price-badge {
                font-size: 1rem;
                padding: 8px 16px;
            }

            .hover-actions {
                flex-direction: column;
                width: 80%;
            }

            .hover-actions button {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <header class="header">
        <div class="header-left">
            <a href="{{ route('shop.home.index') }}" class="logo">
                <img src="{{ asset('thf-assets/images/logo-transparent-white.png') }}" alt="THF Logo">
            </a>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>

        <div class="header-center">
            <a href="{{ route('shop.home.index') }}">
                <img src="{{ asset('thf-assets/images/name-logo.png') }}" alt="The Hazlenut Factory">
            </a>
        </div>

        <div class="header-right">
            <a href="{{ route('shop.collection.index') }}" class="nav-link" style="color: #d4af37;">SHOP</a>
            <a href="{{ route('shop.store-locator.index') }}" class="nav-link">STORE LOCATOR</a>
            @guest('customer')
                <a href="{{ route('shop.customer.session.create') }}" class="nav-link">SIGN IN</a>
            @else
                <a href="{{ route('shop.customers.account.profile.index') }}" class="nav-link">MY ACCOUNT</a>
            @endguest
        </div>
    </header>

    <!-- Mega Menu -->
    <nav class="mega-menu">
        <div class="mega-panel">
            <div class="menu-left">
                <div class="links-col">
                    <div class="col-title">Sweets</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Baklava</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Labon</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Dates</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Mewabite</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Assorted Collection</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Collections</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Luxury Gifting</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Premium Coffee</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Merchandise</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Corporate Gifting</a></li>
                        <li><a href="#">Gifting Brochures</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Seasonal</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Festive Hampers</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Diwali Specials</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Eid Collection</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Christmas Treats</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">New Year Gifting</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Corporate</div>
                    <ul>
                        <li><a href="{{ route('shop.corporate.index') }}">Bulk Orders</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Custom Branding</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Employee Gifting</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Client Appreciation</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Corporate Catalog</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Services & Info</div>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Facilities</a></li>
                        <li><a href="#">Catering</a></li>
                        <li><a href="#">JalGhar</a></li>
                        <li><a href="{{ route('shop.store-locator.index') }}">Store Locator</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Video Banner -->
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>

        <div class="banner-overlay"></div>

        <div class="banner-texts">
            <h1 class="active">Welcome to <span>THF</span></h1>
            <h1>Experience <span>Luxury</span></h1>
            <h1>Where <span>Craft Meets Design</span></h1>
            <h1>Redefining <span>Sweet Spaces</span></h1>
        </div>
    </section>

    <!-- Product Section -->
    <section class="content">
        <div class="section-header">
            <h2>Our Signature Sweets</h2>
            <p>Handcrafted delicacies made with passion, precision, and pure indulgence.</p>
        </div>

        <div class="product-grid" id="product-grid">
            <!-- Product Card 1 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.4.jpg') }}" alt="Classic Baklava">
                    <div class="price-badge">&#8377;599</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(1)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(1)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Baklava Delight Box</h3>
                    <p>Our new artisanal baklava collection brings together premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
                </div>
            </div>

            <!-- Product Card 2 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.2.jpg') }}" alt="Chocolate Dates">
                    <div class="price-badge">&#8377;749</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(2)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(2)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Premium Dates Collection</h3>
                    <p>Exquisite dates filled with almonds and coated in fine chocolate, presented in our signature gift box.</p>
                </div>
            </div>

            <!-- Product Card 3 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/THF Box 3.1.jpg') }}" alt="Honey Bites">
                    <div class="price-badge">&#8377;699</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(3)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(3)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Baklava Indulgence Box</h3>
                    <p>A luxurious creation of artisanal baklava and gourmet honeys, crafted to delight in every bite.</p>
                </div>
            </div>

            <!-- Product Card 4 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/mewabite.jpg') }}" alt="Mewabites">
                    <div class="price-badge">&#8377;549</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(4)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(4)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Mewabite Selection</h3>
                    <p>Traditional Indian sweets reimagined with a modern twist, perfect for gifting and celebrations.</p>
                </div>
            </div>

            <!-- Product Card 5 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/labon.png') }}" alt="Labon">
                    <div class="price-badge">&#8377;899</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(5)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(8)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Labon Premium Box</h3>
                    <p>Our signature Labon collection featuring the finest milk-based sweets with exotic flavors.</p>
                </div>
            </div>

            <!-- Product Card 6 -->
            <div class="product-card">
                <div class="card-image">
                    <img src="{{ asset('thf-assets/images/baklava.png') }}" alt="Assorted Collection">
                    <div class="price-badge">&#8377;1299</div>
                    <div class="hover-actions">
                        <button onclick="addToCart(6)"><i class="fas fa-shopping-cart"></i> Add to Cart</button>
                        <button onclick="addToWishlist(9)"><i class="fas fa-heart"></i> Wishlist</button>
                    </div>
                </div>
                <div class="card-content">
                    <h3>Luxury Assorted Hamper</h3>
                    <p>The ultimate THF experience - a curated selection of our finest sweets in an elegant presentation box.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include("shop::partials.thf-footer")
    <script>
        // Text Animation
        const texts = document.querySelectorAll('.banner-texts h1');
        let currentIndex = 0;

        function rotateText() {
            texts.forEach((text, index) => {
                text.classList.remove('active');
            });

            currentIndex = (currentIndex + 1) % texts.length;
            texts[currentIndex].classList.add('active');
        }

        // Rotate text every 3 seconds
        setInterval(rotateText, 3000);

        // Video brightness on scroll
        const video = document.querySelector('.video-banner video');
        window.addEventListener('scroll', () => {
            const scrollPercent = window.scrollY / window.innerHeight;
            const brightness = Math.max(0.4, 0.8 - (scrollPercent * 0.4));
            video.style.filter = `brightness(${brightness})`;
        });

        // Add to Cart function (placeholder - will integrate with Bagisto API)

        function addToCart(productId) {
            fetch('{{ route("shop.api.checkout.cart.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    showNotification(data.message, 'success');
                    updateCartCount();
                } else if (data.data && data.data.message) {
                    showNotification(data.data.message, 'warning');
                }
            })
            .catch(error => {
                showNotification('Error adding to cart', 'error');
                console.error('Cart error:', error);
            });
        }

        function showNotification(message, type) {
            const notification = document.createElement('div');
            notification.className = 'cart-notification ' + type;
            notification.innerHTML = message;
            notification.style.cssText = 'position:fixed;top:80px;right:20px;padding:15px 25px;border-radius:8px;z-index:9999;font-family:Forum,serif;animation:slideIn 0.3s ease;';
            if (type === 'success') notification.style.background = '#d4af37';
            else if (type === 'warning') notification.style.background = '#f0ad4e';
            else notification.style.background = '#d9534f';
            notification.style.color = '#000';
            document.body.appendChild(notification);
            setTimeout(() => notification.remove(), 3000);
        }

        function updateCartCount() {
            fetch('{{ route("shop.api.checkout.cart.index") }}')
                .then(response => response.json())
                .then(data => {
                    const count = data.data ? data.data.items_qty || 0 : 0;
                    const cartCountEl = document.getElementById('cart-count');
                    if (cartCountEl) cartCountEl.textContent = count;
                })
                .catch(() => {});
        }

        function addToWishlist(productId) {
            fetch('{{ route("shop.api.customers.account.wishlist.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => {
                if (response.status === 401) {
                    showNotification('Please login to add items to wishlist', 'warning');
                    setTimeout(() => {
                        window.location.href = '{{ route("shop.customer.session.index") }}';
                    }, 1500);
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data && data.data && data.data.message) {
                    showNotification(data.data.message, 'success');
                } else if (data && data.message) {
                    showNotification(data.message, 'success');
                }
            })
            .catch(error => {
                console.error('Wishlist error:', error);
            });
        }

















        // Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const megaMenu = document.querySelector('.mega-menu');

        menuToggle.addEventListener('click', () => {
            megaMenu.classList.toggle('active');
        });

        // Close menu on clicking outside
        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target) && megaMenu.classList.contains('active')) {
                megaMenu.classList.remove('active');
            }
        });

        // Close menu on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                megaMenu.classList.remove('active');
            }
        });
    </script>
</body>
</html>
