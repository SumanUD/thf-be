@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us | The HazleNut Factory</title>

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <style>
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
            from {
                opacity: 0;
                transform: translateY(60px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* CONTACT HEADER */
        .contact-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .contact-header h1 {
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .contact-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: #d4af37;
        }

        .contact-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* CONTACT LAYOUT */
        .contact-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }

        /* CONTACT FORM */
        .contact-form-section h2 {
            font-size: 2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .contact-form-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        .contact-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 16px 20px;
            font-size: 1rem;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(10, 10, 10, 0.8);
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
            font-family: "Forum", serif;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #d4af37;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            outline: none;
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .submit-btn {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 18px 40px;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            margin-top: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        /* CONTACT INFO */
        .contact-info-section h2 {
            font-size: 2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .contact-info-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        .contact-cards {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .contact-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 16px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            border-color: rgba(212, 175, 55, 0.3);
            transform: translateY(-5px);
        }

        .contact-card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-size: 1.2rem;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .contact-card-header h3 {
            font-size: 1.3rem;
            font-weight: 400;
            color: #fff;
        }

        .contact-card-content p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.05rem;
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .contact-card-content a {
            color: #d4af37;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-card-content a:hover {
            color: #fff;
            text-decoration: underline;
        }

        /* LOCATIONS SECTION */
        .locations-section {
            margin-top: 60px;
        }

        .locations-section h2 {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 40px;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }

        .locations-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background: #d4af37;
        }

        .locations-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        .location-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 16px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.3s ease;
        }

        .location-card:hover {
            border-color: rgba(212, 175, 55, 0.3);
            transform: translateY(-5px);
        }

        .location-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .location-icon {
            width: 45px;
            height: 45px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-size: 1.1rem;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .location-header h3 {
            font-size: 1.4rem;
            font-weight: 400;
            color: #fff;
        }

        .location-details {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.05rem;
            line-height: 1.6;
        }

        .location-details p {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .location-details i {
            color: #d4af37;
            margin-top: 4px;
            flex-shrink: 0;
        }

        .location-actions {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .location-btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: rgba(255, 255, 255, 0.05);
            color: rgba(255, 255, 255, 0.9);
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .location-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.3);
        }

        /* MAP SECTION */
        .map-section {
            margin-top: 60px;
        }

        .map-container {
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: 400px;
            background: rgba(20, 20, 20, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .map-placeholder {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            padding: 40px;
        }

        .map-placeholder i {
            font-size: 3rem;
            color: #d4af37;
            margin-bottom: 20px;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .contact-layout {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .locations-grid {
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
                height: 320px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .locations-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .location-actions {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Get In Touch</div>
            <div class="hero-sub">We're here to help with any questions about our products, orders, or services. Reach
                out to us through any of the channels below.</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="floating-card">
            <!-- Contact Header -->
            <div class="contact-header">
                <h1>Contact The HazleNut Factory</h1>
                <p>Whether you have questions about our sweets, need assistance with an order, or want to discuss
                    corporate gifting, we're here to help.</p>
            </div>

            <!-- Contact Layout -->
            <div class="contact-layout">
                <!-- Contact Form -->
                <div class="contact-form-section">
                    <h2>Send Us a Message</h2>
                    <form class="contact-form" id="contactForm">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email address">
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Inquiry</option>
                                <option value="corporate">Corporate Gifting</option>
                                <option value="bulk">Bulk Orders</option>
                                <option value="feedback">Product Feedback</option>
                                <option value="partnership">Business Partnership</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Your Message *</label>
                            <textarea id="message" name="message" required
                                placeholder="How can we help you?"></textarea>
                        </div>

                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Send Message
                        </button>
                    </form>
                </div>

                <!-- Contact Information -->
                <div class="contact-info-section">
                    <h2>Contact Information</h2>

                    <div class="contact-cards">
                        <!-- Phone Card -->
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <div class="contact-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <h3>Call Us</h3>
                            </div>
                            <div class="contact-card-content">
                                <p>Phone: <a href="tel:+917084400400">7084400400</a></p>
                            </div>
                        </div>

                        <!-- Email Card -->
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <div class="contact-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <h3>Email Us</h3>
                            </div>
                            <div class="contact-card-content">
                                <p>Feedback: <a href="mailto:Feedback@thehazelnutfactory.com">Feedback@thehazelnutfactory.com</a></p>
                            </div>
                        </div>

                        <!-- Address Card -->
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <div class="contact-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h3>Office Address</h3>
                            </div>
                            <div class="contact-card-content">
                                <p>D 10 & D 12, Vivekanandapuri Hydel Colony,</p>
                                <p>Nirala Nagar, Lucknow,</p>
                                <p>Uttar Pradesh 226020</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Locations Section -->
            <div class="locations-section">
                <h2>Our Location</h2>
                <div class="locations-grid">
                    <!-- Lucknow Head Office -->
                    <div class="location-card">
                        <div class="location-header">
                            <div class="location-icon">
                                <i class="fas fa-store"></i>
                            </div>
                            <h3>Lucknow Head Office</h3>
                        </div>
                        <div class="location-details">
                            <p><i class="fas fa-map-marker-alt"></i> D 10 & D 12, Vivekanandapuri Hydel Colony, Nirala Nagar, Lucknow - 226020</p>
                            <p><i class="fas fa-phone"></i> <a href="tel:+917084400400">7084400400</a></p>
                            <p><i class="fas fa-envelope"></i> <a href="mailto:Feedback@thehazelnutfactory.com">Feedback@thehazelnutfactory.com</a></p>
                        </div>
                        <div class="location-actions">
                            <button class="location-btn"><i class="fas fa-directions"></i> Directions</button>
                            <button class="location-btn"><i class="fas fa-phone"></i> Call</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="map-section">
                <h2 style="text-align: center; margin-bottom: 30px; font-size: 2rem;">Find Us on Map</h2>
                <div class="map-container">
                    <div class="map-placeholder">
                        <i class="fas fa-map-marked-alt"></i>
                        <h3>Interactive Map</h3>
                        <p>Our office is located in Nirala Nagar, Lucknow.</p>
                        <p>Click on Directions to get the route to our location.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include("shop::partials.thf-footer")

    <script>
        // Contact Form Submission
        document.getElementById('contactForm').addEventListener('submit', function (e) {
            e.preventDefault();

            // Get form data
            const formData = new FormData(this);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });

            // Here you would typically send the data to your server
            // For now, we'll just show a success message
            alert('Thank you for your message! We will get back to you within 24 hours.');
            this.reset();
        });

        // Location buttons functionality
        document.querySelectorAll('.location-btn').forEach(button => {
            button.addEventListener('click', function () {
                const action = this.textContent.trim();
                const locationCard = this.closest('.location-card');
                const locationName = locationCard.querySelector('h3').textContent;

                if (action.includes('Directions')) {
                    // Open Google Maps with the Lucknow address
                    const address = "D 10 & D 12, Vivekanandapuri Hydel Colony, Nirala Nagar, Lucknow, Uttar Pradesh 226020";
                    window.open(`https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`, '_blank');
                } else if (action.includes('Call')) {
                    window.location.href = 'tel:+917084400400';
                }
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>