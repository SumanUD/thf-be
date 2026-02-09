@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $channel->home_seo['meta_title'] ?? 'The HazleNut Factory' }}</title>
    <meta name="description" content="{{ $channel->home_seo['meta_description'] ?? '' }}">
    <meta name="keywords" content="{{ $channel->home_seo['meta_keywords'] ?? '' }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/home.css') }}">
</head>
<body>
    <!-- Navigation Header -->
    <header class="header">
        <div class="nav-left">
            <img src="{{ asset('thf-assets/images/logo-transparent-white.png') }}" alt="THF" class="hamburger-logo">
            <button class="menu-toggle" aria-label="Toggle menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>
        </div>

        <div class="nav-center">
            <a href="{{ route('shop.home.index') }}" class="logo">
                <img src="{{ asset('thf-assets/images/name-logo.png') }}" alt="The HazleNut Factory">
            </a>
        </div>

        <div class="nav-right">
            <!-- Search -->
            <div class="search-container">
                <button class="search-toggle" aria-label="Search">
                    <i class="fas fa-search"></i>
                </button>
                <div class="search-box">
                    <form action="{{ route('shop.search.index') }}" method="GET">
                        <input type="text" name="query" placeholder="Search products..." autocomplete="off">
                    </form>
                </div>
            </div>

            <!-- Shop Dropdown -->
            <div class="nav-dropdown">
                <a href="{{ route('shop.collection.index') }}" class="nav-link">SHOP</a>
                <div class="dropdown-content">
                    <a href="{{ route('shop.collection.index') }}" class="dropdown-link">THF GIFTING</a>
                    <a href="{{ route('shop.collection.index') }}" class="dropdown-link">THF COFFEE</a>
                    <a href="{{ route('shop.collection.index') }}" class="dropdown-link">THF MERCHANDISE</a>
                </div>
            </div>

            <a href="{{ route('shop.store-locator.index') }}" class="nav-link">STORE LOCATOR</a>

            <!-- Sign In Dropdown -->
            <div class="nav-dropdown signin-dropdown">
                <a href="#" class="nav-link">SIGN IN</a>
                <div class="dropdown-content">
                    @guest('customer')
                        <div class="signin-header">
                            <h4>Welcome</h4>
                            <p>Sign in to access your account</p>
                        </div>
                        <a href="{{ route('shop.customer.session.create') }}" class="signin-btn">Sign In</a>
                        <a href="{{ route('shop.customers.register.index') }}" class="signin-btn secondary">Create Account</a>
                    @else
                        <div class="signin-header">
                            <h4>Welcome, {{ auth()->guard('customer')->user()->first_name }}</h4>
                            <p>Manage your account</p>
                        </div>
                        <a href="{{ route('shop.customers.account.profile.index') }}" class="dropdown-link">My Profile</a>
                        <a href="{{ route('shop.customers.account.orders.index') }}" class="dropdown-link">My Orders</a>
                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                            <a href="{{ route('shop.customers.account.wishlist.index') }}" class="dropdown-link">Wishlist</a>
                        @endif
                        <form id="customerLogout" method="POST" action="{{ route('shop.customer.session.destroy') }}">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('customerLogout').submit();" class="dropdown-link">Logout</a>
                    @endguest

                    <div class="cart-section">
                        <a href="{{ route('shop.checkout.cart.index') }}" class="cart-link">
                            <i class="fas fa-shopping-bag"></i>
                            <span>Shopping Bag</span>
                            <span class="cart-count" id="cart-count">0</span>
                        </a>
                    </div>
                </div>
            </div>
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

    <!-- Main Content -->
    <div class="container">
        <!-- Video Section -->
        <div class="video-section">
            <video id="background-video" autoplay muted loop playsinline>
                <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
            </video>
            <div class="video-overlay"></div>
        </div>

        <!-- Image Gallery with Categories -->
        <div class="image-gallery">
            <div class="gallery-item-main" data-category="baklava">
                <img src="{{ asset('thf-assets/images/19201080Baklava.jpg') }}" alt="Handcrafted Baklavas" class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">HANDCRAFTED BAKLAVAS</h2>
                    <p class="category-subtitle">Made with premium ingredients, our artisanal baklava delivers a refined balance of flavour and texture.</p>
                </div>
            </div>

            <div class="gallery-item-main" data-category="labon">
                <img src="{{ asset('thf-assets/images/19201080Labon.jpg') }}" alt="Signature Labons" class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">SIGNATURE LABON<sup>&reg;</sup></h2>
                    <p class="category-subtitle">THF LABON<sup>&reg;</sup>, a registered product, is an innovative twist of the traditional Indian laddoo and delectable French Bon Bon.</p>
                </div>
            </div>

            <div class="gallery-item-main" data-category="mewabites">
                <img src="{{ asset('thf-assets/images/mewabites_banner.jpg') }}" alt="Artisan Mewabites" class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">ARTISAN MEWABITES</h2>
                    <p class="category-subtitle">A premium dry fruit assortment, expertly crafted to highlight natural flavours with every wholesome bite.</p>
                </div>
            </div>

            <div class="gallery-item-main" data-category="dates">
                <img src="{{ asset('thf-assets/images/dates_banner.jpg') }}" alt="Royal Dates" class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">ROYAL DATES</h2>
                    <p class="category-subtitle">Premium dates, naturally sweet, perfect for nutritious indulgence.</p>
                </div>
            </div>
        </div>

        <!-- Centered Content -->
        <div class="content-section">
            <ul class="item-list">
                <li class="list-item" data-index="1">
                    <div class="item-content">
                        <h1 class="list-heading">
                            <span class="heading-text">LUXURY GIFTING '25</span>
                        </h1>
                        <span class="text-mask">
                            <span class="text-line">Handcrafted Luxury gifting, customized to make every celebration unforgettable.</span>
                        </span>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <div class="scroll-text">SCROLL TO REVEAL</div>
            <div class="scroll-arrow">
                <svg viewBox="0 0 24 24">
                    <path class="arrow-path" d="M7,10L12,15L17,10"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>THF Corporate Gifting</h3>
                <p>Premium handcrafted sweets and treats for discerning corporate clients. Elevating relationships through thoughtful gifting since 2010.</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <div class="footer-links">
                    <a href="{{ route('shop.corporate.index') }}">Get a Quote</a>
                    <a href="{{ route('shop.corporate.index') }}">Why Choose Us</a>
                    <a href="{{ route('shop.corporate.index') }}">Corporate Catalog</a>
                    <a href="{{ route('shop.store-locator.index') }}">Store Locator</a>
                    <a href="#">Delivery Information</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Our Products</h3>
                <div class="footer-links">
                    <a href="{{ route('shop.collection.index') }}">Festive Hampers</a>
                    <a href="{{ route('shop.collection.index') }}">Client Gifting</a>
                    <a href="{{ route('shop.collection.index') }}">Employee Rewards</a>
                    <a href="{{ route('shop.collection.index') }}">Custom Branding</a>
                    <a href="{{ route('shop.collection.index') }}">Seasonal Specials</a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> Corporate Office, Mumbai, India</p>
                <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                <p><i class="fas fa-envelope"></i> corporate@thf.com</p>
                <p><i class="fas fa-clock"></i> Mon-Sat: 9AM - 7PM</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} THF Corporate Gifting. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>

    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
</body>
</html>
