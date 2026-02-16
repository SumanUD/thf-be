<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Contact Us | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    
    <style>
        /* Base styles matching THF Theme */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            background: #000;
            color: white;
            font-family: 'Forum', serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .contact-main {
            flex: 1;
            padding: 140px 5% 80px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 80px;
            align-items: start;
        }

        .contact-info h1 {
            font-size: 3.5rem;
            font-weight: 300;
            letter-spacing: -1px;
            margin-bottom: 25px;
            line-height: 1.1;
        }

        .contact-info h1 span { color: #d4af37; }

        .contact-info p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 40px;
            line-height: 1.6;
            font-family: sans-serif;
        }

        .info-item {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-icon {
            width: 50px;
            height: 50px;
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .info-text h3 {
            font-size: 1.3rem;
            color: #fff;
            margin-bottom: 5px;
            font-weight: 400;
        }

        .info-text p {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 0;
        }

        /* Form Styling */
        .contact-form-container {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            padding: 50px;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 10px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .form-control {
            width: 100%;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px 20px;
            border-radius: 12px;
            color: #fff;
            font-family: 'Forum', serif;
            font-size: 1.1rem;
            transition: 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #d4af37;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1);
        }

        textarea.form-control {
            height: 150px;
            resize: none;
        }

        .btn-submit {
            width: 100%;
            background: #d4af37;
            color: #000;
            border: none;
            padding: 18px;
            border-radius: 12px;
            font-family: 'Forum', serif;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 10px;
        }

        .btn-submit:hover {
            background: #c9a033;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.2);
        }

        @media (max-width: 992px) {
            .contact-grid { grid-template-columns: 1fr; gap: 60px; }
            .contact-main { padding-top: 120px; }
        }

        @media (max-width: 768px) {
            .contact-info h1 { font-size: 2.8rem; }
            .contact-form-container { padding: 30px 20px; }
        }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')

    <main class="contact-main">
        <div class="contact-grid">
            <!-- Left Side: Info -->
            <div class="contact-info">
                <h1>Get in <span>Touch</span></h1>
                <p>Have questions about our artisanal collection or corporate gifting? We'd love to hear from you. Our masters are ready to assist you.</p>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info-text">
                        <h3>Our Factory</h3>
                        <p>Corporate Office, Mumbai, India</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                    <div class="info-text">
                        <h3>Phone</h3>
                        <p>+91 98765 43210</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-text">
                        <h3>Email</h3>
                        <p>concierge@thf.com</p>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-clock"></i></div>
                    <div class="info-text">
                        <h3>Service Hours</h3>
                        <p>Mon - Sat: 9:00 AM - 7:00 PM</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="contact-form-container">
                <form action="{{ route('shop.home.contact_us.send_mail') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Your Name *</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ex: Rahul Sharma">
                    </div>

                    <div class="form-group">
                        <label>Email Address *</label>
                        <input type="email" name="email" class="form-control" required placeholder="rahul@example.com">
                    </div>

                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact" class="form-control" placeholder="+91 00000 00000">
                    </div>

                    <div class="form-group">
                        <label>Message *</label>
                        <textarea name="message" class="form-control" required placeholder="How can we help you?"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </main>

    @include('shop::partials.thf-footer')

    @if (session()->has('success'))
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('success') }}", 'success');
            });

            function showToast(msg, type) {
                const toast = document.createElement('div');
                toast.style.cssText = `position:fixed; bottom:30px; right:30px; background:#1a1a1a; color:#fff; padding:15px 25px; border-radius:8px; border-left:4px solid ${type==='success'?'#d4af37':'#ff4d4d'}; box-shadow:0 10px 30px rgba(0,0,0,0.5); z-index:10000; font-family:sans-serif; transition:0.3s; transform:translateY(100px); opacity:0;`;
                toast.textContent = msg;
                document.body.appendChild(toast);
                setTimeout(() => { toast.style.transform = 'translateY(0)'; toast.style.opacity = '1'; }, 10);
                setTimeout(() => { toast.style.transform = 'translateY(100px)'; toast.style.opacity = '0'; setTimeout(()=>toast.remove(), 300); }, 4000);
            }
        </script>
    @endif
</body>
</html>
