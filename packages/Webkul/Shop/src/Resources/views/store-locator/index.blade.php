@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Store Locator | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/store-locator.css') }}">
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
            <a href="{{ route('shop.search.index') }}" class="nav-link">SHOP</a>
            <a href="{{ route('shop.store-locator.index') }}" class="nav-link" style="color: #d4af37;">STORE LOCATOR</a>
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

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Discover THF Stores</div>
            <div class="hero-sub">Find our premium sweets and gifts at locations across the country. Each store offers the same exceptional quality and service you expect from The HazleNut Factory.</div>
        </div>
    </div>

    <div class="container">
        <div class="floating-card">
            <div class="header-row">
                <span class="main-title">Store Locator</span>
                <button class="map-btn">
                    <i class="fas fa-map"></i>
                    View on Map
                </button>
            </div>

            <div class="filter-card">
                <button class="location-btn">
                    <i class="fas fa-location-crosshairs"></i>
                    Use My Current Location
                </button>

                <div class="filter-fields">
                    <select>
                        <option>Select State</option>
                        <option>Uttar Pradesh</option>
                        <option>Delhi</option>
                        <option>Maharashtra</option>
                        <option>Karnataka</option>
                    </select>
                    <select>
                        <option>Select City</option>
                        <option>Agra</option>
                        <option>New Delhi</option>
                        <option>Mumbai</option>
                        <option>Bangalore</option>
                    </select>
                    <select>
                        <option>Select Locality</option>
                        <option>Hazratganj</option>
                        <option>Aerocity</option>
                        <option>Bandra</option>
                        <option>Indiranagar</option>
                    </select>
                    <button>Search</button>
                </div>

                <span class="cafes-count">
                    <i class="fas fa-store"></i>
                    11 Stores Available
                </span>
            </div>

            <div class="cafes-title">Premium Locations</div>

            <div class="cafes-list">
                <!-- Store 1 -->
                <div class="cafe-card">
                    <div class="cafe-image-wrap">
                        <img src="{{ asset('thf-assets/images/mewabites_banner.jpg') }}" class="cafe-image" alt="The HazleNut Factory Agra">
                    </div>
                    <div class="cafe-info">
                        <div class="cafe-header">The HazleNut Factory</div>
                        <div class="cafe-locality"><i class="fas fa-map-pin"></i> Agra • Hazratganj</div>
                        <div class="cafe-details">
                            <div class="details-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Handicraft Nagar 18A, Plot No.8, Fatehabad Road, Vibhav Nagar, Tajganj, Agra, Uttar Pradesh 282001</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-phone"></i>
                                <span>0814 7738 370</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-clock"></i>
                                <span>08:00 AM – 12:00 AM</span>
                            </div>
                            <span class="open-now">Open Now</span>
                        </div>
                        <div class="cafe-actions">
                            <a href="https://maps.google.com/?q=Handicraft+Nagar+18A+Agra" target="_blank" class="primary-btn">
                                <i class="fas fa-directions"></i>
                                Get Directions
                            </a>
                            <button class="secondary-btn">
                                <i class="fas fa-info-circle"></i>
                                Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Store 2 -->
                <div class="cafe-card">
                    <div class="cafe-image-wrap">
                        <img src="{{ asset('thf-assets/images/labon_banner.jpg') }}" class="cafe-image" alt="The HazleNut Factory Aerocity">
                    </div>
                    <div class="cafe-info">
                        <div class="cafe-header">The HazleNut Factory</div>
                        <div class="cafe-locality"><i class="fas fa-map-pin"></i> New Delhi • Aerocity</div>
                        <div class="cafe-details">
                            <div class="details-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>GF-K1, Ground Floor, Worldmark 2, Asset Area 8, Aerocity, New Delhi, Delhi 110037</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-phone"></i>
                                <span>0809 5799 943</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-clock"></i>
                                <span>08:00 AM – 01:00 AM</span>
                            </div>
                            <span class="open-now">Open Now</span>
                        </div>
                        <div class="cafe-actions">
                            <a href="https://maps.google.com/?q=Worldmark+2+Aerocity+Delhi" target="_blank" class="primary-btn">
                                <i class="fas fa-directions"></i>
                                Get Directions
                            </a>
                            <button class="secondary-btn">
                                <i class="fas fa-info-circle"></i>
                                Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Store 3 -->
                <div class="cafe-card">
                    <div class="cafe-image-wrap">
                        <img src="{{ asset('thf-assets/images/19201080Baklava.jpg') }}" class="cafe-image" alt="The HazleNut Factory Mumbai">
                    </div>
                    <div class="cafe-info">
                        <div class="cafe-header">The HazleNut Factory</div>
                        <div class="cafe-locality"><i class="fas fa-map-pin"></i> Mumbai • Bandra West</div>
                        <div class="cafe-details">
                            <div class="details-row">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Unit 12, Ground Floor, Linking Road, Bandra West, Mumbai, Maharashtra 400050</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-phone"></i>
                                <span>0911 2233 445</span>
                            </div>
                            <div class="details-row">
                                <i class="fas fa-clock"></i>
                                <span>09:00 AM – 11:00 PM</span>
                            </div>
                            <span class="open-now">Open Now</span>
                        </div>
                        <div class="cafe-actions">
                            <a href="https://maps.google.com/?q=Linking+Road+Bandra+Mumbai" target="_blank" class="primary-btn">
                                <i class="fas fa-directions"></i>
                                Get Directions
                            </a>
                            <button class="secondary-btn">
                                <i class="fas fa-info-circle"></i>
                                Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="{{ route('shop.home.index') }}">Home</a>
                <a href="{{ route('shop.search.index') }}">Shop</a>
                <a href="{{ route('shop.store-locator.index') }}">Store Locator</a>
                <a href="{{ route('shop.corporate.index') }}">Corporate Gifting</a>
            </div>
            <div class="footer-section">
                <h3>Customer Service</h3>
                <a href="#">Contact Us</a>
                <a href="#">FAQs</a>
                <a href="#">Shipping & Returns</a>
                <a href="#">Track Order</a>
            </div>
            <div class="footer-section">
                <h3>Contact</h3>
                <a href="tel:+911234567890">+91 123 456 7890</a>
                <a href="mailto:info@thf.com">info@thf.com</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} The HazleNut Factory. All rights reserved.</p>
        </div>
    </footer>

    <script src="{{ asset('thf-assets/js/store-locator.js') }}"></script>
</body>
</html>
