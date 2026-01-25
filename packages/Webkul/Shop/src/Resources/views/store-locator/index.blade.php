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
            min-height: 100vh;
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

        /* HERO BANNER */
        .hero-banner {
            width: 100%;
            height: 420px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)),
                url('{{ asset("thf-assets/images/mewabites_banner.jpg") }}') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            margin-top: 80px;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            color: white;
            max-width: 900px;
            padding: 0 40px;
            animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 3.8rem;
            font-weight: 300;
            letter-spacing: -1.5px;
            margin-bottom: 16px;
            text-transform: uppercase;
            line-height: 1.1;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            position: relative;
            padding-bottom: 20px;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }

        .hero-sub {
            font-size: 1.3rem;
            opacity: 0.85;
            font-weight: 300;
            letter-spacing: 0.5px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1400px;
            margin: -100px auto 60px;
            padding: 0 40px;
            position: relative;
            z-index: 5;
        }

        /* FLOATING CARD */
        .floating-card {
            background: rgba(15, 15, 15, 0.85);
            padding: 50px;
            border-radius: 24px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.15);
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: cardFloatUp 0.9s cubic-bezier(0.4, 0, 0.2, 1) 0.3s both;
        }

        @keyframes cardFloatUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* HEADER ROW */
        .header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            padding-bottom: 30px;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #fff;
            letter-spacing: -0.5px;
            position: relative;
        }

        .main-title::before {
            content: '';
            position: absolute;
            left: 0;
            bottom: -12px;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        /* BUTTONS */
        .map-btn {
            padding: 14px 32px;
            border: none;
            border-radius: 12px;
            background: rgba(212, 175, 55, 0.1);
            color: #d4af37;
            font-weight: 400;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            position: relative;
            overflow: hidden;
            font-family: "Forum", serif;
        }

        .map-btn:hover {
            background: rgba(212, 175, 55, 0.15);
            transform: translateY(-2px);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.1);
        }

        /* FILTER CARD */
        .filter-card {
            background: rgba(20, 20, 20, 0.7);
            padding: 35px;
            border-radius: 18px;
            margin-bottom: 50px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 25px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            overflow: hidden;
        }

        .filter-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
        }

        .location-btn {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 15px 28px;
            border: none;
            border-radius: 12px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .location-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
        }

        .filter-fields {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
            flex: 1;
            justify-content: flex-end;
        }

        .filter-fields select,
        .filter-fields input {
            padding: 14px 20px;
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            min-width: 160px;
            background: rgba(10, 10, 10, 0.8);
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .filter-fields select:focus,
        .filter-fields input:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            outline: none;
        }

        .filter-fields button {
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 14px 28px;
            border-radius: 10px;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .filter-fields button:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .cafes-count {
            font-size: 1.2rem;
            font-weight: 400;
            color: #d4af37;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        /* SECTION TITLE */
        .cafes-title {
            font-size: 2.2rem;
            font-weight: 300;
            margin-bottom: 40px;
            color: #fff;
            letter-spacing: -0.5px;
            position: relative;
            padding-bottom: 20px;
        }

        .cafes-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 1px;
            background: #d4af37;
        }

        /* STORE LIST */
        .cafes-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 35px;
        }

        /* STORE CARD */
        .cafe-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
        }

        .cafe-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.2);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(212, 175, 55, 0.1);
        }

        .cafe-image-wrap {
            height: 240px;
            overflow: hidden;
            position: relative;
        }

        .cafe-image-wrap::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
        }

        .cafe-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .cafe-card:hover .cafe-image {
            transform: scale(1.08);
        }

        .cafe-info {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .cafe-header {
            font-size: 1.5rem;
            font-weight: 400;
            margin-bottom: 8px;
            color: #fff;
            line-height: 1.3;
        }

        .cafe-locality {
            font-size: 1.1rem;
            font-weight: 300;
            color: #d4af37;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .cafe-details {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-bottom: 25px;
            flex: 1;
        }

        .details-row {
            margin-bottom: 12px;
            line-height: 1.6;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .details-row i {
            color: #d4af37;
            margin-top: 4px;
            flex-shrink: 0;
            width: 16px;
        }

        .open-now {
            color: #1da678;
            font-weight: 500;
            font-size: 1.05rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-top: 5px;
        }

        .open-now::before {
            content: '';
            width: 8px;
            height: 8px;
            background: #1da678;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .cafe-actions {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .cafe-actions button,
        .cafe-actions a {
            flex: 1;
            padding: 14px;
            border-radius: 10px;
            border: none;
            font-weight: 400;
            cursor: pointer;
            font-size: 1rem;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            font-family: "Forum", serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .cafe-actions .primary-btn {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
        }

        .cafe-actions .primary-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
        }

        .cafe-actions .secondary-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .cafe-actions .secondary-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(212, 175, 55, 0.3);
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

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .cafes-list {
                grid-template-columns: repeat(auto-fill, minmax(330px, 1fr));
            }

            .filter-card {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-fields {
                justify-content: stretch;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-right {
                display: none;
            }

            .container {
                padding: 0 20px;
                margin-top: -60px;
            }

            .floating-card {
                padding: 30px;
            }

            .hero-banner {
                height: 350px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .cafes-list {
                grid-template-columns: 1fr;
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
    @include("shop::partials.thf-footer")
    <script>
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
