@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FAQs | The HazleNut Factory</title>

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

        /* FAQ HEADER */
        .faq-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .faq-header h1 {
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .faq-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: #d4af37;
        }

        .faq-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* FAQ CATEGORIES */
        .faq-categories {
            display: flex;
            gap: 15px;
            margin-bottom: 40px;
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

        /* FAQ ACCORDION */
        .faq-accordion {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .faq-item {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .faq-item.active {
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .faq-question {
            padding: 28px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .faq-question h3 {
            font-size: 1.3rem;
            font-weight: 400;
            color: #fff;
            flex: 1;
            margin-right: 20px;
        }

        .faq-icon {
            color: #d4af37;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .faq-item.active .faq-icon {
            transform: rotate(45deg);
        }

        .faq-answer {
            padding: 0 30px;
            max-height: 0;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .faq-item.active .faq-answer {
            padding: 0 30px 30px;
            max-height: 1000px;
        }

        .faq-answer p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.05rem;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .faq-answer ul {
            list-style: none;
            margin: 15px 0;
            padding-left: 20px;
        }

        .faq-answer ul li {
            margin-bottom: 8px;
            color: rgba(255, 255, 255, 0.8);
            position: relative;
            padding-left: 25px;
        }

        .faq-answer ul li::before {
            content: '•';
            color: #d4af37;
            font-size: 1.5rem;
            position: absolute;
            left: 0;
            top: -2px;
        }

        /* CONTACT CTA */
        .contact-cta {
            background: rgba(212, 175, 55, 0.1);
            border-radius: 20px;
            padding: 50px;
            text-align: center;
            margin-top: 60px;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .contact-cta h2 {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
        }

        .contact-cta p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 30px;
        }

        .contact-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .contact-btn {
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

        .contact-btn.primary {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
        }

        .contact-btn.secondary {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .contact-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.2);
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
            .menu-left {
                grid-template-columns: repeat(3, 1fr);
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

            .faq-question h3 {
                font-size: 1.1rem;
            }

            .contact-cta {
                padding: 30px;
            }

            .contact-buttons {
                flex-direction: column;
                align-items: center;
            }

            .contact-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .menu-left {
                grid-template-columns: 1fr;
            }

            .mega-panel {
                padding: 100px 30px 40px;
            }

            .faq-categories {
                flex-direction: column;
                align-items: stretch;
            }

            .category-btn {
                text-align: center;
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
            <a href="{{ route('shop.faq.faq-index') }}" class="nav-link" style="color: #d4af37;">FAQS</a>
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
                        <li><a href="{{ route('shop.faq.faq-index') }}">FAQs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Frequently Asked Questions</div>
            <div class="hero-sub">Find answers to common questions about our products, ordering process, delivery, and more. Can't find what you're looking for? Contact our support team.</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="floating-card">
            <div class="faq-header">
                <h1>How Can We Help?</h1>
                <p>Browse through our frequently asked questions or use the categories below to find specific information.</p>
            </div>

            <!-- FAQ Categories -->
            <div class="faq-categories">
                <button class="category-btn active" data-category="all">All Questions</button>
                <button class="category-btn" data-category="ordering">Ordering & Payment</button>
                <button class="category-btn" data-category="delivery">Delivery & Shipping</button>
                <button class="category-btn" data-category="products">Products & Quality</button>
                <button class="category-btn" data-category="corporate">Corporate Orders</button>
                <button class="category-btn" data-category="returns">Returns & Refunds</button>
            </div>

            <!-- FAQ Accordion -->
            <div class="faq-accordion">
                <!-- Ordering & Payment -->
                <div class="faq-item" data-category="ordering">
                    <div class="faq-question">
                        <h3>What payment methods do you accept?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>We accept various payment methods for your convenience:</p>
                        <ul>
                            <li>Credit/Debit Cards (Visa, MasterCard, American Express)</li>
                            <li>Net Banking</li>
                            <li>UPI Payments</li>
                            <li>Digital Wallets (Paytm, PhonePe, Google Pay)</li>
                            <li>Cash on Delivery (available for select locations)</li>
                        </ul>
                        <p>All payments are processed through secure, encrypted gateways to ensure your information is protected.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="ordering">
                    <div class="faq-question">
                        <h3>How can I track my order?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>Once your order is shipped, you'll receive a confirmation email with a tracking number and link. You can also track your order by:</p>
                        <ul>
                            <li>Logging into your account on our website</li>
                            <li>Using the order tracking page with your order number</li>
                            <li>Contacting our customer support at support@hazlenutfactory.com</li>
                        </ul>
                        <p>Real-time updates are provided at every stage of the delivery process.</p>
                    </div>
                </div>

                <!-- Delivery & Shipping -->
                <div class="faq-item" data-category="delivery">
                    <div class="faq-question">
                        <h3>What are your delivery timelines?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>Delivery times vary based on location and product availability:</p>
                        <ul>
                            <li><strong>Metro Cities:</strong> 2-3 business days</li>
                            <li><strong>Tier 1 Cities:</strong> 3-4 business days</li>
                            <li><strong>Tier 2 & 3 Cities:</strong> 4-7 business days</li>
                            <li><strong>Rural Areas:</strong> 7-10 business days</li>
                        </ul>
                        <p>Express delivery options are available for urgent orders. During festive seasons, delivery times may be extended by 1-2 days.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="delivery">
                    <div class="faq-question">
                        <h3>Do you deliver internationally?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>Yes, we offer international shipping to select countries. International delivery typically takes 7-15 business days, depending on the destination.</p>
                        <p>Please note that international orders may be subject to customs duties and taxes, which are the responsibility of the recipient. For specific country availability and shipping rates, please contact our customer support team.</p>
                    </div>
                </div>

                <!-- Products & Quality -->
                <div class="faq-item" data-category="products">
                    <div class="faq-question">
                        <h3>Are your products suitable for people with dietary restrictions?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>We offer a range of products catering to various dietary needs:</p>
                        <ul>
                            <li><strong>Vegetarian:</strong> All our sweets are 100% vegetarian</li>
                            <li><strong>Nut-Free Options:</strong> Available upon request</li>
                            <li><strong>Sugar-Free:</strong> Select sugar-free options available</li>
                            <li><strong>Gluten Information:</strong> Clearly labeled on product pages</li>
                        </ul>
                        <p>For specific dietary concerns, please check individual product descriptions or contact our customer service team for detailed ingredient information.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="products">
                    <div class="faq-question">
                        <h3>How should I store your sweets for maximum freshness?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>To ensure optimal freshness and flavor:</p>
                        <ul>
                            <li>Store in a cool, dry place away from direct sunlight</li>
                            <li>Most sweets can be refrigerated for up to 2 weeks</li>
                            <li>Freezing is recommended for longer storage (up to 3 months)</li>
                            <li>Keep in airtight containers to prevent moisture absorption</li>
                            <li>Consume within the "best before" date mentioned on packaging</li>
                        </ul>
                        <p>Specific storage instructions are provided with each product.</p>
                    </div>
                </div>

                <!-- Corporate Orders -->
                <div class="faq-item" data-category="corporate">
                    <div class="faq-question">
                        <h3>What corporate gifting options do you offer?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>We provide comprehensive corporate gifting solutions:</p>
                        <ul>
                            <li>Custom branded packaging with your company logo</li>
                            <li>Bulk ordering with volume discounts</li>
                            <li>Personalized gift hampers</li>
                            <li>Seasonal and festive collections</li>
                            <li>Flexible delivery scheduling</li>
                            <li>Digital gift cards for employee rewards</li>
                        </ul>
                        <p>Our corporate team can create bespoke solutions tailored to your requirements. Contact corporate@hazlenutfactory.com for personalized service.</p>
                    </div>
                </div>

                <!-- Returns & Refunds -->
                <div class="faq-item" data-category="returns">
                    <div class="faq-question">
                        <h3>What is your return and refund policy?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>We stand by the quality of our products:</p>
                        <ul>
                            <li><strong>Damaged Products:</strong> Full refund or replacement within 48 hours of delivery</li>
                            <li><strong>Quality Issues:</strong> Immediate resolution with refund or replacement</li>
                            <li><strong>Cancellation:</strong> Free cancellation before order processing</li>
                            <li><strong>Refund Processing:</strong> 5-7 business days to original payment method</li>
                        </ul>
                        <p>Due to the perishable nature of our products, we cannot accept returns for change of mind. For any issues, please contact us within 24 hours of delivery with photos of the product and packaging.</p>
                    </div>
                </div>

                <div class="faq-item" data-category="ordering">
                    <div class="faq-question">
                        <h3>Can I modify or cancel my order after placing it?</h3>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer">
                        <p>Order modifications and cancellations are possible under certain conditions:</p>
                        <ul>
                            <li>Orders can be modified or cancelled within 1 hour of placement</li>
                            <li>Once the order enters processing, changes may not be possible</li>
                            <li>For urgent modifications, contact our support team immediately</li>
                            <li>Pre-orders for festive seasons may have different cancellation policies</li>
                        </ul>
                        <p>To request changes, please call our customer support at +91-XXXXXXXXXX or email support@hazlenutfactory.com with your order number.</p>
                    </div>
                </div>
            </div>

            <!-- Contact CTA -->
            <div class="contact-cta">
                <h2>Still Have Questions?</h2>
                <p>Our customer support team is here to help you with any additional questions or concerns you may have.</p>
                <div class="contact-buttons">
                    <a href="tel:+911234567890" class="contact-btn primary">
                        <i class="fas fa-phone"></i> Call Us Now
                    </a>
                    <a href="mailto:support@hazlenutfactory.com" class="contact-btn secondary">
                        <i class="fas fa-envelope"></i> Email Support
                    </a>
                    <a href="{{ route('shop.store-locator.index') }}" class="contact-btn secondary">
                        <i class="fas fa-store"></i> Visit Our Stores
                    </a>
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

        // FAQ Accordion Functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const item = question.parentElement;
                item.classList.toggle('active');
                
                // Update icon
                const icon = question.querySelector('.faq-icon i');
                if (item.classList.contains('active')) {
                    icon.classList.remove('fa-plus');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-plus');
                }
            });
        });

        // FAQ Category Filtering
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // Filter FAQ items
                const category = button.getAttribute('data-category');
                const allItems = document.querySelectorAll('.faq-item');
                
                allItems.forEach(item => {
                    if (category === 'all' || item.getAttribute('data-category') === category) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Open first FAQ item by default
        document.querySelector('.faq-item').classList.add('active');
        document.querySelector('.faq-item .faq-icon i').classList.replace('fa-plus', 'fa-times');
    </script>
</body>
</html>