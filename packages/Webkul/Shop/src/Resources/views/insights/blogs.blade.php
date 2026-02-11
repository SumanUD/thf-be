@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">

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
            line-height: 1.6;
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
            height: 380px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)),
                url('{{ asset("thf-assets/images/blog-banner.jpg") }}') center/cover no-repeat;
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
            max-width: 800px;
            padding: 0 40px;
            animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 3.2rem;
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
            font-size: 1.2rem;
            opacity: 0.85;
            font-weight: 300;
            letter-spacing: 0.5px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1200px;
            margin: -80px auto 60px;
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

        /* BLOG HEADER */
        .blog-header {
            text-align: center;
            margin-bottom: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .blog-header h1 {
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            position: relative;
            display: block;
            text-align: center;
        }

        .blog-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: #d4af37;
        }

        .blog-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* BLOG CATEGORIES */
        .blog-categories {
            display: flex;
            gap: 15px;
            margin-bottom: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-btn {
            padding: 12px 28px;
            background: rgba(20, 20, 20, 0.7);
            border: 1px solid rgba(212, 175, 55, 0.2);
            color: rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            font-size: 1rem;
        }

        .category-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .category-btn.active {
            background: rgba(212, 175, 55, 0.15);
            border-color: #d4af37;
            color: #d4af37;
        }

        /* FEATURED POST */
        .featured-post {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 60px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .featured-post:hover {
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .featured-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        @media (max-width: 992px) {
            .featured-content {
                grid-template-columns: 1fr;
            }
        }

        .featured-image {
            height: 100%;
            min-height: 400px;
            overflow: hidden;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .featured-post:hover .featured-image img {
            transform: scale(1.05);
        }

        .featured-text {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .featured-badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .featured-title {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .featured-excerpt {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .featured-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            margin-bottom: 30px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta-item i {
            color: #d4af37;
        }

        .read-more-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            align-self: flex-start;
            font-family: "Forum", serif;
        }

        .read-more-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        /* BLOG GRID */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .blog-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .blog-card-image {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .blog-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .blog-card:hover .blog-card-image img {
            transform: scale(1.1);
        }

        .blog-card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .blog-card-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .blog-card-title {
            font-size: 1.5rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .blog-card-excerpt {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-bottom: 20px;
            line-height: 1.6;
            flex: 1;
        }

        .blog-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .blog-card-link {
            color: #d4af37;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .blog-card-link:hover {
            color: #fff;
            transform: translateX(5px);
        }

        .reading-time {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        /* SIDEBAR */
        .blog-sidebar {
            margin-top: 60px;
        }

        .sidebar-title {
            font-size: 1.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .sidebar-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        .sidebar-widget {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .search-box {
            position: relative;
        }

        .search-box input {
            width: 100%;
            padding: 16px 50px 16px 20px;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-family: "Forum", serif;
            font-size: 1rem;
        }

        .search-box button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #d4af37;
            cursor: pointer;
            font-size: 1.2rem;
        }

        .recent-posts-list {
            list-style: none;
        }

        .recent-post-item {
            padding: 15px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .recent-post-item:last-child {
            border-bottom: none;
        }

        .recent-post-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 1.05rem;
            transition: color 0.3s ease;
            display: block;
        }

        .recent-post-link:hover {
            color: #d4af37;
        }

        .recent-post-date {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .tag-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag-item {
            background: rgba(212, 175, 55, 0.1);
            color: #d4af37;
            padding: 8px 18px;
            border-radius: 20px;
            font-size: 0.9rem;
            text-decoration: none;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .tag-item:hover {
            background: rgba(212, 175, 55, 0.2);
            transform: translateY(-2px);
        }

        .newsletter-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .newsletter-form input {
            padding: 16px 20px;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            color: white;
            font-family: "Forum", serif;
            font-size: 1rem;
        }

        .newsletter-form button {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 16px;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .newsletter-form button:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
        }

        /* PAGINATION */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 60px;
        }

        .pagination-btn {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: rgba(20, 20, 20, 0.7);
            border: 1px solid rgba(212, 175, 55, 0.2);
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Forum", serif;
        }

        .pagination-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .pagination-btn.active {
            background: rgba(212, 175, 55, 0.15);
            border-color: #d4af37;
            color: #d4af37;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.disabled:hover {
            background: rgba(20, 20, 20, 0.7);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .pagination-dots {
            color: rgba(255, 255, 255, 0.5);
        }

        .sidebar-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 60px;
        }

        /* NEWSLETTER CTA */
        .newsletter-cta {
            background: rgba(212, 175, 55, 0.1);
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            margin-top: 80px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .newsletter-cta h2 {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
        }

        .newsletter-cta p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 30px;
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
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
            }
        }

        @media (max-width: 992px) {
            .menu-left {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .blog-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
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
                height: 320px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .blog-grid {
                grid-template-columns: 1fr;
            }

            .featured-title {
                font-size: 1.8rem;
            }

            .featured-text {
                padding: 30px;
            }

            .newsletter-cta {
                padding: 30px 20px;
            }
        }

        @media (max-width: 576px) {
            .menu-left {
                grid-template-columns: 1fr;
            }

            .mega-panel {
                padding: 100px 30px 40px;
            }

            .blog-categories {
                flex-direction: column;
                align-items: stretch;
            }

            .category-btn {
                text-align: center;
            }

            .featured-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .pagination {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">THF Journal</div>
            <div class="hero-sub">Discover stories behind our sweets, expert tips, seasonal celebrations, and the art of premium gifting. Welcome to our world of flavor and tradition.</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="floating-card">
            <!-- Blog Header -->
            <div class="blog-header">
                <h1>Latest Stories & Insights</h1>
                <p>From sweet-making traditions to modern gifting trends, explore articles that celebrate our passion for quality and innovation.</p>
            </div>

            <!-- Blog Categories -->
            <div class="blog-categories">
                <button class="category-btn active" data-category="all">All Articles</button>
                <button class="category-btn" data-category="sweet-making">Sweet Making</button>
                <button class="category-btn" data-category="gifting">Gifting Guide</button>
                <button class="category-btn" data-category="seasonal">Seasonal</button>
                <button class="category-btn" data-category="behind-scenes">Behind the Scenes</button>
                <button class="category-btn" data-category="health">Health & Wellness</button>
                <button class="category-btn" data-category="recipes">Recipes</button>
            </div>

            <!-- Featured Post -->
            <div class="featured-post">
                <div class="featured-content">
                    <div class="featured-image">
                        <img src="https://images.unsplash.com/photo-1519676867240-f03562e64548?w=800" alt="The Art of Baklava">
                    </div>
                    <div class="featured-text">
                        <span class="featured-badge">Featured Story</span>
                        <h2 class="featured-title">The Art of Baklava: A Centuries-Old Tradition</h2>
                        <p class="featured-excerpt">Discover the intricate craftsmanship behind our premium baklava, from selecting the finest pistachios to perfecting the delicate layering technique passed down through generations of master confectioners.</p>
                        <div class="featured-meta">
                            <div class="meta-item">
                                <i class="far fa-calendar"></i>
                                <span>December 15, 2024</span>
                            </div>
                            <div class="meta-item">
                                <i class="far fa-clock"></i>
                                <span>8 min read</span>
                            </div>
                            <div class="meta-item">
                                <i class="far fa-folder"></i>
                                <span>Sweet Making</span>
                            </div>
                        </div>
                        <a href="#" class="read-more-btn">
                            Read Full Story <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog Grid -->
            <div class="blog-grid">
                <!-- Blog Post 1 -->
                <article class="blog-card" data-category="gifting">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1549465220-1a8b9238cd48?w=800" alt="Corporate Gifting Trends">
                        <span class="blog-card-badge">Gifting Guide</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Nov 28, 2024</span>
                            <span><i class="far fa-folder"></i> Gifting</span>
                        </div>
                        <h3 class="blog-card-title">Corporate Gifting Trends 2025: Making Lasting Impressions</h3>
                        <p class="blog-card-excerpt">Explore how premium sweets are becoming the preferred choice for corporate gifting, combining tradition with personal touch.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">5 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 2 -->
                <article class="blog-card" data-category="seasonal">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1604861979844-fe5f17c52ef6?w=800" alt="Diwali Celebrations">
                        <span class="blog-card-badge">Seasonal</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Nov 20, 2024</span>
                            <span><i class="far fa-folder"></i> Seasonal</span>
                        </div>
                        <h3 class="blog-card-title">Diwali Delights: Sweet Traditions Across India</h3>
                        <p class="blog-card-excerpt">A journey through regional Diwali sweet traditions and how we're reimagining them for modern celebrations.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">6 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 3 -->
                <article class="blog-card" data-category="health">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1587049352846-4a222e784098?w=800" alt="Natural Sweeteners">
                        <span class="blog-card-badge">Health & Wellness</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Nov 12, 2024</span>
                            <span><i class="far fa-folder"></i> Health</span>
                        </div>
                        <h3 class="blog-card-title">The Sweet Balance: Natural Sweeteners in Modern Confectionery</h3>
                        <p class="blog-card-excerpt">How we're incorporating dates, jaggery, and honey into our sweets for healthier indulgence without compromising taste.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">7 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 4 -->
                <article class="blog-card" data-category="behind-scenes">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?w=800" alt="THF Kitchen">
                        <span class="blog-card-badge">Behind the Scenes</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Nov 5, 2024</span>
                            <span><i class="far fa-folder"></i> Behind Scenes</span>
                        </div>
                        <h3 class="blog-card-title">A Day in Our Kitchen: Crafting Premium Sweets</h3>
                        <p class="blog-card-excerpt">Step inside our state-of-the-art kitchen to see how tradition meets technology in creating our signature sweets.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">4 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 5 -->
                <article class="blog-card" data-category="recipes">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1608797178974-15b35a64ede9?w=800" alt="Date Recipes">
                        <span class="blog-card-badge">Recipes</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Oct 28, 2024</span>
                            <span><i class="far fa-folder"></i> Recipes</span>
                        </div>
                        <h3 class="blog-card-title">5 Date-Based Recipes for Festive Seasons</h3>
                        <p class="blog-card-excerpt">Creative ways to incorporate premium dates into your festive cooking, from desserts to savory dishes.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">5 min read</span>
                        </div>
                    </div>
                </article>

                <!-- Blog Post 6 -->
                <article class="blog-card" data-category="sweet-making">
                    <div class="blog-card-image">
                        <img src="https://images.unsplash.com/photo-1596040033229-a0b7e580c034?w=800" alt="Saffron Quality">
                        <span class="blog-card-badge">Sweet Making</span>
                    </div>
                    <div class="blog-card-content">
                        <div class="blog-card-meta">
                            <span><i class="far fa-calendar"></i> Oct 15, 2024</span>
                            <span><i class="far fa-folder"></i> Sweet Making</span>
                        </div>
                        <h3 class="blog-card-title">Saffron Selection: Why Quality Matters in Premium Sweets</h3>
                        <p class="blog-card-excerpt">Discover how we source the world's finest saffron and why it makes all the difference in our premium sweets.</p>
                        <div class="blog-card-footer">
                            <a href="#" class="blog-card-link">
                                Read More <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="reading-time">6 min read</span>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="pagination-btn disabled">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <span class="pagination-dots">...</span>
                <button class="pagination-btn">8</button>
                <button class="pagination-btn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Sidebar Section -->
            <div class="blog-sidebar">
                <div class="sidebar-grid">
                    <!-- Main Content Area -->
                    <div>
                        <!-- Newsletter CTA -->
                        <div class="newsletter-cta">
                            <h2>Stay Updated with Sweet Stories</h2>
                            <p>Subscribe to our newsletter for exclusive recipes, behind-the-scenes insights, and seasonal specials delivered to your inbox.</p>
                            <div class="newsletter-form">
                                <input type="email" placeholder="Enter your email address" required>
                                <button type="submit">
                                    <i class="fas fa-envelope"></i> Subscribe Now
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Widgets -->
                    <div>
                        <!-- Search Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Search Articles</h3>
                            <div class="search-box">
                                <input type="text" placeholder="Type keywords...">
                                <button><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                        <!-- Recent Posts Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Recent Posts</h3>
                            <ul class="recent-posts-list">
                                <li class="recent-post-item">
                                    <a href="#" class="recent-post-link">The Art of Baklava: A Centuries-Old Tradition</a>
                                    <div class="recent-post-date">
                                        <i class="far fa-calendar"></i> Dec 15, 2024
                                    </div>
                                </li>
                                <li class="recent-post-item">
                                    <a href="#" class="recent-post-link">Corporate Gifting Trends 2025</a>
                                    <div class="recent-post-date">
                                        <i class="far fa-calendar"></i> Nov 28, 2024
                                    </div>
                                </li>
                                <li class="recent-post-item">
                                    <a href="#" class="recent-post-link">Diwali Delights: Sweet Traditions</a>
                                    <div class="recent-post-date">
                                        <i class="far fa-calendar"></i> Nov 20, 2024
                                    </div>
                                </li>
                                <li class="recent-post-item">
                                    <a href="#" class="recent-post-link">Natural Sweeteners in Modern Confectionery</a>
                                    <div class="recent-post-date">
                                        <i class="far fa-calendar"></i> Nov 12, 2024
                                    </div>
                                </li>
                                <li class="recent-post-item">
                                    <a href="#" class="recent-post-link">A Day in Our Kitchen</a>
                                    <div class="recent-post-date">
                                        <i class="far fa-calendar"></i> Nov 5, 2024
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <!-- Categories Widget -->
                        <div class="sidebar-widget">
                            <h3 class="sidebar-title">Categories</h3>
                            <div class="tag-cloud">
                                <a href="#" class="tag-item">Sweet Making</a>
                                <a href="#" class="tag-item">Gifting Guide</a>
                                <a href="#" class="tag-item">Seasonal</a>
                                <a href="#" class="tag-item">Behind Scenes</a>
                                <a href="#" class="tag-item">Health</a>
                                <a href="#" class="tag-item">Recipes</a>
                                <a href="#" class="tag-item">Festive</a>
                                <a href="#" class="tag-item">Tradition</a>
                            </div>
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

        // Blog Category Filtering
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // Filter blog posts
                const category = button.getAttribute('data-category');
                const allPosts = document.querySelectorAll('.blog-card');
                
                allPosts.forEach(post => {
                    if (category === 'all' || post.getAttribute('data-category') === category) {
                        post.style.display = 'flex';
                        setTimeout(() => {
                            post.style.opacity = '1';
                            post.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        post.style.opacity = '0';
                        post.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            post.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Search Functionality
        const searchInput = document.querySelector('.search-box input');
        const searchButton = document.querySelector('.search-box button');

        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') performSearch();
        });

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            if (searchTerm) {
                alert(`Searching for: "${searchTerm}"\n\nIn a real implementation, this would filter blog posts or redirect to search results.`);
                searchInput.value = '';
            }
        }

        // Newsletter Subscription
        const newsletterForm = document.querySelector('.newsletter-form');
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            if (email) {
                alert(`Thank you for subscribing with: ${email}\nYou'll receive our sweet stories soon!`);
                this.reset();
            }
        });

        // Pagination
        document.querySelectorAll('.pagination-btn:not(.disabled)').forEach(button => {
            button.addEventListener('click', function() {
                if (this.classList.contains('active')) return;
                
                // Update active state
                document.querySelectorAll('.pagination-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                
                if (!this.querySelector('i')) {
                    this.classList.add('active');
                    const pageNum = this.textContent;
                    alert(`Loading page ${pageNum}...\n\nIn a real implementation, this would load more blog posts.`);
                }
            });
        });

        // Read More Links
        document.querySelectorAll('.blog-card-link, .read-more-btn').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const postTitle = this.closest('article')?.querySelector('.blog-card-title')?.textContent || 
                                this.closest('.featured-post')?.querySelector('.featured-title')?.textContent;
                alert(`Loading article: "${postTitle}"\n\nIn a real implementation, this would navigate to the blog post detail page.`);
            });
        });

        // Tag Cloud Click
        document.querySelectorAll('.tag-item').forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                const tagText = this.textContent;
                
                // Find and click the corresponding category button
                const categoryButtons = document.querySelectorAll('.category-btn');
                categoryButtons.forEach(btn => {
                    if (btn.textContent.toLowerCase() === tagText.toLowerCase()) {
                        btn.click();
                    }
                });
            });
        });

        // Recent Posts Click
        document.querySelectorAll('.recent-post-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const postTitle = this.textContent;
                alert(`Loading recent post: "${postTitle}"\n\nIn a real implementation, this would navigate to the blog post detail page.`);
            });
        });
    </script>
</body>
</html>