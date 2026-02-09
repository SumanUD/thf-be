<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Brand Story | The HazleNut Factory</title>

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
            background: url('{{ asset("thf-assets/images/19201080Baklava.jpg") }}') center/cover;
            opacity: 0.15;
            z-index: 0;
            filter: blur(2px);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 0 20px;
            max-width: 1000px;
        }

        .hero h1 {
            font-size: 5.5rem;
            font-weight: 300;
            color: #d4af37;
            margin-bottom: 30px;
            letter-spacing: -1px;
            line-height: 1;
        }

        .hero .tagline {
            font-size: 1.8rem;
            color: rgba(255, 255, 255, 0.8);
            letter-spacing: 3px;
            font-weight: 300;
        }

        /* Story Section */
        .story-section {
            padding: 120px 8%;
            background: linear-gradient(180deg, #0a0a0a 0%, #111111 100%);
        }

        .story-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .story-block {
            margin-bottom: 120px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
        }

        .story-block:nth-child(even) {
            direction: rtl;
        }

        .story-block:nth-child(even) > * {
            direction: ltr;
        }

        .story-content h2 {
            font-size: 3rem;
            color: #d4af37;
            margin-bottom: 30px;
            font-weight: 300;
            line-height: 1.2;
        }

        .story-content p {
            font-size: 1.2rem;
            line-height: 2;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 25px;
        }

        .story-image {
            height: 450px;
            background-size: cover;
            background-position: center;
            border-radius: 20px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        /* Philosophy Section */
        .philosophy-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 50px;
            margin-top: 80px;
        }

        .philosophy-card {
            background: rgba(212, 175, 55, 0.05);
            padding: 50px 40px;
            border-radius: 20px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            text-align: center;
        }

        .philosophy-icon {
            font-size: 4rem;
            color: #d4af37;
            margin-bottom: 25px;
        }

        .philosophy-card h3 {
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 20px;
        }

        .philosophy-card p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Timeline Section */
        .timeline {
            margin-top: 120px;
        }

        .timeline-title {
            text-align: center;
            font-size: 3rem;
            color: #d4af37;
            margin-bottom: 80px;
        }

        .timeline-item {
            display: grid;
            grid-template-columns: 200px 1fr;
            gap: 50px;
            margin-bottom: 60px;
            padding-left: 50px;
            border-left: 2px solid rgba(212, 175, 55, 0.3);
            position: relative;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: -11px;
            top: 0;
            width: 20px;
            height: 20px;
            background: #d4af37;
            border-radius: 50%;
            border: 3px solid #0a0a0a;
        }

        .timeline-year {
            font-size: 3rem;
            color: #d4af37;
            font-weight: 300;
        }

        .timeline-content h4 {
            font-size: 1.8rem;
            color: #fff;
            margin-bottom: 15px;
        }

        .timeline-content p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.8;
            font-size: 1.1rem;
        }

        /* Values Section */
        .values-section {
            background: rgba(212, 175, 55, 0.03);
            padding: 100px 8%;
            margin-top: 120px;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 60px auto 0;
        }

        .value-item {
            text-align: center;
        }

        .value-number {
            font-size: 4rem;
            color: #d4af37;
            font-weight: 300;
            margin-bottom: 15px;
        }

        .value-label {
            font-size: 1.3rem;
            color: #fff;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .hero h1 {
                font-size: 3.5rem;
            }

            .story-block {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .story-block:nth-child(even) {
                direction: ltr;
            }

            .story-content h2 {
                font-size: 2.2rem;
            }

            .timeline-item {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>The HazleNut Factory</h1>
            <p class="tagline">CRAFTING LUXURY SINCE INCEPTION</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-container">
            <div class="story-block">
                <div class="story-content">
                    <h2>Our Beginning</h2>
                    <p>The HazleNut Factory was born from a simple yet profound passion: to elevate traditional confections into works of art. What started as a dream in a small kitchen has blossomed into a luxury destination for discerning palates worldwide.</p>
                    <p>Every creation tells a story of dedication, precision, and an unwavering commitment to excellence. We don't just make sweets; we craft experiences that linger in memory long after the last bite.</p>
                </div>
                <div class="story-image" style="background-image: url('https://images.unsplash.com/photo-1556911220-bff31c812dba?w=800')"></div>
            </div>

            <div class="story-block">
                <div class="story-content">
                    <h2>Artisanal Mastery</h2>
                    <p>Each pastry, each confection is a testament to time-honored techniques passed down through generations. Our master artisans have trained for years, perfecting the delicate balance of flavors, textures, and presentation.</p>
                    <p>From hand-selecting the finest pistachios from Iran to sourcing premium dates from the Middle East, we spare no effort in our pursuit of perfection. Quality is not just a standard—it's our signature.</p>
                </div>
                <div class="story-image" style="background-image: url('https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=800')"></div>
            </div>

            <div class="story-block">
                <div class="story-content">
                    <h2>Innovation Meets Tradition</h2>
                    <p>While we honor traditional methods, we're not afraid to innovate. Our R&D team constantly explores new flavor combinations, sustainable practices, and presentation techniques that push the boundaries of confectionery art.</p>
                    <p>This fusion of old and new has earned us recognition from culinary experts worldwide and has made THF a beloved brand for those who appreciate the finer things in life.</p>
                </div>
                <div class="story-image" style="background-image: url('https://images.unsplash.com/photo-1511920170033-f8396924c348?w=800')"></div>
            </div>

            <!-- Philosophy -->
            <div style="margin-top: 120px;">
                <h2 style="text-align: center; font-size: 3rem; color: #d4af37; margin-bottom: 20px;">Our Philosophy</h2>
                <p style="text-align: center; color: rgba(255, 255, 255, 0.6); font-size: 1.2rem; margin-bottom: 60px; max-width: 700px; margin-left: auto; margin-right: auto;">The principles that guide every decision we make</p>
                
                <div class="philosophy-grid">
                    <div class="philosophy-card">
                        <div class="philosophy-icon"><i class="fas fa-star"></i></div>
                        <h3>Quality First</h3>
                        <p>No compromises. We source only the finest ingredients and maintain rigorous quality standards at every step.</p>
                    </div>

                    <div class="philosophy-card">
                        <div class="philosophy-icon"><i class="fas fa-heart"></i></div>
                        <h3>Passion Driven</h3>
                        <p>Love for our craft infuses every creation. It's not just work—it's our calling, our art, our legacy.</p>
                    </div>

                    <div class="philosophy-card">
                        <div class="philosophy-icon"><i class="fas fa-gem"></i></div>
                        <h3>Luxury Redefined</h3>
                        <p>True luxury isn't about excess—it's about perfection in every detail, every flavor, every moment.</p>
                    </div>

                    <div class="philosophy-card">
                        <div class="philosophy-icon"><i class="fas fa-seedling"></i></div>
                        <h3>Sustainable Future</h3>
                        <p>Responsibility to our planet and communities is woven into our business practices and sourcing decisions.</p>
                    </div>
                </div>
            </div>

            <!-- Timeline -->
            <div class="timeline">
                <h2 class="timeline-title">Our Journey</h2>
                
                <div class="timeline-item">
                    <div class="timeline-year">2020</div>
                    <div class="timeline-content">
                        <h4>The Foundation</h4>
                        <p>THF opened its first location, introducing artisanal Middle Eastern confections with a modern twist to delighted customers.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2021</div>
                    <div class="timeline-content">
                        <h4>Expansion & Recognition</h4>
                        <p>Opened three new locations and received our first culinary award for innovation in traditional confectionery.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h4>Coffee Excellence</h4>
                        <p>Launched our specialty coffee program, bringing the same dedication to excellence into the world of artisanal brews.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h4>Global Reach</h4>
                        <p>Introduced online ordering and luxury gift collections, allowing customers worldwide to experience THF excellence.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h4>Sustainability Initiative</h4>
                        <p>Launched our zero-waste program and established direct trade relationships with farmers in origin countries.</p>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="timeline-year">2025+</div>
                    <div class="timeline-content">
                        <h4>The Future</h4>
                        <p>Continuing to innovate, expand, and redefine what luxury confectionery means for the next generation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="values-section">
        <h2 style="text-align: center; font-size: 3rem; color: #d4af37; margin-bottom: 20px;">By The Numbers</h2>
        <p style="text-align: center; color: rgba(255, 255, 255, 0.6); font-size: 1.2rem;">Our impact speaks for itself</p>
        
        <div class="values-grid">
            <div class="value-item">
                <div class="value-number">50,000+</div>
                <div class="value-label">Happy Customers</div>
            </div>

            <div class="value-item">
                <div class="value-number">100+</div>
                <div class="value-label">Unique Creations</div>
            </div>

            <div class="value-item">
                <div class="value-number">15+</div>
                <div class="value-label">Awards Won</div>
            </div>

            <div class="value-item">
                <div class="value-number">12</div>
                <div class="value-label">Store Locations</div>
            </div>
        </div>
    </section>
</body>
</html>
