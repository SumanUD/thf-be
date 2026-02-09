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

    <link rel="stylesheet" href="{{ asset('thf-assets/css/collection.css') }}">
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
                        <button><i class="fas fa-heart"></i> Wishlist</button>
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
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="{{ route('shop.home.index') }}">Home</a>
                <a href="{{ route('shop.collection.index') }}">Shop</a>
                <a href="{{ route('shop.store-locator.index') }}">Store Locator</a>
                <a href="{{ route('shop.corporate.index') }}">Corporate Gifting</a>
            </div>
            <div class="footer-section">
                <h3>Categories</h3>
                <a href="{{ route('shop.collection.index') }}">Baklava</a>
                <a href="{{ route('shop.collection.index') }}">Labon</a>
                <a href="{{ route('shop.collection.index') }}">Dates</a>
                <a href="{{ route('shop.collection.index') }}">Mewabites</a>
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

    <!-- JavaScript -->
    <script src="{{ asset('thf-assets/js/collection.js') }}"></script>
</body>
</html>
