@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Share Your Feedback | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&family=Work+Sans:wght@300;400;500;600&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/store-locator.css') }}">
    
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

        h1, h2, h3, h4, .forum-font {
            font-family: "Forum", serif;
            font-weight: 300;
        }

        /* Hero Banner - Dark Theme */
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

        /* Feedback Hero - Dark overrides */
        .feedback-hero .hero-title {
            color: #fff;
        }

        .feedback-hero .hero-title span {
            color: var(--primary-gold);
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

        /* Main container */
        .feedback-container {
            max-width: 1000px;
            margin: -3rem auto 4rem;
            position: relative;
            z-index: 10;
        }

        /* Floating Card - Dark Theme */
        .feedback-card {
            background: var(--card-bg);
            border-radius: 32px;
            padding: 3rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        /* Header with icon */
        .feedback-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid var(--border-gold);
        }

        .feedback-header-icon {
            width: 60px;
            height: 60px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary-gold);
            border: 1px solid var(--border-gold);
        }

        .feedback-header-text h1 {
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 0.3rem;
            font-weight: 300;
        }

        .feedback-header-text p {
            color: var(--text-light);
            font-size: 1rem;
        }

        /* Quote box - Dark Theme */
        .quote-box {
            background: rgba(20, 20, 20, 0.6);
            border-left: 4px solid var(--primary-gold);
            padding: 2rem;
            margin: 2rem 0 3rem;
            border-radius: 0 20px 20px 0;
            border: 1px solid var(--border-gold);
            border-left-width: 4px;
        }

        .quote-box p {
            font-size: 1.1rem;
            color: #fff;
            font-style: italic;
            margin-bottom: 1rem;
            line-height: 1.7;
        }

        .quote-author {
            font-weight: 500;
            color: var(--primary-gold);
            font-size: 1rem;
        }

        /* Section titles - Dark Theme */
        .section-title {
            font-size: 1.8rem;
            color: #fff;
            margin: 2.5rem 0 1.5rem;
            position: relative;
            font-weight: 300;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary-gold);
            margin-top: 0.5rem;
        }

        /* Form styles - Dark Theme */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: #fff;
            font-weight: 500;
            font-size: 0.95rem;
        }

        .form-label .required {
            color: var(--primary-gold);
            margin-left: 0.2rem;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 1rem 1.2rem;
            border: 1px solid var(--border-gold);
            border-radius: 16px;
            font-size: 0.95rem;
            font-family: 'Work Sans', sans-serif;
            transition: all 0.3s ease;
            background: rgba(20, 20, 20, 0.6);
            color: #fff;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary-gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            background: rgba(30, 30, 30, 0.8);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        .form-select option {
            background: #1a1a1a;
            color: #fff;
        }

        .form-textarea {
            resize: vertical;
            min-height: 150px;
        }

        /* Conditional section - order details - Dark Theme */
        .conditional-section {
            background: rgba(20, 20, 20, 0.6);
            border-radius: 24px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid var(--border-gold);
            display: none;
            backdrop-filter: blur(10px);
        }

        .conditional-section.active {
            display: block;
            animation: fadeIn 0.3s ease;
        }

        .conditional-section h3 {
            font-size: 1.4rem;
            color: #fff;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            font-weight: 300;
        }

        .conditional-section h3 i {
            color: var(--primary-gold);
        }

        /* Upload section - Dark Theme */
        .upload-section {
            background: rgba(20, 20, 20, 0.6);
            border-radius: 24px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        .upload-zone {
            border: 2px dashed var(--border-gold);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: rgba(10, 10, 10, 0.4);
        }

        .upload-zone:hover {
            border-color: var(--primary-gold);
            background: rgba(212, 175, 55, 0.05);
        }

        .upload-zone.dragover {
            border-color: var(--primary-gold);
            background: rgba(212, 175, 55, 0.1);
        }

        .upload-icon {
            font-size: 3rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        .upload-text {
            color: #fff;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .upload-subtext {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .upload-btn {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #C19A2E 100%);
            color: #000;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-size: 0.95rem;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 55, 0.3);
            font-weight: 500;
        }

        .upload-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
        }

        .file-input {
            display: none;
        }

        .file-preview {
            margin-top: 2rem;
        }

        .file-preview h4 {
            color: #fff;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .preview-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .preview-item {
            background: rgba(20, 20, 20, 0.8);
            border-radius: 12px;
            padding: 1rem;
            border: 1px solid var(--border-gold);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex: 1 1 auto;
            min-width: 250px;
            backdrop-filter: blur(10px);
        }

        .preview-icon {
            font-size: 1.5rem;
        }

        .preview-info {
            flex: 1;
        }

        .preview-name {
            font-weight: 500;
            color: #fff;
            font-size: 0.9rem;
            margin-bottom: 0.2rem;
        }

        .preview-size {
            font-size: 0.8rem;
            color: var(--text-light);
        }

        .remove-file {
            color: var(--primary-gold);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.2rem 0.5rem;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .remove-file:hover {
            background: rgba(212, 175, 55, 0.1);
        }

        /* Support panel - Dark Theme */
        .support-panel {
            background: rgba(20, 20, 20, 0.6);
            border-radius: 24px;
            padding: 2.5rem;
            margin: 3rem 0;
            border: 1px solid var(--border-gold);
            box-shadow: 0 15px 30px -12px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(10px);
        }

        .support-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .support-header i {
            font-size: 2rem;
            color: var(--primary-gold);
        }

        .support-header h3 {
            font-size: 1.8rem;
            color: #fff;
            margin: 0;
            font-weight: 300;
        }

        .support-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .support-channel {
            background: rgba(10, 10, 10, 0.6);
            border-radius: 20px;
            padding: 1.8rem 1.5rem;
            text-align: center;
            transition: all 0.4s ease;
            border: 1px solid var(--border-gold);
            backdrop-filter: blur(10px);
        }

        .support-channel:hover {
            transform: translateY(-5px);
            border-color: var(--border-gold-hover);
            box-shadow: 0 15px 30px -8px rgba(212, 175, 55, 0.15);
        }

        .channel-icon {
            font-size: 2rem;
            color: var(--primary-gold);
            margin-bottom: 1rem;
        }

        .support-channel h4 {
            font-size: 1.2rem;
            color: #fff;
            margin-bottom: 0.5rem;
            font-weight: 400;
        }

        .support-channel p {
            color: var(--text-light);
            font-size: 0.9rem;
            margin-bottom: 1.2rem;
            line-height: 1.5;
        }

        .channel-link {
            color: var(--primary-gold);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }

        .channel-link:hover {
            gap: 0.8rem;
            color: #fff;
        }

        /* Submit button - Dark Theme */
        .submit-section {
            text-align: center;
            margin: 3rem 0 1rem;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #C19A2E 100%);
            color: #000;
            padding: 1.2rem 3.5rem;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.4s ease;
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
            display: inline-flex;
            align-items: center;
            gap: 0.8rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.4);
        }

        /* Success page - Dark Theme */
        .success-page {
            display: none;
            text-align: center;
            padding: 3rem 2rem;
        }

        .success-page.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        .success-icon {
            font-size: 4rem;
            color: var(--primary-gold);
            margin-bottom: 2rem;
        }

        .success-page h2 {
            font-family: 'Forum', serif;
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .success-page p {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .success-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-gold) 0%, #C19A2E 100%);
            color: #000;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.4s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #fff;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            border: 2px solid var(--border-gold);
            transition: all 0.4s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary:hover {
            background: rgba(212, 175, 55, 0.1);
            color: var(--primary-gold);
            transform: translateY(-2px);
            border-color: var(--primary-gold);
        }

        /* Footer */
        .feedback-footer {
            margin-top: 4rem;
            background: var(--bg-darker);
            border-top: 1px solid var(--border-gold);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .support-grid {
                grid-template-columns: repeat(2, 1fr);
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

            .feedback-card { 
                padding: 2rem; 
            }
            
            .form-grid { 
                grid-template-columns: 1fr; 
            }
            
            .support-grid { 
                grid-template-columns: 1fr; 
            }
            
            .success-actions { 
                flex-direction: column; 
            }
            
            .feedback-hero .hero-title { 
                font-size: 2.5rem; 
            }

            .feedback-header {
                flex-direction: column;
                text-align: center;
            }

            .feedback-header-text h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2.2rem;
            }

            .hero-sub {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .support-channel {
                padding: 1.5rem 1rem;
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

    <!-- Hero Banner - Dark Theme -->
    <div class="hero-banner feedback-hero">
        <div class="hero-content">
            <div class="hero-title">Share Your <span>Feedback</span></div>
            <div class="hero-sub">Your voice helps us create sweeter experiences for everyone</div>
        </div>
    </div>

    <div class="feedback-container">
        <!-- Main floating card -->
        <div class="feedback-card">
            <!-- Header with icon -->
            <div class="feedback-header">
                <div class="feedback-header-icon">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <div class="feedback-header-text">
                    <h1>We're Listening</h1>
                    <p>Every suggestion helps us grow and serve you better</p>
                </div>
            </div>

            <!-- Quote box -->
            <div class="quote-box">
                <p>"Our commitment to quality isn't just in our ingredients—it's in every interaction we have with our valued customers. Your experiences shape our future."</p>
                <div class="quote-author">— THF Customer Experience Team</div>
            </div>

            <!-- Feedback Form -->
            <form id="feedbackForm">
                <!-- Section A: Basic Info -->
                <h2 class="section-title">Tell us about yourself</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Full Name <span class="required">*</span></label>
                        <input type="text" class="form-input" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address <span class="required">*</span></label>
                        <input type="email" class="form-input" placeholder="you@example.com" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="tel" class="form-input" placeholder="+91 98765 43210">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Preferred Name</label>
                        <input type="text" class="form-input" placeholder="How should we address you?">
                    </div>
                </div>

                <!-- Section B: Category -->
                <h2 class="section-title">What is this about?</h2>
                <div class="form-group">
                    <label class="form-label">Category <span class="required">*</span></label>
                    <select class="form-select" id="categorySelect" required>
                        <option value="">Select a category</option>
                        <option value="online-order">Online Order (Website)</option>
                        <option value="cafe-experience">Café Experience</option>
                        <option value="product-gifting">Product/Gifting</option>
                        <option value="delivery-issue">Delivery Issue</option>
                        <option value="payment-refund">Payment/Refund</option>
                        <option value="custom-orders">Custom Orders</option>
                        <option value="general-suggestion">General Suggestion</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Section C: Order Details (Conditional) -->
                <div class="conditional-section" id="orderDetailsSection">
                    <h3><i class="fas fa-box"></i> Order Details</h3>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label class="form-label">Order ID / Reference Number</label>
                            <input type="text" class="form-input" placeholder="THF-XXXX-XXXX (if available)">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Order Date</label>
                            <input type="date" class="form-input">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Order Value</label>
                            <input type="text" class="form-input" placeholder="Approximate amount">
                        </div>
                    </div>
                </div>

                <!-- Section D: Message -->
                <h2 class="section-title">Share your experience</h2>
                <div class="form-group">
                    <label class="form-label">Your feedback <span class="required">*</span></label>
                    <textarea class="form-textarea" placeholder="Please tell us about your experience. What went well? What could we improve?" required></textarea>
                </div>

                <!-- Section E: Attachments -->
                <h2 class="section-title">Attachments (Optional)</h2>
                <div class="upload-section">
                    <div class="upload-zone" id="uploadZone">
                        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                        <div class="upload-text">Drag & drop files here</div>
                        <div class="upload-subtext">or</div>
                        <label for="fileInput" class="upload-btn">Browse Files</label>
                        <input type="file" id="fileInput" class="file-input" multiple accept="image/*,video/*">
                    </div>
                    
                    <div class="file-preview" id="filePreview" style="display: none;">
                        <h4>Selected Files:</h4>
                        <div class="preview-list" id="previewList"></div>
                    </div>
                    <p style="color: var(--text-light); font-size: 0.85rem; margin-top: 1rem;">
                        <i class="fas fa-info-circle"></i> Max file size: 10MB each. Supported: Images, Videos
                    </p>
                </div>

                <!-- Support Panel -->
                <div class="support-panel">
                    <div class="support-header">
                        <i class="fas fa-headset"></i>
                        <h3>Need Quick Help?</h3>
                    </div>
                    <div class="support-grid">
                        <div class="support-channel">
                            <div class="channel-icon"><i class="fab fa-whatsapp"></i></div>
                            <h4>WhatsApp</h4>
                            <p>Get instant responses for urgent issues</p>
                            <a href="https://wa.me/919876543210" class="channel-link" target="_blank">
                                Chat Now <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="support-channel">
                            <div class="channel-icon"><i class="far fa-envelope"></i></div>
                            <h4>Email</h4>
                            <p>For detailed queries and documentation</p>
                            <a href="mailto:support@thf.com" class="channel-link">
                                support@thf.com <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="support-channel">
                            <div class="channel-icon"><i class="fas fa-phone-alt"></i></div>
                            <h4>Phone</h4>
                            <p>Mon-Sat, 9AM-7PM for immediate assistance</p>
                            <a href="tel:+919876543210" class="channel-link">
                                +91 98765 43210 <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-section">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i> Submit Feedback
                    </button>
                </div>
            </form>

            <!-- Success Page -->
            <div class="success-page" id="successPage">
                <div class="success-icon"><i class="fas fa-check-circle"></i></div>
                <h2>Thank You!</h2>
                <p>We've received your feedback and appreciate you taking the time to share your experience with us. Our team will review your submission and get back to you within 24 hours.</p>
                <div class="success-actions">
                    <a href="/" class="btn-primary"><i class="fas fa-home"></i> Return Home</a>
                    <a href="/products" class="btn-secondary"><i class="fas fa-gift"></i> Explore Products</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="feedback-footer">
        @include("shop::partials.thf-footer")
    </div>

    <script>
        // DOM Elements
        const feedbackForm = document.getElementById('feedbackForm');
        const successPage = document.getElementById('successPage');
        const orderDetailsSection = document.getElementById('orderDetailsSection');
        const categorySelect = document.getElementById('categorySelect');
        const uploadZone = document.getElementById('uploadZone');
        const fileInput = document.getElementById('fileInput');
        const filePreview = document.getElementById('filePreview');
        const previewList = document.getElementById('previewList');
        
        let uploadedFiles = [];

        // Category change handler
        categorySelect.addEventListener('change', function() {
            const selectedValue = this.value;
            const orderCategories = ['online-order', 'delivery-issue', 'payment-refund', 'custom-orders'];
            
            if (orderCategories.includes(selectedValue)) {
                orderDetailsSection.classList.add('active');
            } else {
                orderDetailsSection.classList.remove('active');
            }
        });

        // File upload handling
        uploadZone.addEventListener('click', () => fileInput.click());

        uploadZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadZone.classList.add('dragover');
        });

        uploadZone.addEventListener('dragleave', () => {
            uploadZone.classList.remove('dragover');
        });

        uploadZone.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadZone.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        function handleFiles(files) {
            Array.from(files).forEach(file => {
                if (file.size > 10 * 1024 * 1024) {
                    alert(`File ${file.name} is too large. Maximum size is 10MB.`);
                    return;
                }
                uploadedFiles.push(file);
            });
            updateFilePreview();
        }

        function updateFilePreview() {
            if (uploadedFiles.length > 0) {
                filePreview.style.display = 'block';
                previewList.innerHTML = '';
                
                uploadedFiles.forEach((file, index) => {
                    const fileItem = document.createElement('div');
                    fileItem.className = 'preview-item';
                    
                    let icon = '📄';
                    if (file.type.startsWith('image/')) icon = '🖼️';
                    if (file.type.startsWith('video/')) icon = '🎬';
                    
                    const size = (file.size / 1024).toFixed(1) + ' KB';
                    
                    fileItem.innerHTML = `
                        <div class="preview-icon">${icon}</div>
                        <div class="preview-info">
                            <div class="preview-name">${file.name}</div>
                            <div class="preview-size">${size}</div>
                        </div>
                        <button class="remove-file" onclick="removeFile(${index})"><i class="fas fa-times"></i></button>
                    `;
                    
                    previewList.appendChild(fileItem);
                });
            } else {
                filePreview.style.display = 'none';
            }
        }

        window.removeFile = function(index) {
            uploadedFiles.splice(index, 1);
            updateFilePreview();
        };

        // Form submission
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!this.checkValidity()) {
                this.reportValidity();
                return;
            }
            
            // Show success page
            feedbackForm.style.display = 'none';
            successPage.classList.add('active');
            
            // Log for demo
            console.log('Feedback submitted with files:', uploadedFiles.length);
        });
    </script>
</body>

</html>