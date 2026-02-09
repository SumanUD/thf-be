<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Healthy Café Food | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    
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
            background: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=1600') center/cover;
            opacity: 0.12;
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

        /* Menu Categories */
        .menu-category {
            margin-bottom: 100px;
        }

        .category-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .category-header h3 {
            font-size: 2.5rem;
            color: #d4af37;
            margin-bottom: 15px;
            font-weight: 300;
        }

        .category-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
        }

        /* Food Grid */
        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 40px;
        }

        .food-item {
            background: rgba(20, 20, 20, 0.8);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(212, 175, 55, 0.2);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
        }

        .food-item:hover {
            transform: translateY(-8px);
            border-color: rgba(212, 175, 55, 0.5);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }

        .food-image {
            height: 240px;
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .food-tag {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(212, 175, 55, 0.9);
            color: #0a0a0a;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .food-content {
            padding: 30px;
            flex: 1;
        }

        .food-item h4 {
            font-size: 1.5rem;
            color: #fff;
            margin-bottom: 12px;
        }

        .food-item p {
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .food-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: auto;
        }

        .meta-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(212, 175, 55, 0.9);
            font-size: 0.95rem;
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

            .category-header h3 {
                font-size: 2rem;
            }

            .food-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Healthy Café Food</h1>
            <p class="subtitle">Nourishing Your Body, Delighting Your Soul</p>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content-section">
        <h2 class="section-title">Wholesome Culinary Creations</h2>
        <p class="section-subtitle">Fresh, organic ingredients crafted into delicious and nutritious meals that fuel your day</p>

        <!-- Breakfast & Brunch -->
        <div class="menu-category">
            <div class="category-header">
                <h3>Breakfast & Brunch</h3>
                <p>Start your morning right with our energizing selections</p>
            </div>
            <div class="food-grid">
                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1484723091739-30a097e8f929?w=800')">
                        <span class="food-tag">VEGAN</span>
                    </div>
                    <div class="food-content">
                        <h4>Açaí Power Bowl</h4>
                        <p>Organic açaí blended with fresh berries, topped with granola, chia seeds, coconut flakes, and honey</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-leaf"></i> Organic</span>
                            <span class="meta-tag"><i class="fas fa-bolt"></i> High Energy</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1525351484163-7529414344d8?w=800')">
                        <span class="food-tag">PROTEIN-RICH</span>
                    </div>
                    <div class="food-content">
                        <h4>Avocado Toast Deluxe</h4>
                        <p>Smashed avocado on artisan sourdough, topped with poached eggs, cherry tomatoes, and microgreens</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-dumbbell"></i> High Protein</span>
                            <span class="meta-tag"><i class="fas fa-heart"></i> Heart Healthy</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1559561853-08451507cbe7?w=800')">
                        <span class="food-tag">GLUTEN-FREE</span>
                    </div>
                    <div class="food-content">
                        <h4>Quinoa Pancake Stack</h4>
                        <p>Fluffy quinoa and almond flour pancakes with fresh berries, Greek yogurt, and maple syrup</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-wheat"></i> Gluten-Free</span>
                            <span class="meta-tag"><i class="fas fa-smile"></i> Low Sugar</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Salads & Bowls -->
        <div class="menu-category">
            <div class="category-header">
                <h3>Salads & Grain Bowls</h3>
                <p>Vibrant, nutrient-packed meals in a bowl</p>
            </div>
            <div class="food-grid">
                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800')">
                        <span class="food-tag">SUPERFOOD</span>
                    </div>
                    <div class="food-content">
                        <h4>Mediterranean Kale Bowl</h4>
                        <p>Massaged kale, quinoa, feta, olives, cucumber, tomatoes with lemon-tahini dressing</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-star"></i> Superfood</span>
                            <span class="meta-tag"><i class="fas fa-leaf"></i> Vegetarian</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1546793665-c74683f339c1?w=800')">
                        <span class="food-tag">LOW-CARB</span>
                    </div>
                    <div class="food-content">
                        <h4>Grilled Salmon Buddha Bowl</h4>
                        <p>Wild-caught salmon, brown rice, edamame, purple cabbage, mango, with ginger-miso dressing</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-fish"></i> Omega-3</span>
                            <span class="meta-tag"><i class="fas fa-brain"></i> Brain Food</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1505253716362-afaea1d3d1af?w=800')">
                        <span class="food-tag">VEGAN</span>
                    </div>
                    <div class="food-content">
                        <h4>Rainbow Veggie Wrap</h4>
                        <p>Hummus, roasted vegetables, mixed greens, sprouts in whole wheat tortilla with tahini sauce</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-carrot"></i> 5+ Veggies</span>
                            <span class="meta-tag"><i class="fas fa-seedling"></i> Plant-Based</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Smoothies & Juices -->
        <div class="menu-category">
            <div class="category-header">
                <h3>Fresh Smoothies & Cold-Pressed Juices</h3>
                <p>Liquid nutrition packed with vitamins and minerals</p>
            </div>
            <div class="food-grid">
                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=800')">
                        <span class="food-tag">DETOX</span>
                    </div>
                    <div class="food-content">
                        <h4>Green Goddess Smoothie</h4>
                        <p>Spinach, cucumber, pineapple, banana, spirulina, coconut water</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-spa"></i> Detox</span>
                            <span class="meta-tag"><i class="fas fa-bolt"></i> Energy Boost</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1622597467836-f3285f2131b8?w=800')">
                        <span class="food-tag">IMMUNITY</span>
                    </div>
                    <div class="food-content">
                        <h4>Citrus Sunshine Juice</h4>
                        <p>Orange, grapefruit, lemon, ginger, turmeric - cold-pressed for maximum nutrition</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-shield-alt"></i> Immunity</span>
                            <span class="meta-tag"><i class="fas fa-sun"></i> Vitamin C</span>
                        </div>
                    </div>
                </div>

                <div class="food-item">
                    <div class="food-image" style="background-image: linear-gradient(rgba(0,0,0,0.2), rgba(0,0,0,0.2)), url('https://images.unsplash.com/photo-1553530666-ba11a7da3888?w=800')">
                        <span class="food-tag">PROTEIN</span>
                    </div>
                    <div class="food-content">
                        <h4>Berry Protein Power</h4>
                        <p>Mixed berries, protein powder, almond butter, oat milk, chia seeds</p>
                        <div class="food-meta">
                            <span class="meta-tag"><i class="fas fa-dumbbell"></i> 25g Protein</span>
                            <span class="meta-tag"><i class="fas fa-running"></i> Pre/Post Workout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include('shop::partials.thf-footer')
</body>
</html>
