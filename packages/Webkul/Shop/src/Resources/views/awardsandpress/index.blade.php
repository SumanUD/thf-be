<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Awards & Press | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&family=Work+Sans:wght@300;400;500;600&display=swap">
    
    <!-- Swiper CSS for sliders -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

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

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin: 4rem 0 2rem;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-header h2 {
            font-family: 'Forum', serif;
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            letter-spacing: 1px;
            position: relative;
        }

        .section-header h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: var(--primary-gold);
            margin-top: 0.6rem;
        }

        .section-header span {
            font-size: 1rem;
            background: rgba(212, 175, 55, 0.1);
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            color: var(--primary-gold);
            font-weight: 500;
            border: 1px solid var(--border-gold);
        }

        /* Slider Navigation */
        .slider-nav {
            display: flex;
            gap: 0.8rem;
        }

        .slider-nav button {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: var(--card-bg);
            border: 1px solid var(--border-gold);
            color: var(--primary-gold);
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .slider-nav button:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: var(--primary-gold);
            color: #fff;
            transform: translateY(-2px);
        }

        .slider-nav button.swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }

        /* Swiper Containers */
        .swiper {
            padding: 1rem 0.5rem 2rem;
            margin: 0 -0.5rem;
        }

        .swiper-slide {
            height: auto;
        }

        /* Award Card */
        .award-card {
            background: var(--card-bg);
            border-radius: 32px;
            padding: 2rem 1.8rem;
            height: 100%;
            border: 1px solid var(--border-gold);
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(10px);
        }

        .award-card:hover {
            transform: translateY(-8px);
            border-color: var(--border-gold-hover);
            box-shadow: 0 25px 40px -15px rgba(212, 175, 55, 0.15);
        }

        .award-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
            filter: brightness(0.9) contrast(1.1);
            background: rgba(20, 20, 20, 0.4);
            border-radius: 16px;
        }

        .award-heading {
            font-family: 'Forum', serif;
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 0.8rem;
            line-height: 1.2;
            font-weight: 300;
        }

        .award-description {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        /* Press Card */
        .press-card {
            background: var(--card-bg);
            border-radius: 32px;
            padding: 2rem 1.8rem;
            height: 100%;
            border: 1px solid var(--border-gold);
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            backdrop-filter: blur(10px);
        }

        .press-card:hover {
            background: rgba(40, 40, 40, 0.9);
            transform: translateY(-8px);
            border-color: var(--primary-gold);
            box-shadow: 0 25px 40px -12px rgba(212, 175, 55, 0.2);
        }

        .press-icon {
            font-size: 2.5rem;
            color: var(--primary-gold);
            margin-bottom: 1.2rem;
        }

        .press-heading {
            font-family: 'Forum', serif;
            font-size: 1.6rem;
            color: #fff;
            margin-bottom: 1rem;
            line-height: 1.3;
            font-weight: 300;
        }

        .press-description {
            color: var(--text-light);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .press-source {
            font-size: 0.9rem;
            color: var(--primary-gold);
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .press-source i {
            font-size: 1rem;
            color: var(--primary-gold);
        }

        /* Closing Note */
        .closing-note {
            text-align: center;
            margin-top: 4rem;
            font-size: 1.3rem;
            font-family: 'Forum', serif;
            color: #fff;
            background: var(--card-bg);
            padding: 2rem;
            border-radius: 100px 100px 40px 40px;
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        .closing-note i {
            margin: 0 8px;
            color: var(--primary-gold);
        }

        /* Responsive */
        @media (max-width: 1000px) {
            .hero-title {
                font-size: 3.5rem;
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

            .section-header {
                flex-direction: column;
                gap: 1rem;
            }

            .section-header h2 {
                font-size: 2.2rem;
            }

            .slider-nav {
                align-self: flex-end;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-sub {
                font-size: 1rem;
            }

            .award-heading {
                font-size: 1.5rem;
            }

            .press-heading {
                font-size: 1.4rem;
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

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Recognition <span>& Features</span></div>
            <div class="hero-sub">Celebrating the journey of excellence through awards and media coverage</div>
        </div>
    </div>

    <div class="container">
        <!-- AWARDS SECTION -->
        <div class="section-header">
            <h2>Our Awards</h2>
            <span><i class="fas fa-trophy"></i> industry honours</span>
        </div>

        <!-- Awards Slider -->
        <div class="swiper awards-swiper">
            <div class="swiper-wrapper">
                <!-- Award 1 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/2a2a2a/d4af37?text=Best+Artisanal+Sweet+Brand" class="award-image" alt="Award">
                        <div class="award-heading">Best Artisanal Sweet Brand</div>
                        <div class="award-description">Recognized for excellence in reimagining traditional Indian sweets with a modern, gourmet approach at the Food Excellence Awards 2024.</div>
                    </div>
                </div>
                <!-- Award 2 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/2a2a2a/d4af37?text=Innovation+in+Gifting" class="award-image" alt="Award">
                        <div class="award-heading">Innovation in Gifting</div>
                        <div class="award-description">Awarded for revolutionary gourmet hampers that blend tradition with contemporary luxury at the Indian Retail Awards.</div>
                    </div>
                </div>
                <!-- Award 3 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/2a2a2a/d4af37?text=Emerging+Café+Chain" class="award-image" alt="Award">
                        <div class="award-heading">Emerging Café Chain</div>
                        <div class="award-description">Honored as one of the most promising café concepts for creating a unique vegetarian-gourmet experience.</div>
                    </div>
                </div>
                <!-- Award 4 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/2a2a2a/d4af37?text=Packaging+Design" class="award-image" alt="Award">
                        <div class="award-heading">Excellence in Packaging</div>
                        <div class="award-description">Celebrated for elegant, sustainable packaging that enhances the gifting experience at the Design & Retail Summit.</div>
                    </div>
                </div>
                <!-- Award 5 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/2a2a2a/d4af37?text=People's+Choice" class="award-image" alt="Award">
                        <div class="award-heading">People's Choice Award</div>
                        <div class="award-description">Voted by customers as the favorite destination for premium sweets and café experience in North India.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Custom Awards Navigation -->
        <div class="slider-nav awards-nav" style="justify-content: flex-end; margin-top: 1rem;">
            <button class="awards-prev"><i class="fas fa-arrow-left"></i></button>
            <button class="awards-next"><i class="fas fa-arrow-right"></i></button>
        </div>

        <!-- PRESS SECTION -->
        <div class="section-header" style="margin-top: 5rem;">
            <h2>Press Features</h2>
            <span><i class="fas fa-newspaper"></i> in the media</span>
        </div>

        <!-- Press Slider -->
        <div class="swiper press-swiper">
            <div class="swiper-wrapper">
                <!-- Press Card 1 - Restaurant India -->
                <div class="swiper-slide">
                    <a href="https://www.restaurantindia.in/news/restaurant-india-news-the-hazelnut-factory-enters-bareilly-uttar-pradesh.n14737" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-store-alt"></i></div>
                        <div class="press-heading">The Hazelnut Factory enters Bareilly</div>
                        <div class="press-description">Expanding footprint in Uttar Pradesh with a new outlet, bringing artisanal sweets and café culture to the city.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Restaurant India</div>
                    </a>
                </div>
                <!-- Press Card 2 - Entrepreneur India -->
                <div class="swiper-slide">
                    <a href="https://www.entrepreneurindia.com/blog/hi/news/the-hazelnut-factory-opens-in-bareilly.18460" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="press-heading">THF opens in Bareilly</div>
                        <div class="press-description">Entrepreneur India covers the brand's strategic expansion and its growing presence in Uttar Pradesh.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Entrepreneur India</div>
                    </a>
                </div>
                <!-- Press Card 3 - Elle Gourmet -->
                <div class="swiper-slide">
                    <a href="https://ellegourmet.in/food/a-holly-jolly-christmas-gifting-guide-45-thoughtful-picks-to-wrap-up-the-season-10920717" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-gift"></i></div>
                        <div class="press-heading">Holly Jolly Christmas Gifting Guide</div>
                        <div class="press-description">THF featured among top festive picks for gourmet hampers and sweet boxes in Elle Gourmet's curated guide.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Elle Gourmet</div>
                    </a>
                </div>
                <!-- Press Card 4 - Economic Times Hospitality -->
                <div class="swiper-slide">
                    <a href="https://hospitality.economictimes.indiatimes.com/amp/news/restaurants/the-hazelnut-factory-expanded-to-bareilly-uttar-pradesh/126102399" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-building"></i></div>
                        <div class="press-heading">THF expands to Bareilly</div>
                        <div class="press-description">Economic Times Hospitality covers the brand's growth story and its impact on the regional F&B landscape.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Economic Times</div>
                    </a>
                </div>
                <!-- Press Card 5 - Travel + Leisure Asia -->
                <div class="swiper-slide">
                    <a href="https://www.travelandleisureasia.com/in/dining/food/best-new-cafes-in-delhi-ncr-in-2025/amp/" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-utensils"></i></div>
                        <div class="press-heading">Best New Cafés in Delhi NCR 2025</div>
                        <div class="press-description">Featured among the most exciting new café openings, celebrating the brand's unique concept.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Travel+Leisure Asia</div>
                    </a>
                </div>
                <!-- Press Card 6 - SpiceJet Magazine (PDF) -->
                <div class="swiper-slide">
                    <a href="https://sg-images.spicejet.com/Magazine/SpiceRoute-DEC25-HR.pdf" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-plane"></i></div>
                        <div class="press-heading">SpiceRoute Magazine Feature</div>
                        <div class="press-description">In-flight feature highlighting THF's journey of reimagining Indian sweets for the modern traveler.</div>
                        <div class="press-source"><i class="fas fa-file-pdf"></i> SpiceJet Magazine</div>
                    </a>
                </div>
                <!-- Press Card 7 - Business World -->
                <div class="swiper-slide">
                    <a href="https://www.businessworld.in/article/how-cake-mixing-turned-into-india-s-new-festive-revenue-powerhouse-581663" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-cake-candles"></i></div>
                        <div class="press-heading">Cake Mixing: Festive Revenue Powerhouse</div>
                        <div class="press-description">Business World analyzes the trend, featuring THF's innovative approach to festive sweet offerings.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Business World</div>
                    </a>
                </div>
                <!-- Press Card 8 - Vogue India -->
                <div class="swiper-slide">
                    <a href="https://www.vogue.in/gallery/diwali-food-hampers-that-your-party-host-will-love-to-receive" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-crown"></i></div>
                        <div class="press-heading">Diwali Food Hampers</div>
                        <div class="press-description">Vogue India features THF's luxurious Diwali hampers as must-have gifts for the festive season.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Vogue India</div>
                    </a>
                </div>
                <!-- Press Card 9 - Business World (GST Article) -->
                <div class="swiper-slide">
                    <a href="https://www.businessworld.in/article/will-5-gst-slab-make-dining-out-cheaper-or-just-simpler-569896" target="_blank" class="press-card">
                        <div class="press-icon"><i class="fas fa-percent"></i></div>
                        <div class="press-heading">GST Impact on Dining</div>
                        <div class="press-description">Business World discusses tax reforms with insights from industry leaders including THF's perspective.</div>
                        <div class="press-source"><i class="fas fa-globe"></i> Business World</div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Custom Press Navigation -->
        <div class="slider-nav press-nav" style="justify-content: flex-end; margin-top: 1rem;">
            <button class="press-prev"><i class="fas fa-arrow-left"></i></button>
            <button class="press-next"><i class="fas fa-arrow-right"></i></button>
        </div>

        <!-- CLOSING NOTE -->
        <div class="closing-note">
            <i class="fas fa-star"></i> Every milestone inspires us to reach higher <i class="fas fa-star"></i>
        </div>
    </div>

    <!-- FOOTER -->
    @include("shop::partials.thf-footer")

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Initialize Awards Swiper
        const awardsSwiper = new Swiper('.awards-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            },
            navigation: {
                prevEl: '.awards-prev',
                nextEl: '.awards-next',
            },
        });

        // Initialize Press Swiper
        const pressSwiper = new Swiper('.press-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 }
            },
            navigation: {
                prevEl: '.press-prev',
                nextEl: '.press-next',
            },
        });

        // Handle PDF links
        document.querySelectorAll('.press-card[href$=".pdf"]').forEach(link => {
            if (!link.hasAttribute('target')) {
                link.setAttribute('target', '_blank');
            }
        });
    </script>
</body>
</html>