<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Specialty Coffee & Espresso Bar | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    
    <style>
        @font-face {
            font-family: "Forum";
            src: url("{{ asset('thf-assets/fonts/forum/Forum-Regular.ttf') }}") format("truetype");
            font-weight: 400;
            font-style: normal;
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
            overflow-x: hidden;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1410 100%);
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("thf-assets/images/coffee-pattern.jpg") }}') center/cover;
            opacity: 0.08;
            z-index: 0;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 0 20px;
            max-width: 900px;
        }

        .hero h1 {
            font-size: 5rem;
            font-weight: 300;
            color: #d4af37;
            margin-bottom: 20px;
            letter-spacing: -1px;
            line-height: 1.1;
        }

        .hero .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 40px;
            letter-spacing: 2px;
        }

        /* Content Section */
        .content-section {
            padding: 120px 8%;
            background: linear-gradient(180deg, #0a0a0a 0%, #111111 100%);
        }

        .section-title {
            text-align: center;
            font-size: 3rem;
            color: #fff;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 80px;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Coffee Grid */
        .coffee-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 50px;
            margin-bottom: 80px;
        }

        .coffee-card {
            background: rgba(20, 20, 20, 0.8);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.4s ease;
        }

        .coffee-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
        }

        .coffee-card-image {
            height: 280px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .coffee-card-content {
            padding: 35px;
        }

        .coffee-card h3 {
            font-size: 1.8rem;
            color: #d4af37;
            margin-bottom: 15px;
        }

        .coffee-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Feature List */
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 40px;
            margin-top: 80px;
        }

        .feature-item {
            text-align: center;
            padding: 40px 30px;
            background: rgba(212, 175, 55, 0.05);
            border-radius: 15px;
            border: 1px solid rgba(212, 175, 55, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: #d4af37;
            margin-bottom: 20px;
        }

        .feature-item h4 {
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 10px;
        }

        .feature-item p {
            color: rgba(255, 255, 255, 0.6);
            line-height: 1.6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 3rem;
            }

            .hero .subtitle {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .coffee-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Specialty Coffee & Espresso Bar</h1>
            <p class="subtitle">Artisanal Brews Crafted with Passion</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section">
        <h2 class="section-title">Discover Our Coffee Experience</h2>
        <p class="section-subtitle">Each cup is a journey through the finest coffee regions, expertly roasted and precisely brewed to perfection</p>

        <div class="coffee-grid">
            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Single Origin Espresso</h3>
                    <p>Carefully selected beans from Ethiopia, Colombia, and Brazil. Our master baristas extract the perfect shot, highlighting unique flavor profiles and aromatic notes from each origin.</p>
                </div>
            </div>

            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1511920170033-f8396924c348?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Pour Over Perfection</h3>
                    <p>Experience the art of manual brewing. Our pour-over method brings out subtle flavors and complexity, offering a clean and bright cup that showcases the bean's true character.</p>
                </div>
            </div>

            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Signature Blends</h3>
                    <p>Our exclusive THF coffee blends combine premium beans to create harmonious flavors. From bold and robust to smooth and mellow, discover your perfect blend.</p>
                </div>
            </div>

            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Cold Brew Collections</h3>
                    <p>Smooth, refreshing, and never bitter. Our cold brew is steeped for 16 hours, resulting in a naturally sweet and full-bodied coffee that's perfect any time of day.</p>
                </div>
            </div>

            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1461023058943-07fcbe16d735?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Artisan Latte Art</h3>
                    <p>Every latte is a canvas. Our skilled baristas craft intricate designs atop perfectly textured microfoam, combining visual artistry with exceptional taste.</p>
                </div>
            </div>

            <div class="coffee-card">
                <div class="coffee-card-image" style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1517487881594-2787fef5ebf7?w=800')"></div>
                <div class="coffee-card-content">
                    <h3>Seasonal Specials</h3>
                    <p>Limited edition creations that celebrate the finest seasonal harvests. Discover rare micro-lots and experimental processing methods throughout the year.</p>
                </div>
            </div>
        </div>

        <!-- Features -->
        <div class="features">
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-seedling"></i></div>
                <h4>Ethically Sourced</h4>
                <p>Direct relationships with farmers ensuring fair trade and sustainable practices</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-fire"></i></div>
                <h4>Fresh Roasted</h4>
                <p>Small-batch roasting weekly to guarantee peak freshness and flavor</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-award"></i></div>
                <h4>Award Winning</h4>
                <p>Recognized by international coffee competitions for excellence</p>
            </div>

            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-graduation-cap"></i></div>
                <h4>Expert Baristas</h4>
                <p>Certified professionals trained in advanced brewing techniques</p>
            </div>
        </div>
    </section>
</body>
</html>
