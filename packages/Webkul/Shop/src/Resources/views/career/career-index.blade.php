@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Careers | Life at THF & Open Positions</title>

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
            line-height: 1.6;
        }

        /* Navigation Header - uses shared header.css */

        /* HERO BANNER */
        .hero-banner {
            width: 100%;
            height: 420px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)),
                url('{{ asset("thf-assets/images/careers-banner.jpg") }}') center/cover no-repeat;
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
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            font-size: 3.5rem;
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
            max-width: 700px;
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
            from {
                opacity: 0;
                transform: translateY(60px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* SECTION TITLES */
        .section-title {
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 50px;
            text-align: center;
            position: relative;
            padding-bottom: 25px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background: #d4af37;
        }

        /* LIFE AT THF SECTION */
        .life-at-thf {
            margin-bottom: 80px;
        }

        .intro-text {
            text-align: center;
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            max-width: 800px;
            margin: 0 auto 60px;
            line-height: 1.7;
        }

        /* VALUES GRID */
        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }

        .value-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .value-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .value-icon {
            width: 80px;
            height: 80px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: #d4af37;
            font-size: 2rem;
            border: 2px solid rgba(212, 175, 55, 0.2);
            transition: all 0.3s ease;
        }

        .value-card:hover .value-icon {
            background: rgba(212, 175, 55, 0.15);
            transform: scale(1.1);
        }

        .value-card h3 {
            font-size: 1.5rem;
            font-weight: 400;
            color: #fff;
            margin-bottom: 15px;
        }

        .value-card p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.05rem;
            line-height: 1.6;
        }

        /* BENEFITS SECTION */
        .benefits-section {
            margin: 80px 0;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .benefit-item {
            background: rgba(20, 20, 20, 0.5);
            border-radius: 15px;
            padding: 25px;
            display: flex;
            align-items: center;
            gap: 20px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .benefit-item:hover {
            border-color: rgba(212, 175, 55, 0.2);
            background: rgba(20, 20, 20, 0.7);
        }

        .benefit-icon {
            width: 50px;
            height: 50px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .benefit-content h4 {
            font-size: 1.2rem;
            font-weight: 400;
            color: #fff;
            margin-bottom: 8px;
        }

        .benefit-content p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
        }

        /* OPEN POSITIONS SECTION */
        .open-positions {
            margin-top: 80px;
        }

        .positions-filter {
            display: flex;
            gap: 15px;
            margin-bottom: 40px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .filter-btn {
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

        .filter-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .filter-btn.active {
            background: rgba(212, 175, 55, 0.15);
            border-color: #d4af37;
            color: #d4af37;
        }

        /* POSITIONS GRID */
        .positions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
        }

        .position-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .position-card:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .position-header {
            padding: 30px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .position-title {
            font-size: 1.6rem;
            font-weight: 400;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .position-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
        }

        .meta-item i {
            color: #d4af37;
            width: 16px;
        }

        .position-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .tag {
            background: rgba(212, 175, 55, 0.1);
            color: #d4af37;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .position-body {
            padding: 30px;
        }

        .position-details {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
            line-height: 1.6;
        }

        .requirements-list {
            list-style: none;
            margin-bottom: 25px;
        }

        .requirements-list li {
            padding: 8px 0;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            padding-left: 25px;
        }

        .requirements-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #d4af37;
            font-weight: bold;
        }

        .position-footer {
            padding: 0 30px 30px;
            display: flex;
            gap: 15px;
        }

        .apply-btn {
            flex: 1;
            padding: 15px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .apply-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        .detail-btn {
            flex: 1;
            padding: 15px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .detail-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(212, 175, 55, 0.3);
        }

        /* CTA SECTION */
        .cta-section {
            background: rgba(212, 175, 55, 0.1);
            border-radius: 20px;
            padding: 60px;
            text-align: center;
            margin-top: 80px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
        }

        .cta-section p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-btn {
            padding: 16px 36px;
            border-radius: 12px;
            font-size: 1.1rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            border: none;
            cursor: pointer;
        }

        .cta-btn.primary {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
        }

        .cta-btn.secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .cta-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.2);
        }


        /* RESPONSIVE */
        @media (max-width: 992px) {
            .positions-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }

            .values-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }

        }

        @media (max-width: 768px) {

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
                font-size: 2.8rem;
            }

            .positions-grid {
                grid-template-columns: 1fr;
            }

            .section-title {
                font-size: 2.2rem;
            }

            .position-footer {
                flex-direction: column;
            }

            .cta-section {
                padding: 40px 20px;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .cta-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {

            .positions-filter {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-btn {
                text-align: center;
            }

            .position-meta {
                flex-direction: column;
                gap: 10px;
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
                        <li><a href="{{ route('shop.career.career-index') }}">Careers</a></li>
                        <li><a href="#">JalGhar</a></li>
                        <li><a href="{{ route('shop.contact.contact-index') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Build Your Career at THF</div>
            <div class="hero-sub">Join our passionate team dedicated to creating India's finest sweets and gifting
                experiences. Grow with us in an environment that values creativity, quality, and innovation.</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="floating-card">
            <!-- LIFE AT THF SECTION -->
            <section class="life-at-thf">
                <h2 class="section-title">Life at The HazleNut Factory</h2>

                <div class="intro-text">
                    At THF, we believe our people are our greatest ingredient. We foster a culture of innovation,
                    collaboration, and excellence where every team member contributes to our sweet success story.
                </div>

                <!-- Our Values -->
                <h3 style="font-size: 2rem; color: #fff; text-align: center; margin-bottom: 40px;">Our Core Values</h3>

                <div class="values-grid">
                    <!-- Value 1 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <h3>Passion for Quality</h3>
                        <p>We're obsessed with perfection. From sourcing the finest ingredients to crafting each sweet
                            with care, quality is at the heart of everything we do.</p>
                    </div>

                    <!-- Value 2 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h3>Innovation First</h3>
                        <p>We constantly push boundaries in sweet-making traditions, creating new experiences while
                            respecting heritage and craftsmanship.</p>
                    </div>

                    <!-- Value 3 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3>Collaborative Spirit</h3>
                        <p>We believe great things happen when diverse talents work together. Our teams collaborate
                            across departments to create magical experiences.</p>
                    </div>

                    <!-- Value 4 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3>Continuous Growth</h3>
                        <p>We invest in our people's development with training programs, mentorship, and opportunities
                            to take on new challenges.</p>
                    </div>

                    <!-- Value 5 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3>Sustainable Practices</h3>
                        <p>We're committed to ethical sourcing, reducing our environmental footprint, and supporting the
                            communities we serve.</p>
                    </div>

                    <!-- Value 6 -->
                    <div class="value-card">
                        <div class="value-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3>Excellence Always</h3>
                        <p>We strive for excellence in every interaction, every product, and every moment of service
                            delivery to our customers.</p>
                    </div>
                </div>

                <!-- Employee Benefits -->
                <div class="benefits-section">
                    <h3 style="font-size: 2rem; color: #fff; text-align: center; margin-bottom: 40px;">Employee Benefits
                        & Perks</h3>

                    <div class="benefits-grid">
                        <!-- Benefit 1 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-rupee-sign"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Competitive Compensation</h4>
                                <p>Industry-leading salaries with performance bonuses</p>
                            </div>
                        </div>

                        <!-- Benefit 2 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-home"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Health & Wellness</h4>
                                <p>Comprehensive health insurance for you and family</p>
                            </div>
                        </div>

                        <!-- Benefit 3 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Learning & Development</h4>
                                <p>Sponsored courses, workshops, and certifications</p>
                            </div>
                        </div>

                        <!-- Benefit 4 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-utensils"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Sweet Perks</h4>
                                <p>Monthly THF product allowances and sweet treats</p>
                            </div>
                        </div>

                        <!-- Benefit 5 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-plane"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Paid Time Off</h4>
                                <p>Generous vacation days and festival holidays</p>
                            </div>
                        </div>

                        <!-- Benefit 6 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-child"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Parental Support</h4>
                                <p>Maternity and paternity leave with flexibility</p>
                            </div>
                        </div>

                        <!-- Benefit 7 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-dumbbell"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Fitness & Recreation</h4>
                                <p>Gym memberships and wellness activities</p>
                            </div>
                        </div>

                        <!-- Benefit 8 -->
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-hands-helping"></i>
                            </div>
                            <div class="benefit-content">
                                <h4>Community Engagement</h4>
                                <p>Volunteer days and social responsibility initiatives</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- OPEN POSITIONS SECTION -->
            <section class="open-positions">
                <h2 class="section-title">Open Positions</h2>

                <!-- Filter Buttons -->
                <div class="positions-filter">
                    <button class="filter-btn active" data-department="all">All Positions</button>
                    <button class="filter-btn" data-department="culinary">Culinary Arts</button>
                    <button class="filter-btn" data-department="retail">Retail & Stores</button>
                    <button class="filter-btn" data-department="corporate">Corporate</button>
                    <button class="filter-btn" data-department="production">Production</button>
                    <button class="filter-btn" data-department="marketing">Marketing</button>
                </div>

                <!-- Positions Grid -->
                <div class="positions-grid">
                    <!-- Position 1 -->
                    <div class="position-card" data-department="culinary">
                        <div class="position-header">
                            <h3 class="position-title">Master Confectioner</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>New Delhi</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>5+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">Premium Pay</span>
                                <span class="tag">Creative Role</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Lead our premium confectionery team in creating innovative sweet creations while
                                maintaining traditional craftsmanship standards.
                            </p>
                            <ul class="requirements-list">
                                <li>Expertise in traditional Indian sweets and modern techniques</li>
                                <li>Experience in recipe development and quality control</li>
                                <li>Leadership skills with minimum 5 years experience</li>
                                <li>Knowledge of food safety standards</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Master Confectioner">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Master Confectioner">View Details</button>
                        </div>
                    </div>

                    <!-- Position 2 -->
                    <div class="position-card" data-department="retail">
                        <div class="position-header">
                            <h3 class="position-title">Store Manager</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Mumbai</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>3+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">Leadership Role</span>
                                <span class="tag">Customer Focus</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Oversee daily store operations at our flagship Mumbai location, ensuring exceptional
                                customer experiences and team development.
                            </p>
                            <ul class="requirements-list">
                                <li>Proven retail management experience in premium brands</li>
                                <li>Strong leadership and team development skills</li>
                                <li>Excellent customer service orientation</li>
                                <li>Inventory and sales management expertise</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Store Manager">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Store Manager">View Details</button>
                        </div>
                    </div>

                    <!-- Position 3 -->
                    <div class="position-card" data-department="marketing">
                        <div class="position-header">
                            <h3 class="position-title">Digital Marketing Specialist</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Remote / Delhi</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>2+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">Digital Growth</span>
                                <span class="tag">Creative Marketing</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Drive our digital presence and customer acquisition through innovative social media,
                                email, and content marketing strategies.
                            </p>
                            <ul class="requirements-list">
                                <li>Experience with social media platforms and analytics</li>
                                <li>Content creation and copywriting skills</li>
                                <li>Knowledge of SEO and digital advertising</li>
                                <li>Creative thinking with data-driven approach</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Digital Marketing Specialist">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Digital Marketing Specialist">View
                                Details</button>
                        </div>
                    </div>

                    <!-- Position 4 -->
                    <div class="position-card" data-department="production">
                        <div class="position-header">
                            <h3 class="position-title">Production Supervisor</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Gurgaon Facility</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>4+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">Manufacturing</span>
                                <span class="tag">Quality Control</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Oversee daily production operations at our main facility, ensuring quality, efficiency,
                                and adherence to food safety standards.
                            </p>
                            <ul class="requirements-list">
                                <li>Experience in food manufacturing environment</li>
                                <li>Knowledge of GMP and food safety protocols</li>
                                <li>Team management and production planning skills</li>
                                <li>Problem-solving and process improvement mindset</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Production Supervisor">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Production Supervisor">View Details</button>
                        </div>
                    </div>

                    <!-- Position 5 -->
                    <div class="position-card" data-department="corporate">
                        <div class="position-header">
                            <h3 class="position-title">Corporate Sales Executive</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Delhi NCR</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>3+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">B2B Sales</span>
                                <span class="tag">Corporate Gifting</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Develop and manage corporate client relationships for our premium gifting solutions and
                                bulk order business.
                            </p>
                            <ul class="requirements-list">
                                <li>Proven B2B sales experience</li>
                                <li>Corporate gifting or premium products background</li>
                                <li>Excellent communication and negotiation skills</li>
                                <li>Client relationship management expertise</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Corporate Sales Executive">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Corporate Sales Executive">View Details</button>
                        </div>
                    </div>

                    <!-- Position 6 -->
                    <div class="position-card" data-department="culinary">
                        <div class="position-header">
                            <h3 class="position-title">Junior Pastry Chef</h3>
                            <div class="position-meta">
                                <div class="meta-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>Bangalore</span>
                                </div>
                                <div class="meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>Full Time</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-briefcase"></i>
                                    <span>1+ years experience</span>
                                </div>
                            </div>
                            <div class="position-tags">
                                <span class="tag">Entry Level</span>
                                <span class="tag">Training Provided</span>
                            </div>
                        </div>
                        <div class="position-body">
                            <p class="position-details">
                                Join our creative pastry team and learn from master chefs while contributing to our
                                premium dessert creations.
                            </p>
                            <ul class="requirements-list">
                                <li>Culinary arts degree or equivalent training</li>
                                <li>Passion for pastry arts and creativity</li>
                                <li>Willingness to learn and grow</li>
                                <li>Attention to detail and quality focus</li>
                            </ul>
                        </div>
                        <div class="position-footer">
                            <button class="apply-btn" data-position="Junior Pastry Chef">
                                <i class="fas fa-paper-plane"></i> Apply Now
                            </button>
                            <button class="detail-btn" data-position="Junior Pastry Chef">View Details</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA SECTION -->
            <div class="cta-section">
                <h2>Don't See Your Dream Role?</h2>
                <p>We're always looking for passionate individuals to join our team. Send us your resume and tell us how
                    you can contribute to our sweet journey.</p>
                <div class="cta-buttons">
                    <button class="cta-btn primary" id="generalApplication">
                        <i class="fas fa-user-plus"></i> Submit General Application
                    </button>
                    <a href="{{ route('shop.contact.contact-index') }}" class="cta-btn secondary">
                        <i class="fas fa-envelope"></i> Contact HR Team
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include("shop::partials.thf-footer")

    <script>
        // Menu Toggle - handled by header.js



        // Position Filtering
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                document.querySelectorAll('.filter-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // Filter positions
                const department = button.getAttribute('data-department');
                const allPositions = document.querySelectorAll('.position-card');

                allPositions.forEach(position => {
                    if (department === 'all' || position.getAttribute('data-department') === department) {
                        position.style.display = 'block';
                        setTimeout(() => {
                            position.style.opacity = '1';
                            position.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        position.style.opacity = '0';
                        position.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            position.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Apply Button Functionality
        document.querySelectorAll('.apply-btn').forEach(button => {
            button.addEventListener('click', function () {
                const positionTitle = this.getAttribute('data-position');
                showApplicationForm(positionTitle);
            });
        });

        // View Details Button Functionality
        document.querySelectorAll('.detail-btn').forEach(button => {
            button.addEventListener('click', function () {
                const positionTitle = this.getAttribute('data-position');
                showPositionDetails(positionTitle);
            });
        });

        // General Application
        document.getElementById('generalApplication').addEventListener('click', function () {
            showApplicationForm('General Application');
        });

        // Application Form Function
        function showApplicationForm(positionTitle) {
            const modalHTML = `
                <div class="application-modal" style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.8);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 2000;
                    backdrop-filter: blur(10px);
                ">
                    <div style="
                        background: rgba(15, 15, 15, 0.95);
                        border-radius: 20px;
                        padding: 40px;
                        width: 90%;
                        max-width: 600px;
                        border: 1px solid rgba(212, 175, 55, 0.2);
                        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
                    ">
                        <h3 style="
                            font-size: 1.8rem;
                            color: #d4af37;
                            margin-bottom: 10px;
                            text-align: center;
                        ">Apply for: ${positionTitle}</h3>
                        <p style="
                            color: rgba(255, 255, 255, 0.7);
                            text-align: center;
                            margin-bottom: 30px;
                        ">Submit your application and we'll get back to you soon.</p>
                        
                        <form id="applicationForm" style="display: flex; flex-direction: column; gap: 20px;">
                            <div>
                                <label style="display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px;">Full Name *</label>
                                <input type="text" required style="
                                    width: 100%;
                                    padding: 14px;
                                    background: rgba(10, 10, 10, 0.8);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    color: white;
                                    font-family: 'Forum', serif;
                                ">
                            </div>
                            
                            <div>
                                <label style="display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px;">Email *</label>
                                <input type="email" required style="
                                    width: 100%;
                                    padding: 14px;
                                    background: rgba(10, 10, 10, 0.8);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    color: white;
                                    font-family: 'Forum', serif;
                                ">
                            </div>
                            
                            <div>
                                <label style="display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px;">Phone *</label>
                                <input type="tel" required style="
                                    width: 100%;
                                    padding: 14px;
                                    background: rgba(10, 10, 10, 0.8);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    color: white;
                                    font-family: 'Forum', serif;
                                ">
                            </div>
                            
                            <div>
                                <label style="display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px;">Upload Resume/CV *</label>
                                <input type="file" accept=".pdf,.doc,.docx" required style="
                                    width: 100%;
                                    padding: 14px;
                                    background: rgba(10, 10, 10, 0.8);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    color: white;
                                    font-family: 'Forum', serif;
                                ">
                            </div>
                            
                            <div>
                                <label style="display: block; color: rgba(255, 255, 255, 0.8); margin-bottom: 8px;">Cover Letter</label>
                                <textarea style="
                                    width: 100%;
                                    padding: 14px;
                                    background: rgba(10, 10, 10, 0.8);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    border-radius: 10px;
                                    color: white;
                                    font-family: 'Forum', serif;
                                    min-height: 120px;
                                "></textarea>
                            </div>
                            
                            <div style="display: flex; gap: 15px; margin-top: 20px;">
                                <button type="submit" style="
                                    flex: 1;
                                    padding: 16px;
                                    background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
                                    color: #000;
                                    border: none;
                                    border-radius: 12px;
                                    font-size: 1rem;
                                    font-weight: 500;
                                    cursor: pointer;
                                    font-family: 'Forum', serif;
                                ">
                                    <i class="fas fa-paper-plane"></i> Submit Application
                                </button>
                                <button type="button" id="cancelApply" style="
                                    flex: 1;
                                    padding: 16px;
                                    background: rgba(255, 255, 255, 0.05);
                                    border: 1px solid rgba(255, 255, 255, 0.1);
                                    color: rgba(255, 255, 255, 0.9);
                                    border-radius: 12px;
                                    font-size: 1rem;
                                    cursor: pointer;
                                    font-family: 'Forum', serif;
                                ">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHTML);

            // Handle form submission
            document.getElementById('applicationForm').addEventListener('submit', function (e) {
                e.preventDefault();
                alert(`Thank you for applying for ${positionTitle}! We will review your application and contact you soon.`);
                document.querySelector('.application-modal').remove();
            });

            // Handle cancel
            document.getElementById('cancelApply').addEventListener('click', function () {
                document.querySelector('.application-modal').remove();
            });

            // Close on outside click
            document.querySelector('.application-modal').addEventListener('click', function (e) {
                if (e.target === this) {
                    this.remove();
                }
            });
        }

        // Position Details Function
        function showPositionDetails(positionTitle) {
            alert(`Loading detailed job description for ${positionTitle}...\n\nIn a real implementation, this would show a modal with full job details, requirements, and application process.`);
        }
    </script>
</body>

</html>