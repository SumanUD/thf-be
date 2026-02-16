<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Mewabite | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/category.css') }}">
    <style>
        body { background: #000; color: #fff; }
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
            padding: 40px 5%;
            max-width: 1400px;
            margin: 0 auto;
        }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')
    
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>
        <div class="banner-overlay"></div>
        <div class="banner-texts">
            <h1 class="active">Artisan <span>Mewabites</span></h1>
            <h1>Premium <span>Dry Fruits</span></h1>
            <h1>Natural <span>Flavors</span></h1>
            <h1>Wholesome <span>Goodness</span></h1>
        </div>
    </section>

    <section class="content">
        <div class="section-header" style="text-align: center; padding: 60px 20px 20px;">
            <h2 style="font-family: 'Forum', serif; font-size: 3rem; color: #d4af37;">Mewabite Collection</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 800px; margin: 20px auto;">Handcrafted dry-fruit bites made with premium ingredients and fine craftsmanship.</p>
        </div>

        <div id="product-app">
            <div class="product-grid" v-if="products.length">
                <div class="product-card" v-for="product in products" :key="product.id">
                    <a :href="productUrl(product)" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card-image">
                            <img :src="imageUrl(product)" :alt="product.name" loading="lazy">
                            <span class="price-badge" v-text="getPrice(product)"></span>
                        </div>
                        <div class="card-content">
                            <h3 v-text="product.name"></h3>
                        </div>
                    </a>
                </div>
            </div>
            <div v-else-if="loading" style="text-align: center; padding: 60px 20px;">
                <p style="color: rgba(255,255,255,0.7); font-size: 1.2rem;">Loading products...</p>
            </div>
            <div v-else style="text-align: center; padding: 60px 20px;">
                <p style="color: rgba(255,255,255,0.7); font-size: 1.2rem;">No products found.</p>
            </div>
        </div>
    </section>
    
    @include('shop::partials.thf-footer')

    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const { createApp } = Vue;
            createApp({
                data() {
                    return { products: [], loading: true }
                },
                mounted() {
                    this.fetchProducts();
                },
                methods: {
                    fetchProducts() {
                        fetch("{{ route('shop.api.products.index', ['category_id' => 5]) }}")
                            .then(r => r.json())
                            .then(d => { this.products = d.data; this.loading = false; })
                            .catch(e => { console.error('Error loading products:', e); this.loading = false; });
                    },
                    productUrl(p) { return '/' + p.url_key; },
                    imageUrl(p) {
                        let u = p.base_image?.medium_image_url || '';
                        if (u.includes('localhost')) u = u.replace(/https?:\/\/localhost(:\d+)?/, location.origin);
                        return u;
                    },
                    getPrice(p) {
                        if (p.prices?.final?.formatted_price) return p.prices.final.formatted_price;
                        if (p.prices?.regular?.formatted_price) return p.prices.regular.formatted_price;
                        return p.formatted_price || '';
                    }
                }
            }).mount('#product-app');
        });
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
    <script src="{{ asset('thf-assets/js/category.js') }}"></script>
</body>
</html>
