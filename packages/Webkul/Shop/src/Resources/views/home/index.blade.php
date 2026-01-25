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
            background: #000;
            color: white;
            height: 100vh;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            font-family: "Forum", serif;
        }

        .container {
            height: 100vh;
            position: relative;
        }

        /* Navigation Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 60px;
            z-index: 1000;
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
        }

        .header.scrolled {
            background: rgba(0, 0, 0, 0.9);
            height: 70px;
        }

        /* Left side: Hamburger + small logo */
        .nav-left {
            flex: 1;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .hamburger-logo {
            height: 40px;
            width: auto;
        }

        .menu-toggle {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 10px;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1001;
        }

        .menu-toggle:hover {
            color: #d4af37;
            transform: scale(1.1);
        }

        .menu-toggle .bar {
            display: block;
            width: 25px;
            height: 2px;
            background: white;
            margin: 5px 0;
            transition: 0.3s;
        }

        .menu-toggle.active .bar:nth-child(1) {
            transform: rotate(-45deg) translate(-5px, 5px);
        }

        .menu-toggle.active .bar:nth-child(2) {
            opacity: 0;
        }

        .menu-toggle.active .bar:nth-child(3) {
            transform: rotate(45deg) translate(-5px, -5px);
        }

        /* Center: Logo */
        .nav-center {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .logo {
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 280px;
            height: auto;
            transition: transform 0.3s ease;
            max-width: 100%;
        }

        .logo img:hover {
            transform: scale(1.05);
        }

        /* Right side: Navigation Links */
        .nav-right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 25px;
        }

        /* Search */
        .search-container {
            position: relative;
        }

        .search-toggle {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            font-size: 16px;
            padding: 8px;
            transition: all 0.3s ease;
        }

        .search-toggle:hover {
            color: #d4af37;
        }

        .search-box {
            position: absolute;
            top: 100%;
            right: 0;
            margin-top: 10px;
            width: 300px;
            background: rgba(0, 0, 0, 0.98);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 15px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .search-box.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .search-box input {
            width: 100%;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 12px 15px;
            color: white;
            font-size: 14px;
            font-family: "Forum", serif;
        }

        .search-box input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .search-box input:focus {
            outline: none;
            border-color: #d4af37;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 8px 0;
            position: relative;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-family: "Forum", serif;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 1px;
            background: #d4af37;
            transition: width 0.3s ease;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Dropdowns */
        .nav-dropdown {
            position: relative;
        }

        .nav-dropdown:hover .dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: all;
        }

        .dropdown-content {
            position: absolute;
            top: calc(100% + 10px);
            right: -20px;
            background: rgba(0, 0, 0, 0.98);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 12px;
            padding: 20px;
            min-width: 220px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1001;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(20px);
        }

        .dropdown-content::before {
            content: '';
            position: absolute;
            top: -8px;
            right: 40px;
            width: 16px;
            height: 16px;
            background: rgba(0, 0, 0, 0.98);
            transform: rotate(45deg);
            border-left: 1px solid rgba(212, 175, 55, 0.2);
            border-top: 1px solid rgba(212, 175, 55, 0.2);
        }

        .dropdown-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 14px;
            font-weight: 300;
            padding: 12px 0;
            display: block;
            transition: all 0.2s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            padding-left: 10px;
        }

        .dropdown-link:last-child {
            border-bottom: none;
        }

        .dropdown-link:hover {
            color: #d4af37;
            transform: translateX(10px);
        }

        /* Sign In Dropdown with Cart */
        .signin-dropdown .dropdown-content {
            min-width: 280px;
            padding: 25px;
        }

        .signin-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 15px;
        }

        .signin-header h4 {
            color: #d4af37;
            font-size: 18px;
            margin-bottom: 8px;
            font-family: "Forum", serif;
        }

        .signin-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 13px;
        }

        .signin-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: #d4af37;
            color: #000;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            text-align: center;
            margin-bottom: 10px;
            font-family: "Forum", serif;
        }

        .signin-btn:hover {
            background: #c9a033;
        }

        .signin-btn.secondary {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .signin-btn.secondary:hover {
            border-color: #d4af37;
            color: #d4af37;
        }

        .cart-section {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .cart-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .cart-link:hover {
            color: #d4af37;
        }

        .cart-link i {
            font-size: 20px;
        }

        .cart-count {
            background: #d4af37;
            color: #000;
            font-size: 11px;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: auto;
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
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding: 120px 60px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .menu-left {
            width: 100%;
            display: flex;
            justify-content: space-between;
            gap: 40px;
            margin-bottom: 40px;
            padding-bottom: 40px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
            flex-wrap: wrap;
        }

        .links-col {
            flex: 1;
            min-width: 180px;
        }

        .col-title {
            font-size: 12px;
            font-weight: 600;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 30px;
            opacity: 0.7;
            position: relative;
            padding-bottom: 15px;
        }

        .col-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 1px;
            background: #d4af37;
            opacity: 0.5;
        }

        .links-col ul {
            list-style: none;
        }

        .links-col li {
            margin-bottom: 20px;
        }

        .links-col a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 18px;
            font-weight: 300;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            padding: 8px 0;
            display: block;
            position: relative;
        }

        .links-col a:hover {
            color: #d4af37;
            transform: translateX(10px);
        }

        /* Video Section */
        .video-section {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 1;
            transition: opacity 1.5s cubic-bezier(0.76, 0, 0.24, 1);
        }

        #background-video {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            object-fit: cover;
            filter: none;
            transition: all 1.8s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.2));
            opacity: 0;
            transition: opacity 1.5s cubic-bezier(0.76, 0, 0.24, 1);
        }

        /* Image Gallery */
        .image-gallery {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: 0;
            opacity: 0;
            transition: opacity 1.5s cubic-bezier(0.76, 0, 0.24, 1);
            pointer-events: none;
        }

        .gallery-item-main {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transform: translateY(100%);
            transition: all 1.2s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .gallery-item-main.active {
            opacity: 1;
            transform: translateY(0);
            z-index: 1;
        }

        .gallery-item-main.past {
            opacity: 0;
            transform: translateY(-100%);
        }

        .gallery-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: brightness(0.6);
        }

        .category-content {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            padding: 0 100px;
            z-index: 2;
        }

        .category-title {
            font-size: 4.5rem;
            font-weight: 300;
            margin-bottom: 20px;
            letter-spacing: -2px;
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s cubic-bezier(0.76, 0, 0.24, 1) 0.3s;
            text-transform: uppercase;
            line-height: 1.1;
            max-width: 800px;
            color: black;
        }

        .category-subtitle {
            font-size: 1.4rem;
            font-weight: 300;
            line-height: 1.6;
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s cubic-bezier(0.76, 0, 0.24, 1) 0.5s;
            max-width: 600px;
            color: rgba(0, 0, 0, 0.9);
        }

        .gallery-item-main.active .category-title,
        .gallery-item-main.active .category-subtitle {
            opacity: 1;
            transform: translateY(0);
        }

        /* Content Section */
        .content-section {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            max-width: 800px;
            width: 90%;
            text-align: center;
            pointer-events: none;
        }

        .list-heading {
            font-size: 5rem;
            font-weight: 300;
            margin-bottom: 40px;
            letter-spacing: -2px;
            position: relative;
            overflow: hidden;
            height: 120px;
        }

        .heading-text {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%) translateY(120px);
            opacity: 0;
            transition: all 1.2s cubic-bezier(0.76, 0, 0.24, 1);
            filter: blur(10px);
            width: 100%;
        }

        .heading-text.visible {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
            filter: blur(0);
        }

        .list-item {
            position: relative;
            width: 100%;
            text-align: center;
            pointer-events: none;
            overflow: hidden;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(80px) scale(0.95);
            transition: all 1.2s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .list-item.visible,
        .list-item.active {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        .item-content {
            font-size: 1.8rem;
            font-weight: 300;
            line-height: 1.5;
            letter-spacing: 0.5px;
        }

        .text-mask {
            position: relative;
            display: inline-block;
            overflow: hidden;
            padding-bottom: 5px;
        }

        .text-line {
            display: inline-block;
            transform: translateY(100%);
            opacity: 0;
            transition: all 0.9s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .list-item.active .text-line {
            transform: translateY(0);
            opacity: 1;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: fixed;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            opacity: 0.9;
            transition: all 1s cubic-bezier(0.76, 0, 0.24, 1);
        }

        .scroll-text {
            font-size: 0.8rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.8);
        }

        .scroll-arrow svg {
            width: 24px;
            height: 24px;
        }

        .arrow-path {
            stroke: rgba(255, 255, 255, 0.8);
            stroke-width: 2;
            fill: none;
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: drawArrow 2s ease-in-out infinite;
        }

        @keyframes drawArrow {
            0%, 100% { stroke-dashoffset: 100; }
            50% { stroke-dashoffset: 0; }
        }

        /* Footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.85);
            color: #fff;
            padding: 40px 20px 20px;
            z-index: 5;
            border-top: 1px solid rgba(212, 175, 55, 0.2);
            backdrop-filter: blur(10px);
            transform: translateY(100%);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            pointer-events: none;
        }

        .footer.show {
            transform: translateY(0);
            pointer-events: all;
        }

        .footer-content {
            max-width: 1300px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 30px;
        }

        .footer-section h3 {
            font-size: 1.2rem;
            margin-bottom: 20px;
            color: #d4af37;
            font-weight: 500;
            letter-spacing: 1px;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            line-height: 1.6;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #d4af37;
        }

        .footer-links {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 15px;
        }

        .social-icon {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        .social-icon:hover {
            background: #d4af37;
            transform: translateY(-3px);
            border-color: #d4af37;
            color: #000;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
        }

        .footer-bottom a {
            color: #d4af37;
        }

        /* Hide scrollbar */
        body::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .logo img { width: 200px; }
            .nav-right { gap: 15px; }
            .nav-link { font-size: 12px; }
            .list-heading { font-size: 3.5rem; height: 100px; }
            .category-title { font-size: 3rem; }
            .category-content { padding: 0 60px; }
        }

        @media (max-width: 768px) {
            .header { padding: 0 15px; height: 70px; }
            .logo img { width: 150px; }
            .nav-right { gap: 10px; }
            .nav-link { font-size: 11px; letter-spacing: 0; }
            .list-heading { font-size: 2.5rem; height: 80px; }
            .item-content { font-size: 1.2rem; }
            .category-title { font-size: 2.5rem; }
            .category-subtitle { font-size: 1rem; }
            .category-content { padding: 0 30px; }
            .hamburger-logo { height: 30px; }
        }

        @media (max-width: 480px) {
            .logo img { width: 120px; }
            .hamburger-logo { height: 25px; }
            .list-heading { font-size: 2rem; }
            .category-title { font-size: 2rem; }
        }
    </style>
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

    <script>
        // Menu Controller
        class MenuController {
            constructor() {
                this.menuToggle = document.querySelector('.menu-toggle');
                this.megaMenu = document.querySelector('.mega-menu');
                this.header = document.querySelector('.header');
                this.searchToggle = document.querySelector('.search-toggle');
                this.searchBox = document.querySelector('.search-box');

                this.init();
            }

            init() {
                this.menuToggle.addEventListener('click', () => this.toggleMenu());

                document.addEventListener('click', (e) => {
                    if (!this.megaMenu.contains(e.target) &&
                        !this.menuToggle.contains(e.target) &&
                        this.megaMenu.classList.contains('active')) {
                        this.closeMenu();
                    }

                    // Close search if clicking outside
                    if (!e.target.closest('.search-container')) {
                        this.searchBox.classList.remove('active');
                    }
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeMenu();
                        this.searchBox.classList.remove('active');
                    }
                });

                // Search toggle
                this.searchToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.searchBox.classList.toggle('active');
                    if (this.searchBox.classList.contains('active')) {
                        this.searchBox.querySelector('input').focus();
                    }
                });

                window.addEventListener('scroll', () => this.handleScroll());
            }

            toggleMenu() {
                this.megaMenu.classList.toggle('active');
                this.menuToggle.classList.toggle('active');
                document.body.style.overflow = this.megaMenu.classList.contains('active') ? 'hidden' : '';
            }

            closeMenu() {
                this.megaMenu.classList.remove('active');
                this.menuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            handleScroll() {
                if (window.scrollY > 50) {
                    this.header.classList.add('scrolled');
                } else {
                    this.header.classList.remove('scrolled');
                }
            }
        }

        // Scroll Controller
        class LuxuryGiftingScroll {
            constructor() {
                this.video = document.getElementById('background-video');
                this.videoSection = document.querySelector('.video-section');
                this.videoOverlay = document.querySelector('.video-overlay');
                this.imageGallery = document.querySelector('.image-gallery');
                this.galleryItems = document.querySelectorAll('.gallery-item-main');
                this.headingText = document.querySelector('.heading-text');
                this.listItem = document.querySelector('.list-item');
                this.textLine = document.querySelector('.text-line');
                this.scrollIndicator = document.querySelector('.scroll-indicator');
                this.footer = document.querySelector('.footer');

                this.currentIndex = 0;
                this.maxIndex = 6;
                this.isAnimating = false;
                this.animationDuration = 1200;
                this.lastScrollTime = 0;
                this.scrollDelay = 800;

                this.init();
            }

            init() {
                this.video.play().catch(console.log);
                this.headingText.classList.add('visible');
                this.updateDisplay();

                this.handleWheel();
                this.handleKeys();
                this.handleTouch();
            }

            handleWheel() {
                window.addEventListener('wheel', (e) => {
                    e.preventDefault();

                    const now = Date.now();
                    if (now - this.lastScrollTime < this.scrollDelay || this.isAnimating) return;

                    this.lastScrollTime = now;

                    if (Math.abs(e.deltaY) > 5) {
                        if (e.deltaY > 0) {
                            this.nextItem();
                        } else {
                            this.previousItem();
                        }
                    }
                }, { passive: false });
            }

            handleKeys() {
                document.addEventListener('keydown', (e) => {
                    if (this.isAnimating) return;

                    if (e.key === 'ArrowDown' || e.key === ' ') {
                        e.preventDefault();
                        this.nextItem();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        this.previousItem();
                    }
                });
            }

            handleTouch() {
                let touchStartY = 0;

                document.addEventListener('touchstart', (e) => {
                    touchStartY = e.touches[0].clientY;
                }, { passive: true });

                document.addEventListener('touchend', (e) => {
                    if (this.isAnimating) return;

                    const touchEndY = e.changedTouches[0].clientY;
                    const touchDiff = touchStartY - touchEndY;

                    if (Math.abs(touchDiff) > 80) {
                        if (touchDiff > 0) {
                            this.nextItem();
                        } else {
                            this.previousItem();
                        }
                    }
                }, { passive: true });
            }

            nextItem() {
                if (this.currentIndex >= this.maxIndex) return;
                this.currentIndex++;
                this.animateTransition();
            }

            previousItem() {
                if (this.currentIndex <= 0) return;
                this.currentIndex--;
                this.animateTransition();
            }

            animateTransition() {
                if (this.isAnimating) return;
                this.isAnimating = true;
                this.updateDisplay();

                setTimeout(() => {
                    this.isAnimating = false;
                }, this.animationDuration);
            }

            updateDisplay() {
                if (this.currentIndex === this.maxIndex) {
                    this.footer.classList.add('show');
                    this.imageGallery.style.opacity = '1';
                    this.imageGallery.style.zIndex = '1';
                    this.videoSection.style.opacity = '0';
                    this.updateGallery(true);
                    this.listItem.classList.remove('visible', 'active');
                    this.scrollIndicator.style.opacity = '0.2';
                } else {
                    this.footer.classList.remove('show');

                    if (this.currentIndex === 0) {
                        this.resetToInitialState();
                    } else if (this.currentIndex === 1) {
                        this.showTextWithVideo();
                    } else if (this.currentIndex >= 2 && this.currentIndex <= 5) {
                        this.showCategoryGallery();
                    }
                }
            }

            resetToInitialState() {
                this.videoSection.style.opacity = '1';
                this.videoOverlay.style.opacity = '0';
                this.video.style.filter = 'none';
                this.imageGallery.style.opacity = '0';
                this.imageGallery.style.zIndex = '0';
                this.resetAllGalleryItems();

                this.headingText.classList.add('visible');
                this.listItem.classList.remove('visible', 'active');
                this.textLine.style.transform = 'translateY(100%)';
                this.textLine.style.opacity = '0';
                this.scrollIndicator.style.opacity = '0.9';
            }

            showTextWithVideo() {
                this.videoSection.style.opacity = '1';
                this.videoOverlay.style.opacity = '0.4';
                this.video.style.filter = 'blur(4px) brightness(0.7) saturate(1.2)';
                this.imageGallery.style.opacity = '0';
                this.imageGallery.style.zIndex = '0';
                this.resetAllGalleryItems();

                this.headingText.classList.add('visible');
                this.listItem.classList.add('visible', 'active');

                setTimeout(() => {
                    this.textLine.style.transform = 'translateY(0)';
                    this.textLine.style.opacity = '1';
                }, 100);

                this.scrollIndicator.style.opacity = '0.2';
            }

            showCategoryGallery() {
                this.videoSection.style.opacity = '0';
                this.imageGallery.style.opacity = '1';
                this.imageGallery.style.zIndex = '1';

                this.headingText.classList.remove('visible');
                this.listItem.classList.remove('visible', 'active');
                this.scrollIndicator.style.opacity = '0.2';

                this.updateGallery(false);
            }

            resetAllGalleryItems() {
                this.galleryItems.forEach(item => {
                    item.classList.remove('active', 'past');
                    const title = item.querySelector('.category-title');
                    const subtitle = item.querySelector('.category-subtitle');
                    if (title) {
                        title.style.opacity = '0';
                        title.style.transform = 'translateY(50px)';
                    }
                    if (subtitle) {
                        subtitle.style.opacity = '0';
                        subtitle.style.transform = 'translateY(30px)';
                    }
                });
            }

            updateGallery(forFooter = false) {
                this.resetAllGalleryItems();

                const galleryIndex = forFooter ? 3 : this.currentIndex - 2;
                if (galleryIndex >= 0 && galleryIndex < this.galleryItems.length) {
                    const currentItem = this.galleryItems[galleryIndex];
                    currentItem.classList.add('active');

                    setTimeout(() => {
                        const title = currentItem.querySelector('.category-title');
                        const subtitle = currentItem.querySelector('.category-subtitle');

                        if (title) {
                            title.style.opacity = forFooter ? '0.7' : '1';
                            title.style.transform = 'translateY(0)';
                        }
                        if (subtitle) {
                            subtitle.style.opacity = forFooter ? '0.7' : '1';
                            subtitle.style.transform = 'translateY(0)';
                        }
                    }, 300);

                    for (let i = 0; i < galleryIndex; i++) {
                        this.galleryItems[i].classList.add('past');
                    }
                }
            }
        }

        // Update cart count
        function updateCartCount() {
            fetch('{{ route("shop.api.checkout.cart.index") }}')
                .then(response => response.json())
                .then(data => {
                    const count = data.data ? data.data.items_qty || 0 : 0;
                    document.getElementById('cart-count').textContent = count;
                })
                .catch(() => {
                    document.getElementById('cart-count').textContent = '0';
                });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            new MenuController();
            new LuxuryGiftingScroll();
            updateCartCount();
        });
    </script>
</body>
</html>
