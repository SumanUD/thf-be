@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wedding Collection | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <!-- Using the same store-locator CSS for consistent styling -->
    <link rel="stylesheet" href="{{ asset('thf-assets/css/store-locator.css') }}">
    
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

        :root {
            --primary-gold: #D4AF37;
            --text-dark: #FFFFFF;
            --text-light: rgba(255, 255, 255, 0.7);
            --card-bg: rgba(30, 30, 30, 0.8);
            --bg-dark: #0a0a0a;
            --bg-darker: #111111;
            --bg-medium: #1A1A1A;
            --border-gold: rgba(212, 175, 55, 0.1);
            --border-gold-hover: rgba(212, 175, 55, 0.3);
        }

        body {
            font-family: 'Work Sans', sans-serif;
            color: var(--text-dark);
            background: var(--bg-dark);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.5;
            min-height: 100vh;
        }

        h1, h2, h3, h4 {
            font-family: "Forum", serif;
            font-weight: 300;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 2rem 4rem;
            background-color: transparent;
        }

        /* Hero Banner */
        .hero-banner {
            position: relative;
            background: linear-gradient(135deg, #111111 0%, #1A1A1A 50%, #222222 100%);
            padding: 5rem 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border-gold);
            margin-top: 80px;
            overflow: hidden;
        }

        .hero-banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                radial-gradient(circle at 20% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 50%, rgba(139, 69, 19, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-family: 'Forum', serif;
            font-size: 4rem;
            font-weight: 300;
            letter-spacing: -1px;
            color: #fff;
            margin-bottom: 1.2rem;
            line-height: 1.1;
        }

        .hero-title span {
            color: var(--primary-gold);
        }

        .hero-sub {
            font-size: 1.25rem;
            font-weight: 300;
            color: var(--text-light);
            max-width: 700px;
            margin: 0 auto;
            border-top: 2px solid var(--border-gold-hover);
            padding-top: 1.5rem;
            line-height: 1.6;
        }

        /* Wedding Hero - overrides */
        .wedding-hero .hero-title {
            color: #fff;
        }

        .wedding-hero .hero-title span {
            color: var(--primary-gold);
        }

        /* Floating Elements */
        .hero-decoration {
            position: absolute;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            opacity: 0.05;
            animation: float 6s ease-in-out infinite;
            background: var(--primary-gold);
        }

        .deco-1 {
            top: 10%;
            left: 5%;
            animation-delay: 0s;
        }

        .deco-2 {
            top: 60%;
            right: 8%;
            animation-delay: 2s;
        }

        .deco-3 {
            bottom: 15%;
            left: 15%;
            animation-delay: 4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) scale(1);
            }

            50% {
                transform: translateY(-30px) scale(1.1);
            }
        }

        /* Floating Card */
        .floating-card {
            background: var(--card-bg);
            border-radius: 30px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        .header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .main-title {
            font-family: 'Forum', serif;
            font-size: 2.2rem;
            color: #fff;
        }

        .cafes-count {
            background: rgba(212, 175, 55, 0.1);
            padding: 0.7rem 1.8rem;
            border-radius: 50px;
            color: var(--primary-gold);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid var(--border-gold);
        }

        .cafes-count i {
            color: var(--primary-gold);
        }

        .cafes-title {
            font-family: 'Forum', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 0.5rem;
            letter-spacing: -0.5px;
        }

        /* Counter Section */
        .counter-section {
            margin: 3rem 0;
        }

        .counter-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .counter-item {
            background: rgba(20, 20, 20, 0.6);
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            border: 1px solid var(--border-gold);
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .counter-item:hover {
            transform: translateY(-8px);
            border-color: var(--border-gold-hover);
            box-shadow: 0 25px 40px -12px rgba(212, 175, 55, 0.15);
        }

        .counter-icon {
            font-size: 3rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        .counter-number {
            font-family: 'Forum', serif;
            font-size: 3.5rem;
            color: #fff;
            line-height: 1;
            margin-bottom: 0.5rem;
            font-weight: 300;
        }

        .counter-label {
            font-size: 1.1rem;
            color: var(--text-light);
            letter-spacing: 0.5px;
        }

        /* Decorative elements */
        .divider-flowers {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 3rem 0;
            color: var(--primary-gold);
            font-size: 1.2rem;
            opacity: 0.5;
        }

        /* Hamper Section */
        .hamper-section {
            margin: 4rem 0;
        }

        .hamper-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            background: rgba(20, 20, 20, 0.6);
            border-radius: 30px;
            border: 1px solid var(--border-gold);
            padding: 2.5rem;
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            margin-top: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
        }

        .hamper-layout:hover {
            border-color: var(--border-gold-hover);
            box-shadow: 0 25px 40px -12px rgba(212, 175, 55, 0.1);
        }

        .hamper-image-col {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 35px -12px rgba(0, 0, 0, 0.6);
            border: 2px solid rgba(212, 175, 55, 0.15);
        }

        .hamper-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
            filter: brightness(0.9);
        }

        .hamper-image:hover {
            transform: scale(1.02);
        }

        .hamper-content-col {
            padding: 1.5rem;
        }

        .hamper-content-title {
            font-family: 'Forum', serif;
            font-size: 3rem;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.2;
            font-weight: 300;
        }

        .hamper-content-title span {
            color: var(--primary-gold);
        }

        .hamper-content-subtitle {
            font-size: 1.2rem;
            color: var(--text-light);
            margin-bottom: 1.8rem;
            font-weight: 400;
            border-bottom: 2px solid var(--border-gold);
            padding-bottom: 1.2rem;
        }

        .hamper-description {
            margin-bottom: 2.5rem;
        }

        .hamper-description p {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .hamper-features {
            list-style: none;
            padding: 0;
            margin-bottom: 2.5rem;
        }

        .hamper-features li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
            color: var(--text-light);
            font-size: 1rem;
        }

        .hamper-features li i {
            color: var(--primary-gold);
            font-size: 1.2rem;
            width: 24px;
        }

        .team-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: linear-gradient(135deg, var(--primary-gold) 0%, #C19A2E 100%);
            color: #000;
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.4s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 20px -8px rgba(212, 175, 55, 0.3);
            font-family: 'Work Sans', sans-serif;
        }

        .team-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -8px rgba(212, 175, 55, 0.5);
        }

        .team-btn i {
            font-size: 1.2rem;
        }

        /* Why Choose section */
        .why-choose {
            margin: 5rem 0;
        }

        .why-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .why-item {
            background: rgba(20, 20, 20, 0.6);
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            border: 1px solid var(--border-gold);
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .why-item:hover {
            transform: translateY(-8px);
            border-color: var(--border-gold-hover);
            box-shadow: 0 25px 40px -12px rgba(212, 175, 55, 0.15);
        }

        .why-icon {
            font-size: 2.8rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        .why-item h3 {
            font-family: 'Forum', serif;
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 0.8rem;
            font-weight: 300;
        }

        .why-item p {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Buttons */
        .primary-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            background: linear-gradient(135deg, var(--primary-gold) 0%, #C19A2E 100%);
            color: #000;
            padding: 1rem 2.2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            border: none;
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(212, 175, 55, 0.4);
        }

        .secondary-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            background: transparent;
            color: #fff;
            padding: 1rem 2.2rem;
            border-radius: 50px;
            font-size: 1rem;
            font-weight: 500;
            border: 1px solid var(--border-gold);
            cursor: pointer;
            transition: all 0.4s ease;
            text-decoration: none;
        }

        .secondary-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--primary-gold);
            transform: translateY(-3px);
            border-color: var(--primary-gold);
        }

        /* Closing note */
        .closing-note {
            text-align: center;
            margin: 4rem 0 2rem;
            padding: 2rem;
            background: rgba(20, 20, 20, 0.6);
            border-radius: 20px;
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        .closing-note p:first-child {
            font-family: 'Forum', serif;
            font-size: 2rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .closing-note p:last-child {
            color: var(--text-light);
            font-size: 1.1rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .counter-grid,
            .why-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .hamper-layout {
                grid-template-columns: 1fr;
            }
            
            .hamper-content-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1.5rem 1rem 3rem;
            }

            .hero-banner {
                padding: 4rem 1.5rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .hero-sub {
                font-size: 1.1rem;
            }

            .counter-grid,
            .why-grid {
                grid-template-columns: 1fr;
            }
            
            .wedding-hero .hero-title {
                font-size: 2.5rem;
            }
            
            .hamper-layout {
                padding: 1.5rem;
            }

            .floating-card {
                padding: 1.5rem;
            }

            .main-title {
                font-size: 1.8rem;
            }

            .header-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .cafes-count {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-sub {
                font-size: 1rem;
            }

            .counter-number {
                font-size: 2.5rem;
            }

            .hamper-content-title {
                font-size: 2rem;
            }

            .primary-btn, .secondary-btn {
                width: 100%;
                justify-content: center;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <!-- Floating decoration elements -->
    <div class="hero-decoration deco-1"></div>
    <div class="hero-decoration deco-2"></div>
    <div class="hero-decoration deco-3"></div>

    <!-- HERO BANNER - Wedding Version -->
    <div class="hero-banner wedding-hero">
        <div class="hero-content">
            <div class="hero-title">Wedding <span>Collection</span></div>
            <div class="hero-sub">Crafting unforgettable sweet memories for your special day with artisanal indulgence</div>
        </div>
    </div>

    <div class="container">
        <!-- Floating Card -->
        <div class="floating-card">
            <div class="header-row">
                <span class="main-title">Wedding & Celebrations</span>
                <span class="cafes-count">
                    <i class="fas fa-heart"></i>
                    Artisanal Wedding Specialists
                </span>
            </div>

            <!-- COUNTER SECTION -->
            <div class="counter-section">
                <div class="counter-grid">
                    <div class="counter-item">
                        <div class="counter-icon"><i class="fas fa-cake-candles"></i></div>
                        <div class="counter-number">5000+</div>
                        <div class="counter-label">Wedding Cakes</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-icon"><i class="fas fa-gift"></i></div>
                        <div class="counter-number">15000+</div>
                        <div class="counter-label">Hampers Delivered</div>
                    </div>
                    <div class="counter-item">
                        <div class="counter-icon"><i class="fas fa-heart"></i></div>
                        <div class="counter-number">1000+</div>
                        <div class="counter-label">Happy Couples</div>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider-flowers">
                <i class="fas fa-leaf"></i>
                <i class="fas fa-heart"></i>
                <i class="fas fa-leaf"></i>
                <i class="fas fa-heart"></i>
                <i class="fas fa-leaf"></i>
            </div>

            <!-- HAMPER SECTION -->
            <div class="hamper-section">
                <div class="cafes-title">Build Your Perfect Wedding Hamper</div>
                <p style="color: var(--text-light); margin-bottom: 1rem;">Let our experts create something magical for your special day</p>

                <div class="hamper-layout">
                    <!-- Left Column: Image -->
                    <div class="hamper-image-col">
                        <img src="https://wrapshap.com/cdn/shop/files/Opulant_Hamper.jpg?v=1739100893&width=3840" 
                             alt="Luxury Wedding Hamper" 
                             class="hamper-image"
                             onerror="this.src='https://placehold.co/800x600/2a2a2a/d4af37?text=Wedding+Hamper+Collection'">
                    </div>
                    
                    <!-- Right Column: Talk to Team Content -->
                    <div class="hamper-content-col">
                        <div class="hamper-content-title">Talk to a <span>Team</span></div>
                        <div class="hamper-content-subtitle">Your personal wedding hamper specialists</div>
                        
                        <div class="hamper-description">
                            <p>Every wedding is unique, and so should be your sweet indulgence. Our wedding specialists work closely with you to curate hampers that reflect your story, theme, and taste preferences.</p>
                        </div>
                        
                        <ul class="hamper-features">
                            <li><i class="fas fa-check-circle"></i> Personalized consultation with our master confectioners</li>
                            <li><i class="fas fa-check-circle"></i> Customized packaging to match your wedding colors</li>
                            <li><i class="fas fa-check-circle"></i> Bulk orders with special wedding pricing</li>
                            <li><i class="fas fa-check-circle"></i> Sample tastings before finalizing</li>
                            <li><i class="fas fa-check-circle"></i> Pan-India delivery with premium handling</li>
                        </ul>
                        
                        <a href="mailto:weddings@hazelnutfactory.com" class="team-btn">
                            <i class="fas fa-envelope"></i>
                            weddings@hazelnutfactory.com
                        </a>
                        <p style="margin-top: 1rem; color: var(--primary-gold); font-size: 0.9rem;">
                            <i class="fas fa-phone-alt"></i> Or call us: +91 98765 43210
                        </p>
                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider-flowers">
                <i class="fas fa-leaf"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-leaf"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-leaf"></i>
            </div>

            <!-- WHY CHOOSE THF SECTION -->
            <div class="why-choose">
                <div class="cafes-title">Why Choose THF for Your Wedding</div>
                <p style="color: var(--text-light); margin-bottom: 2rem;">Creating magical moments with artisanal excellence</p>

                <div class="why-grid">
                    <div class="why-item">
                        <div class="why-icon"><i class="fas fa-award"></i></div>
                        <h3>Artisanal Quality</h3>
                        <p>Handcrafted with premium ingredients by master confectioners, ensuring every bite is perfect for your special day.</p>
                    </div>
                    
                    <div class="why-item">
                        <div class="why-icon"><i class="fas fa-paint-brush"></i></div>
                        <h3>Custom Designs</h3>
                        <p>Personalized hampers and sweet boxes that match your wedding theme and color palette perfectly.</p>
                    </div>
                    
                    <div class="why-item">
                        <div class="why-icon"><i class="fas fa-truck"></i></div>
                        <h3>Pan-India Delivery</h3>
                        <p>We deliver to wedding venues across India with special handling to ensure freshness and presentation.</p>
                    </div>
                    
                    <div class="why-item">
                        <div class="why-icon"><i class="fas fa-gem"></i></div>
                        <h3>Premium Packaging</h3>
                        <p>Elegant, luxurious packaging that adds a touch of sophistication to your wedding favors.</p>
                    </div>
                </div>
            </div>

            <!-- CLOSING NOTE -->
            <div class="closing-note">
                <p>Let us sweeten your forever</p>
                <p>Contact our wedding specialists for a personalized consultation</p>
                <div style="margin-top: 1.5rem; display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                    <a href="mailto:weddings@hazelnutfactory.com" class="primary-btn">
                        <i class="fas fa-envelope"></i>
                        Email Us
                    </a>
                    <button class="secondary-btn" onclick="alert('Please call us at +91 98765 43210')">
                        <i class="fas fa-phone-alt"></i>
                        Call Specialist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include("shop::partials.thf-footer")
</body>

</html>