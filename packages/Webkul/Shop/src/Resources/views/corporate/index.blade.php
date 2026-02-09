@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Corporate Gifting | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/corporate.css') }}">
</head>
<body>
    @include('shop::partials.thf-header')

    <!-- Hero Banner -->
    <section class="hero">
        <div class="hero-decoration deco-1"></div>
        <div class="hero-decoration deco-2"></div>
        <div class="hero-decoration deco-3"></div>

        <div class="hero-content">
            <h1>Sweeten Every <span>Corporate Moment</span></h1>
            <p class="subtitle">Premium handcrafted sweets & treats for clients, teams, and celebrations. Elevate your corporate gifting with authentic flavors and thoughtful presentation.</p>
            <div class="hero-cta">
                <a href="#contact-form" class="btn-primary">Get Started</a>
                <a href="#why-choose" class="btn-secondary">Learn More</a>
            </div>
        </div>
    </section>

    <!-- Number Band -->
    <section class="number-band">
        <div class="number-container">
            <div class="number-item">
                <span class="number">500+</span>
                <span class="number-label">Happy Corporate Clients</span>
            </div>
            <div class="number-item">
                <span class="number">50K+</span>
                <span class="number-label">Gifts Delivered</span>
            </div>
            <div class="number-item">
                <span class="number">100%</span>
                <span class="number-label">Handcrafted Quality</span>
            </div>
            <div class="number-item">
                <span class="number">24hr</span>
                <span class="number-label">Quick Turnaround</span>
            </div>
        </div>
    </section>

    <!-- Logo Slider -->
    <section class="logo-slider-section">
        <h2>Trusted by Industry Leaders</h2>
        <div class="logo-slider-wrapper">
            <div class="logo-track">
                <div class="logo-item">Google</div>
                <div class="logo-item">Microsoft</div>
                <div class="logo-item">Amazon</div>
                <div class="logo-item">Infosys</div>
                <div class="logo-item">TCS</div>
                <div class="logo-item">Wipro</div>
                <div class="logo-item">HCL</div>
                <div class="logo-item">Accenture</div>
                <!-- Duplicate set for seamless loop -->
                <div class="logo-item">Google</div>
                <div class="logo-item">Microsoft</div>
                <div class="logo-item">Amazon</div>
                <div class="logo-item">Infosys</div>
                <div class="logo-item">TCS</div>
                <div class="logo-item">Wipro</div>
                <div class="logo-item">HCL</div>
                <div class="logo-item">Accenture</div>
            </div>
        </div>
    </section>

    <!-- How to Customize -->
    <section class="customize-section">
        <div class="container">
            <h2>Build Your Perfect Gift Hamper</h2>
            <p class="section-subtitle">Your Budget, Your Branding, Our Expertise - Create memorable gifts in three simple steps</p>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon"><i class="fas fa-box"></i></div>
                    <h3>Choose Your Budget & Packaging</h3>
                    <p>Select from our range of premium packaging options and set your budget. We offer flexible solutions from ₹500 to ₹5000+ per hamper.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon"><i class="fas fa-palette"></i></div>
                    <h3>Add Your Brand Identity</h3>
                    <p>Customize with your logo on boxes, sleeves, cards, or stickers. We offer gold foiling, UV printing, and premium finishing options.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon"><i class="fas fa-gift"></i></div>
                    <h3>Include Special Extras</h3>
                    <p>Add branded merchandise, personalized notes, or premium add-ons to make your gift truly unforgettable.</p>
                </div>
            </div>

            <div class="customize-cta">
                <a href="#contact-form" class="btn-primary">Talk to Our Team</a>
            </div>
        </div>
    </section>

    <!-- Why Choose THF -->
    <section id="why-choose" class="why-choose-section">
        <h2>Why Choose THF?</h2>
        <p class="section-subtitle">Simple, reliable corporate gifting — built for teams & clients with authentic flavors and uncompromising quality</p>

        <div class="features-grid">
            <div class="feature-card">
                <span class="feature-icon"><i class="fas fa-gift"></i></span>
                <h3>Flexible Gifting Solutions</h3>
                <p>Customizable hampers for every budget and occasion. Perfect for client appreciation, employee rewards, and festive celebrations.</p>
            </div>

            <div class="feature-card">
                <span class="feature-icon"><i class="fas fa-truck"></i></span>
                <h3>Pan-India Delivery</h3>
                <p>Free shipping for bulk orders across India. Hand-delivered freshness with temperature-controlled packaging.</p>
            </div>

            <div class="feature-card">
                <span class="feature-icon"><i class="fas fa-bolt"></i></span>
                <h3>Quick Turnaround</h3>
                <p>24-48 hour processing for most orders. Perfect for last-minute gifting needs and urgent corporate requirements.</p>
            </div>

            <div class="feature-card">
                <span class="feature-icon"><i class="fas fa-tag"></i></span>
                <h3>Premium Branding Options</h3>
                <p>Gold foil stamping, custom sleeves, branded ribbons, and personalized notes to elevate your corporate identity.</p>
            </div>

            <div class="feature-card">
                <span class="feature-icon"><i class="fas fa-star"></i></span>
                <h3>White-Glove Service</h3>
                <p>Dedicated account manager, custom proposals, and end-to-end gifting solutions for hassle-free corporate gifting.</p>
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section id="contact-form" class="form-section">
        <div class="container">
            <h2>Get Your Custom Quote</h2>
            <p class="section-subtitle">Fill in your details and our gifting expert will reach out within 2 hours</p>

            <div class="form-wrapper">
                <form id="corporate-gifting-form" action="{{ route('shop.home.contact_us.send_mail') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="company">Company Name *</label>
                            <input type="text" id="company" name="company">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Work Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact">Phone Number *</label>
                            <input type="tel" id="contact" name="contact" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="occasion">What's the occasion?</label>
                        <select id="occasion" name="occasion">
                            <option value="">Select an occasion</option>
                            <option value="client-gifting">Client Gifting</option>
                            <option value="employee-rewards">Employee Rewards</option>
                            <option value="festival-gifting">Festival Gifting (Diwali, Christmas, etc.)</option>
                            <option value="new-launch">Product/Service Launch</option>
                            <option value="conference">Conference/Event</option>
                            <option value="anniversary">Company Anniversary</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="budget">Approximate Budget Range</label>
                            <select id="budget" name="budget">
                                <option value="">Select budget range</option>
                                <option value="500-1000">₹500 - ₹1,000 per hamper</option>
                                <option value="1000-2500">₹1,000 - ₹2,500 per hamper</option>
                                <option value="2500-5000">₹2,500 - ₹5,000 per hamper</option>
                                <option value="5000+">₹5,000+ per hamper</option>
                                <option value="custom">Custom Quote Needed</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Approximate Quantity</label>
                            <select id="quantity" name="quantity">
                                <option value="">Select quantity</option>
                                <option value="10-50">10-50 hampers</option>
                                <option value="50-100">50-100 hampers</option>
                                <option value="100-250">100-250 hampers</option>
                                <option value="250-500">250-500 hampers</option>
                                <option value="500+">500+ hampers</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message">Specific Requirements / Additional Notes</label>
                        <textarea id="message" name="message" placeholder="Tell us about your specific needs, branding requirements, delivery timeline, dietary restrictions, etc."></textarea>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn-primary">Get Your Custom Proposal</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>THF Corporate Gifting</h3>
                <p>Premium handcrafted sweets and treats for discerning corporate clients. Elevating relationships through thoughtful gifting since 2010.</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <a href="#contact-form">Get a Quote</a>
                <a href="#why-choose">Why Choose Us</a>
                <a href="#">Corporate Catalog</a>
                <a href="#">Bulk Order Terms</a>
                <a href="#">Delivery Information</a>
            </div>

            <div class="footer-section">
                <h3>Our Products</h3>
                <a href="{{ route('shop.search.index') }}">Festive Hampers</a>
                <a href="{{ route('shop.search.index') }}">Client Gifting</a>
                <a href="{{ route('shop.search.index') }}">Employee Rewards</a>
                <a href="{{ route('shop.search.index') }}">Custom Branding</a>
                <a href="{{ route('shop.search.index') }}">Seasonal Specials</a>
            </div>

            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> Corporate Office: 123 Business District, Mumbai, India</p>
                <p><i class="fas fa-phone"></i> +91 98765 43210</p>
                <p><i class="fas fa-envelope"></i> corporate@thf.com</p>
                <p><i class="fas fa-clock"></i> Mon-Sat: 9AM - 7PM</p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} THF Corporate Gifting. All rights reserved. | Privacy Policy | Terms of Service</p>
        </div>
    </footer>

    <script src="{{ asset('thf-assets/js/corporate.js') }}"></script>
</body>
</html>
