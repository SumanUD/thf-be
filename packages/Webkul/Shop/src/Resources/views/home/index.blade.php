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

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/home.css') }}">
</head>

<body>
    @include('shop::partials.thf-header')

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
                <img src="{{ asset('thf-assets/images/19201080Baklava.jpg') }}" alt="Handcrafted Baklavas"
                    class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">HANDCRAFTED BAKLAVAS</h2>
                    <p class="category-subtitle">Made with premium ingredients, our artisanal baklava delivers a refined
                        balance of flavour and texture.</p>
                </div>
            </div>

            <div class="gallery-item-main" data-category="labon">
                <img src="{{ asset('thf-assets/images/19201080Labon.jpg') }}" alt="Signature Labons"
                    class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">SIGNATURE LABON<sup>&reg;</sup></h2>
                    <p class="category-subtitle">THF LABON<sup>&reg;</sup>, a registered product, is an innovative twist
                        of the traditional Indian laddoo and delectable French Bon Bon.</p>
                </div>
            </div>

            <div class="gallery-item-main" data-category="mewabites">
                <img src="{{ asset('thf-assets/images/mewabites_banner.jpg') }}" alt="Artisan Mewabites"
                    class="gallery-image">
                <div class="category-content">
                    <h2 class="category-title">ARTISAN MEWABITES</h2>
                    <p class="category-subtitle">A premium dry fruit assortment, expertly crafted to highlight natural
                        flavours with every wholesome bite.</p>
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
                            <span class="text-line">Handcrafted Luxury gifting, customized to make every celebration
                                unforgettable.</span>
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
                    <path class="arrow-path" d="M7,10L12,15L17,10" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>THF Corporate Gifting</h3>
                <p>Premium handcrafted sweets and treats for discerning corporate clients. Elevating relationships
                    through thoughtful gifting since 2010.</p>
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
            <p>&copy; {{ date('Y') }} THF Corporate Gifting. All rights reserved. | <a href="#">Privacy Policy</a> | <a
                    href="#">Terms of Service</a></p>
        </div>
    </footer>

    <script src="{{ asset('thf-assets/js/header.js') }}"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
</body>

</html>