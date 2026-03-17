<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Our Team | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&family=Work+Sans:wght@300;400;500;600&display=swap">

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
            font-family: "Work Sans", sans-serif;
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
            font-size: 4.5rem;
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
            font-size: 1.3rem;
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

        /* Narrative Section */
        .story-block {
            background: var(--card-bg);
            padding: 3.5rem 4rem;
            border-radius: 40px;
            box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.5);
            margin-bottom: 5rem;
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .story-block::before {
            content: "“";
            font-family: 'Forum', serif;
            font-size: 8rem;
            color: var(--primary-gold);
            position: absolute;
            top: -20px;
            left: 30px;
            opacity: 0.15;
            pointer-events: none;
        }

        .story-text {
            font-size: 1.18rem;
            line-height: 1.8;
            color: var(--text-light);
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        .story-text p {
            margin-bottom: 1.8rem;
        }

        .story-text p:first-child {
            font-weight: 500;
            font-size: 1.3rem;
            color: #fff;
        }

        .story-text p:last-child {
            margin-bottom: 0;
        }

        .signature-line {
            margin-top: 2rem;
            font-family: 'Forum', serif;
            font-size: 1.4rem;
            color: var(--primary-gold);
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .signature-line i {
            font-size: 2rem;
            color: var(--primary-gold);
        }

        /* Team Section Header */
        .team-header {
            display: flex;
            align-items: baseline;
            justify-content: space-between;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            gap: 20px;
        }

        .team-header h2 {
            font-family: 'Forum', serif;
            font-size: 3rem;
            font-weight: 300;
            color: #fff;
            letter-spacing: 1px;
            position: relative;
        }

        .team-header h2:after {
            content: '';
            display: block;
            width: 100px;
            height: 3px;
            background: var(--primary-gold);
            margin-top: 0.6rem;
        }

        .team-header span {
            font-size: 1.1rem;
            background: rgba(212, 175, 55, 0.1);
            padding: 0.5rem 1.8rem;
            border-radius: 40px;
            color: var(--primary-gold);
            font-weight: 500;
            letter-spacing: 0.5px;
            border: 1px solid var(--border-gold);
        }

        /* Team Cards */
        .team-row {
            display: flex;
            gap: 4rem;
            margin-bottom: 6rem;
            align-items: center;
            background: var(--card-bg);
            border-radius: 48px;
            padding: 2rem 2rem 2rem 2rem;
            box-shadow: 0 25px 45px -18px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
            transition: all 0.4s ease;
        }

        .team-row:hover {
            transform: translateY(-8px) scale(1.01);
            border-color: var(--border-gold-hover);
            box-shadow: 0 30px 50px -18px rgba(212, 175, 55, 0.15);
        }

        /* Image column */
        .team-image-col {
            flex: 0 0 340px;
        }

        .team-image-wrap {
            width: 100%;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.5);
            border: 3px solid rgba(212, 175, 55, 0.15);
            aspect-ratio: 1 / 1.1;
        }

        .team-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.5s ease;
            filter: brightness(0.9);
        }

        .team-row:hover .team-image-wrap img {
            transform: scale(1.03);
        }

        /* Content column */
        .team-content-col {
            flex: 1;
            padding-right: 1rem;
        }

        .member-name {
            font-family: 'Forum', serif;
            font-size: 3rem;
            font-weight: 300;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 0.25rem;
            letter-spacing: -0.5px;
        }

        .member-title {
            font-size: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--primary-gold);
            margin-bottom: 1.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .member-title i {
            font-size: 1.4rem;
            color: var(--primary-gold);
        }

        .member-bio {
            font-size: 1.05rem;
            line-height: 1.8;
            color: var(--text-light);
            margin-bottom: 2rem;
        }

        .member-bio p {
            margin-bottom: 1.4rem;
        }

        .member-bio p:last-child {
            margin-bottom: 0;
        }

        .highlight-quote {
            background: rgba(20, 20, 20, 0.8);
            padding: 1.6rem 2rem;
            border-radius: 30px;
            margin: 1.5rem 0 1.8rem;
            border-left: 5px solid var(--primary-gold);
            font-style: normal;
            font-weight: 400;
            color: var(--text-light);
            box-shadow: inset 0 2px 8px rgba(0, 0, 0, 0.3);
            font-size: 1.05rem;
            border: 1px solid var(--border-gold);
        }

        .highlight-quote i {
            color: var(--primary-gold);
            margin-right: 8px;
            font-size: 1.2rem;
        }

        .member-footer {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-gold);
            color: var(--text-light);
            padding: 0.8rem 2.2rem;
            border-radius: 50px;
            font-weight: 500;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: default;
            font-family: 'Work Sans', sans-serif;
        }

        .btn-outline i {
            font-size: 1.2rem;
            color: var(--primary-gold);
        }

        .btn-outline:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: var(--primary-gold);
            color: #fff;
            transform: translateY(-2px);
        }

        .pill-badge {
            background: rgba(212, 175, 55, 0.1);
            padding: 0.5rem 1.8rem;
            border-radius: 40px;
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--text-light);
            display: inline-flex;
            align-items: center;
            gap: 8px;
            letter-spacing: 0.3px;
            border: 1px solid var(--border-gold);
        }

        .pill-badge i {
            color: var(--primary-gold);
        }

        /* Closing note */
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

            .team-row {
                flex-direction: column;
                padding: 2rem;
                gap: 2rem;
            }
            
            .team-image-col {
                flex: 0 0 auto;
                width: 70%;
                max-width: 380px;
            }
            
            .story-block {
                padding: 2.5rem;
            }
            
            .team-header {
                flex-direction: column;
                align-items: flex-start;
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
            
            .story-block {
                padding: 2rem;
                border-radius: 30px;
            }
            
            .member-name {
                font-size: 2.5rem;
            }
            
            .team-image-col {
                width: 100%;
                max-width: 100%;
            }
            
            .member-footer {
                flex-direction: column;
            }
            
            .pill-badge, .btn-outline {
                width: 100%;
                justify-content: center;
            }
            
            .closing-note {
                border-radius: 40px;
                padding: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }
            
            .hero-sub {
                font-size: 1rem;
            }
            
            .story-text p:first-child {
                font-size: 1.1rem;
            }
            
            .highlight-quote {
                padding: 1.2rem;
            }
            
            .member-name {
                font-size: 2rem;
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
            <div class="hero-title">The <span>storytellers</span></div>
            <div class="hero-sub">Two brothers, one unwavering dream — to craft sweets that carry tradition into the future.</div>
        </div>
    </div>

    <div class="container">
        <!-- STORY NARRATIVE -->
        <div class="story-block">
            <div class="story-text">
                <p>Every creation at The Hazelnut Factory reflects the vision of two dreamers who believed that Indian sweets could tell a new story — one of innovation, authenticity, and joy. What began as a small idea in Lucknow has today grown into a celebrated brand of artisanal indulgence, led with heart and guided by craft.</p>
                <p>Fuelled by an unyielding passion for reimagining tradition, Ankit and Badal Sahni set out to bridge the gap between heritage and modern taste. Their journey began with a simple yet profound belief — that Indian desserts could be as global, elegant, and experiential as any fine pâtisserie in the world, without losing their soul. From crafting the perfect texture of baklava to introducing gourmet gifting experiences, they’ve turned The Hazelnut Factory into a space where craftsmanship meets creativity.</p>
                <p>Behind every box, every confection, and every café experience lies their shared commitment to quality and innovation. Together, they’ve built not just a brand but a movement — redefining indulgence for a new generation while staying true to the warmth, hospitality, and cultural richness that make Indian sweets timeless.</p>
                <div class="signature-line">
                    <i class="fas fa-feather-alt"></i> — The heart behind the hazelnut
                </div>
            </div>
        </div>

        <!-- TEAM SECTION HEADER -->
        <div class="team-header">
            <h2>Visionary founders</h2>
            <span><i class="fas fa-hand-holding-heart"></i> handcrafted legacy</span>
        </div>

        <!-- TEAM MEMBER 1: ANKIT SAHNI -->
        <div class="team-row">
            <div class="team-image-col">
                <div class="team-image-wrap">
                    <img src="https://cdn.shopify.com/s/files/1/0780/1759/3645/files/Ankit_bhaiya_500x700_4d78bfd1-5382-4b21-96d4-ef98cea7a9d9.png?v=1688639858" alt="Ankit Sahni" onerror="this.src='https://placehold.co/600x700/2a2a2a/d4af37?text=Ankit+Sahni'">
                </div>
            </div>
            <div class="team-content-col">
                <div class="member-name">ANKIT SAHNI</div>
                <div class="member-title"><i class="fas fa-seedling"></i> Founder, THF</div>

                <div class="member-bio">
                    <p>Our founder, Mr. Ankit Sahni, has always been captivated by the idea of opening a cafe that combines the best of coffee, bakery products, and sweets under one roof. It was this burning passion that led him to embark on a remarkable journey in 2018. Recognizing the scarcity of places offering a diverse range of coffee, bakery treats, and sweets, Ankit decided to fill this gap by establishing The Hazelnut Factory. With unwavering determination, he dedicated an entire year to meticulously crafting the concept before finally unveiling the first THF store in 2019.</p>
                </div>

                <div class="highlight-quote">
                    <i class="fas fa-quote-left"></i> At THF, we take pride in being a vegetarian cafe with an enticing array of egg products in our bakery section. We also understand the importance of catering to different dietary preferences, which is why we offer a plethora of gluten-free and vegan options. Our menu predominantly features delectable continental dishes, while our beverage menu is equally extensive, ensuring there's something for every discerning palate.
                </div>

                <div class="member-footer">
                    <span class="pill-badge"><i class="fab fa-linkedin"></i> Connect (Ankit)</span>
                    <span class="pill-badge"><i class="fas fa-calendar-alt"></i> since 2018</span>
                </div>
            </div>
        </div>

        <!-- TEAM MEMBER 2: BADAL SAHNI -->
        <div class="team-row">
            <div class="team-image-col">
                <div class="team-image-wrap">
                    <img src="https://cdn.shopify.com/s/files/1/0780/1759/3645/files/Badal_bhaiya_500x700_3239a2f9-bd48-40a6-bf95-aa7a72b847a5.png?v=1689335830" alt="Badal Sahni" onerror="this.src='https://placehold.co/600x700/2a2a2a/d4af37?text=Badal+Sahni'">
                </div>
            </div>
            <div class="team-content-col">
                <div class="member-name">BADAL SAHNI</div>
                <div class="member-title"><i class="fas fa-crown"></i> Director, THF</div>

                <div class="member-bio">
                    <p>Our founder, Mr. Ankit Sahni, has always been captivated by the idea of opening a cafe that combines the best of coffee, bakery products, and sweets under one roof. It was this burning passion that led him to embark on a remarkable journey in 2018. Recognizing the scarcity of places offering a diverse range of coffee, bakery treats, and sweets, Ankit decided to fill this gap by establishing The Hazelnut Factory. With unwavering determination, he dedicated an entire year to meticulously crafting the concept before finally unveiling the first THF store in 2019.</p>
                </div>

                <div class="highlight-quote">
                    <i class="fas fa-quote-left"></i> At THF, we take pride in being a vegetarian cafe with an enticing array of egg products in our bakery section. We also understand the importance of catering to different dietary preferences, which is why we offer a plethora of gluten-free and vegan options. Our menu predominantly features delectable continental dishes, while our beverage menu is equally extensive, ensuring there's something for every discerning palate.
                </div>

                <div class="member-footer">
                    <span class="pill-badge"><i class="fab fa-linkedin"></i> Connect (Badal)</span>
                    <span class="pill-badge"><i class="fas fa-gem"></i> creative director</span>
                </div>
            </div>
        </div>

        <!-- CLOSING ELEMENT -->
        <div class="closing-note">
            <i class="fas fa-wheat-alt"></i> Handcrafted with heritage · every recipe tells a story <i class="fas fa-wheat-alt"></i>
        </div>
    </div>

    <!-- FOOTER -->
    @include("shop::partials.thf-footer")

</body>
</html>