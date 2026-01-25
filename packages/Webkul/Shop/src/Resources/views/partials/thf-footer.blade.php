{{-- THF Shared Footer Partial - Matches Home Page Footer --}}
<style>
    /* Footer Styles */
    .thf-footer {
        background: rgba(0, 0, 0, 0.95);
        color: #fff;
        padding: 50px 20px 20px;
        border-top: 1px solid rgba(212, 175, 55, 0.2);
        backdrop-filter: blur(10px);
        font-family: "Forum", serif;
    }

    .thf-footer-content {
        max-width: 1300px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 30px;
    }

    .thf-footer-section h3 {
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: #d4af37;
        font-weight: 500;
        letter-spacing: 1px;
    }

    .thf-footer-section p,
    .thf-footer-section a {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        line-height: 1.8;
        font-size: 0.9rem;
        transition: color 0.3s ease;
    }

    .thf-footer-section a {
        display: block;
    }

    .thf-footer-section a:hover {
        color: #d4af37;
    }

    .thf-footer-links {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .thf-social-links {
        display: flex;
        gap: 12px;
        margin-top: 15px;
    }

    .thf-social-icon {
        width: 36px;
        height: 36px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
    }

    .thf-social-icon:hover {
        background: #d4af37;
        transform: translateY(-3px);
        border-color: #d4af37;
        color: #000;
    }

    .thf-footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
        text-align: center;
        color: rgba(255, 255, 255, 0.5);
        font-size: 0.85rem;
    }

    .thf-footer-bottom a {
        color: #d4af37;
        text-decoration: none;
    }

    .thf-footer-bottom a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .thf-footer {
            padding: 40px 15px 15px;
        }
        
        .thf-footer-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }
    }
</style>

<footer class="thf-footer">
    <div class="thf-footer-content">
        <div class="thf-footer-section">
            <h3>THF Corporate Gifting</h3>
            <p>Premium handcrafted sweets and treats for discerning corporate clients. Elevating relationships through thoughtful gifting since 2010.</p>
            <div class="thf-social-links">
                <a href="#" class="thf-social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="thf-social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="thf-social-icon"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="thf-social-icon"><i class="fab fa-twitter"></i></a>
            </div>
        </div>

        <div class="thf-footer-section">
            <h3>Quick Links</h3>
            <div class="thf-footer-links">
                <a href="{{ route('shop.corporate.index') }}">Get a Quote</a>
                <a href="{{ route('shop.corporate.index') }}">Why Choose Us</a>
                <a href="{{ route('shop.corporate.index') }}">Corporate Catalog</a>
                <a href="{{ route('shop.store-locator.index') }}">Store Locator</a>
                <a href="#">Delivery Information</a>
            </div>
        </div>

        <div class="thf-footer-section">
            <h3>Our Products</h3>
            <div class="thf-footer-links">
                <a href="{{ route('shop.collection.index') }}">Festive Hampers</a>
                <a href="{{ route('shop.collection.index') }}">Client Gifting</a>
                <a href="{{ route('shop.collection.index') }}">Employee Rewards</a>
                <a href="{{ route('shop.collection.index') }}">Custom Branding</a>
                <a href="{{ route('shop.collection.index') }}">Seasonal Specials</a>
            </div>
        </div>

        <div class="thf-footer-section">
            <h3>Contact Us</h3>
            <p><i class="fas fa-map-marker-alt"></i> Corporate Office, Mumbai, India</p>
            <p><i class="fas fa-phone"></i> +91 98765 43210</p>
            <p><i class="fas fa-envelope"></i> corporate@thf.com</p>
            <p><i class="fas fa-clock"></i> Mon-Sat: 9AM - 7PM</p>
        </div>
    </div>

    <div class="thf-footer-bottom">
        <p>&copy; {{ date('Y') }} THF Corporate Gifting. All rights reserved. | <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
    </div>
</footer>
