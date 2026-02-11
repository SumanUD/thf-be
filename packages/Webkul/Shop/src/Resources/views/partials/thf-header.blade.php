<!-- Navigation Header -->
<header class="header">
    <div class="nav-left">
        <a href="{{ route('shop.home.index') }}" style="display: flex; align-items: center;">
            <img src="{{ asset('thf-assets/images/logo-transparent-white.png') }}" alt="THF" class="hamburger-logo" style="cursor: pointer;">
        </a>
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

        <!-- Cart Icon (Always Visible) -->
        <a href="{{ route('shop.checkout.cart.index') }}" class="nav-cart-icon" aria-label="Shopping Cart">
            <i class="fas fa-shopping-bag"></i>
            <span class="cart-count-badge" id="header-cart-count">0</span>
        </a>

        <!-- Sign In / User Dropdown -->
        <div class="nav-dropdown signin-dropdown">
            @guest('customer')
                <a href="#" class="nav-link">SIGN IN</a>
            @else
                @php
                    $firstName = auth()->guard('customer')->user()->first_name;
                    $displayName = strlen($firstName) > 10 ? substr($firstName, 0, 10) . '...' : $firstName;
                @endphp
                <a href="#" class="nav-link">{{ strtoupper($displayName) }}</a>
            @endguest

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
                    <li><a href="{{ route('shop.baklava.index') }}">Baklava</a></li>
                    <li><a href="{{ route('shop.labon.index') }}">Labon</a></li>
                    <li><a href="{{ route('shop.dates.index') }}">Dates</a></li>
                    <li><a href="{{ route('shop.mewabite.index') }}">Mewabite</a></li>
                    <li><a href="{{ route('shop.assorted.index') }}">Assorted Collection</a></li>
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

        <!-- Bestseller Slider -->
        <div class="menu-gallery">
            <div class="gallery-header">
                <h3>Bestsellers</h3>
                <div class="gallery-controls">
                    <button class="g-arrow prev" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="g-arrow next" aria-label="Next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div class="gallery-viewport">
                <div class="gallery-track">
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/THF Baklava Delight Box.jpg') }}" alt="Baklava Delight Box">
                        <div class="item-caption"><strong>Baklava Delight Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/Labon Delight Box.jpg') }}" alt="Labon Delight Box">
                        <div class="item-caption"><strong>Labon Delight Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/THF Royal Treat Box.jpg') }}" alt="Royal Treat Box">
                        <div class="item-caption"><strong>Royal Treat Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/Collective Box.jpg') }}" alt="Collective Box">
                        <div class="item-caption"><strong>Collective Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/Artisanal Treasure Box.jpg') }}" alt="Artisanal Treasure Box">
                        <div class="item-caption"><strong>Artisanal Treasure Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/Glorious Box.jpg') }}" alt="Glorious Box">
                        <div class="item-caption"><strong>Glorious Box</strong></div>
                    </div>
                    <div class="gallery-item">
                        <img src="{{ asset('thf-assets/images/best_seller/Assorted Date Box.jpg') }}" alt="Assorted Date Box">
                        <div class="item-caption"><strong>Assorted Date Box</strong></div>
                    </div>
                </div>
            </div>
            <div class="gallery-indicators">
                <div class="gallery-indicator active" data-index="0"></div>
                <div class="gallery-indicator" data-index="1"></div>
                <div class="gallery-indicator" data-index="2"></div>
            </div>
        </div>
    </div>
</nav>
