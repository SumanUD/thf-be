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
        /* Wedding-specific styles that maintain the same design language */
        .wedding-hero {
            background: linear-gradient(117deg, #f3ebe2 0%, #faf3ec 100%);
            border-bottom: 1px solid #eedbcb;
        }

        .wedding-hero .hero-title {
            color: #b45f3a;
            font-size: 4rem;
        }

        .wedding-hero .hero-sub {
            color: #7b5a44;
        }

        /* Counter section - using floating-card style */
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
            background: #ffffff;
            border-radius: 20px;
            padding: 2.5rem 1.5rem;
            text-align: center;
            border: 1px solid #f2dfd0;
            box-shadow: 0 15px 30px -12px rgba(85, 55, 30, 0.08);
            transition: transform 0.2s ease;
        }

        .counter-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -12px #a57b5d40;
        }

        .counter-icon {
            font-size: 3rem;
            color: #b28056;
            margin-bottom: 1rem;
        }

        .counter-number {
            font-family: 'Forum', serif;
            font-size: 3.5rem;
            color: #4f3b2c;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .counter-label {
            font-size: 1.1rem;
            color: #7b5a44;
            letter-spacing: 0.5px;
        }

        /* Hamper Section - NEW DESIGN: Image left, Talk to team right */
        .hamper-section {
            margin: 4rem 0;
        }

        .hamper-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
            background: #fcf6f0;
            border-radius: 30px;
            border: 1px solid #f2dfd0;
            padding: 2.5rem;
            box-shadow: 0 15px 30px -12px rgba(85, 55, 30, 0.08);
            margin-top: 2rem;
        }

        .hamper-image-col {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 35px -12px #a57b5d60;
        }

        .hamper-image {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.5s ease;
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
            color: #b45f3a;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .hamper-content-subtitle {
            font-size: 1.2rem;
            color: #7b5a44;
            margin-bottom: 1.8rem;
            font-weight: 400;
            border-bottom: 2px solid #e5cdb6;
            padding-bottom: 1.2rem;
        }

        .hamper-description {
            margin-bottom: 2.5rem;
        }

        .hamper-description p {
            color: #5f4e41;
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
            color: #5f4e41;
            font-size: 1rem;
        }

        .hamper-features li i {
            color: #b28056;
            font-size: 1.2rem;
            width: 24px;
        }

        .team-btn {
            display: inline-flex;
            align-items: center;
            gap: 1rem;
            background: #b28056;
            color: #ffffff;
            padding: 1.2rem 2.5rem;
            border-radius: 50px;
            font-size: 1.2rem;
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 20px -8px #a57b5d;
        }

        .team-btn:hover {
            background: #9f6e46;
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
            background: #ffffff;
            border-radius: 20px;
            padding: 2rem 1.5rem;
            text-align: center;
            border: 1px solid #f2dfd0;
            box-shadow: 0 15px 30px -12px rgba(85, 55, 30, 0.08);
            transition: transform 0.2s ease;
        }

        .why-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px -12px #a57b5d40;
        }

        .why-icon {
            font-size: 2.8rem;
            color: #b28056;
            margin-bottom: 1rem;
        }

        .why-item h3 {
            font-family: 'Forum', serif;
            font-size: 1.5rem;
            color: #4f3b2c;
            margin-bottom: 0.8rem;
        }

        .why-item p {
            color: #7b5a44;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Decorative elements */
        .divider-flowers {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin: 3rem 0;
            color: #dbb594;
            font-size: 1.2rem;
        }

        .closing-note {
            text-align: center;
            margin: 4rem 0 2rem;
            padding: 2rem;
            background: #fcf6f0;
            border-radius: 20px;
            border: 1px solid #f2dfd0;
        }

        .closing-note p:first-child {
            font-family: 'Forum', serif;
            font-size: 2rem;
            color: #b45f3a;
            margin-bottom: 0.5rem;
        }

        .closing-note p:last-child {
            color: #7b5a44;
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
            .counter-grid,
            .why-grid {
                grid-template-columns: 1fr;
            }
            
            .wedding-hero .hero-title {
                font-size: 3rem;
            }
            
            .hamper-layout {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <!-- HERO BANNER - Wedding Version -->
    <div class="hero-banner wedding-hero">
        <div class="hero-content">
            <div class="hero-title">Wedding Collection</div>
            <div class="hero-sub">Crafting unforgettable sweet memories for your special day with artisanal indulgence</div>
        </div>
    </div>

    <div class="container">
        <!-- Floating Card (same as store locator) -->
        <div class="floating-card">
            <div class="header-row">
                <span class="main-title">Wedding & Celebrations</span>
                <span class="cafes-count" style="margin: 0;">
                    <i class="fas fa-heart"></i>
                    Artisanal Wedding Specialists
                </span>
            </div>

            <!-- COUNTER SECTION (inside floating card) -->
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

            <!-- HAMPER SECTION - NEW IMAGE + TALK TO TEAM LAYOUT -->
            <div class="hamper-section">
                <div class="cafes-title">Build Your Perfect Wedding Hamper</div>
                <p style="color: #7b5a44; margin-bottom: 1rem;">Let our experts create something magical for your special day</p>

                <div class="hamper-layout">
                    <!-- Left Column: Image -->
                    <div class="hamper-image-col">
                        <img src="https://wrapshap.com/cdn/shop/files/Opulant_Hamper.jpg?v=1739100893&width=3840" 
                             alt="Luxury Wedding Hamper" 
                             class="hamper-image"
                             onerror="this.src='https://placehold.co/800x600/fcf6f0/b28056?text=Wedding+Hamper+Collection'">
                    </div>
                    
                    <!-- Right Column: Talk to Team Content -->
                    <div class="hamper-content-col">
                        <div class="hamper-content-title">Talk to a Team</div>
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
                        <p style="margin-top: 1rem; color: #b28056; font-size: 0.9rem;">
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
                <p style="color: #7b5a44; margin-bottom: 2rem;">Creating magical moments with artisanal excellence</p>

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
                    <a href="mailto:weddings@hazelnutfactory.com" class="primary-btn" style="display: inline-flex; text-decoration: none; background: #b28056;">
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