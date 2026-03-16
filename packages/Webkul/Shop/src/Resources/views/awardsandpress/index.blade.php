<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Awards & Press | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css.all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&family=Work+Sans:wght@300;400;500;600&display=swap">
    
    <!-- Swiper CSS for sliders -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Work Sans', sans-serif;
            background-color: #fefcf8;
            color: #2c241e;
            line-height: 1.5;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 2rem 4rem;
        }

        /* Hero Banner */
        .hero-banner {
            background: linear-gradient(117deg, #f3ebe2 0%, #faf3ec 100%);
            padding: 5rem 2rem;
            text-align: center;
            border-bottom: 1px solid #eedbcb;
        }

        .hero-content {
            max-width: 900px;
            margin: 0 auto;
        }

        .hero-title {
            font-family: 'Forum', serif;
            font-size: 4rem;
            font-weight: 400;
            letter-spacing: 2px;
            color: #4f3b2c;
            margin-bottom: 1.2rem;
            line-height: 1.1;
        }

        .hero-sub {
            font-size: 1.25rem;
            font-weight: 300;
            color: #5f4e41;
            max-width: 650px;
            margin: 0 auto;
            border-top: 2px solid #dbb594;
            padding-top: 1.5rem;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin: 4rem 0 2rem;
        }

        .section-header h2 {
            font-family: 'Forum', serif;
            font-size: 2.8rem;
            font-weight: 400;
            color: #3f2e21;
            letter-spacing: 1px;
            position: relative;
        }

        .section-header h2:after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: #dbb594;
            margin-top: 0.6rem;
        }

        .section-header span {
            font-size: 1rem;
            background: #f0e4d9;
            padding: 0.5rem 1.5rem;
            border-radius: 40px;
            color: #5f3f2c;
            font-weight: 500;
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
            background: #ffffff;
            border: 1px solid #e5cdb6;
            color: #a0785c;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .slider-nav button:hover {
            background: #dbb594;
            color: #ffffff;
            border-color: #dbb594;
        }

        .slider-nav button.swiper-button-disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
            background: #ffffff;
            border-radius: 32px;
            padding: 2rem 1.8rem;
            height: 100%;
            border: 1px solid #f2dfd0;
            box-shadow: 0 15px 30px -12px rgba(65, 43, 30, 0.08);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .award-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 40px -15px #a57b5d40;
        }

        .award-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            padding: 0.5rem;
        }

        .award-heading {
            font-family: 'Forum', serif;
            font-size: 1.8rem;
            color: #2b1e14;
            margin-bottom: 0.8rem;
            line-height: 1.2;
        }

        .award-description {
            color: #5a4a3d;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        /* Press Card */
        .press-card {
            background: #fcf6f0;
            border-radius: 32px;
            padding: 2rem 1.8rem;
            height: 100%;
            border: 1px solid #f2dfd0;
            box-shadow: 0 15px 30px -12px rgba(65, 43, 30, 0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .press-card:hover {
            background: #ffffff;
            transform: translateY(-6px);
            box-shadow: 0 25px 40px -12px #a0785c;
            border-color: #dbb594;
        }

        .press-icon {
            font-size: 2.5rem;
            color: #b28056;
            margin-bottom: 1.2rem;
        }

        .press-heading {
            font-family: 'Forum', serif;
            font-size: 1.6rem;
            color: #2b1e14;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .press-description {
            color: #5a4a3d;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .press-source {
            font-size: 0.9rem;
            color: #b28056;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .press-source i {
            font-size: 1rem;
        }

        /* Closing Note */
        .closing-note {
            text-align: center;
            margin-top: 4rem;
            font-size: 1.3rem;
            font-family: 'Forum', serif;
            color: #6f523b;
            background: #f5ece3;
            padding: 2rem;
            border-radius: 100px 100px 40px 40px;
            border: 1px solid #e1cbb8;
        }

        .closing-note i {
            margin: 0 8px;
            color: #b2652a;
        }

        @media (max-width: 768px) {
            .hero-title { font-size: 3rem; }
            .section-header { flex-direction: column; gap: 1rem; }
            .slider-nav { align-self: flex-end; }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Recognition & Features</div>
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
                        <img src="https://placehold.co/600x400/efdccf/7b5f4a?text=Best+Artisanal+Sweet+Brand" class="award-image" alt="Award">
                        <div class="award-heading">Best Artisanal Sweet Brand</div>
                        <div class="award-description">Recognized for excellence in reimagining traditional Indian sweets with a modern, gourmet approach at the Food Excellence Awards 2024.</div>
                    </div>
                </div>
                <!-- Award 2 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/efdccf/7b5f4a?text=Innovation+in+Gifting" class="award-image" alt="Award">
                        <div class="award-heading">Innovation in Gifting</div>
                        <div class="award-description">Awarded for revolutionary gourmet hampers that blend tradition with contemporary luxury at the Indian Retail Awards.</div>
                    </div>
                </div>
                <!-- Award 3 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/efdccf/7b5f4a?text=Emerging+Café+Chain" class="award-image" alt="Award">
                        <div class="award-heading">Emerging Café Chain</div>
                        <div class="award-description">Honored as one of the most promising café concepts for creating a unique vegetarian-gourmet experience.</div>
                    </div>
                </div>
                <!-- Award 4 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/efdccf/7b5f4a?text=Packaging+Design" class="award-image" alt="Award">
                        <div class="award-heading">Excellence in Packaging</div>
                        <div class="award-description">Celebrated for elegant, sustainable packaging that enhances the gifting experience at the Design & Retail Summit.</div>
                    </div>
                </div>
                <!-- Award 5 -->
                <div class="swiper-slide">
                    <div class="award-card">
                        <img src="https://placehold.co/600x400/efdccf/7b5f4a?text=People's+Choice" class="award-image" alt="Award">
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

        // Handle PDF link (the SpiceJet one) - ensure it opens correctly
        document.querySelectorAll('.press-card[href$=".pdf"]').forEach(link => {
            link.addEventListener('click', (e) => {
                // Let it open normally, but we can add target="_blank" behavior
                if (!link.hasAttribute('target')) {
                    link.setAttribute('target', '_blank');
                }
            });
        });
    </script>
</body>
</html>