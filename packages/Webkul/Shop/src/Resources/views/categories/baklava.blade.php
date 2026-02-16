<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Baklava | The HazleNut Factory</title>
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
        .card-actions { padding: 0 20px 20px; display: flex; gap: 10px; align-items: center; }
        .btn-add-cart { flex: 1; background: rgba(212,175,55,0.9); color: #000; border: none; border-radius: 30px; padding: 12px 20px; font-size: 0.95rem; font-weight: 500; cursor: pointer; font-family: 'Forum', serif; letter-spacing: 0.5px; transition: all 0.3s ease; }
        .btn-add-cart:hover { background: #d4af37; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(212,175,55,0.4); }
        .btn-add-cart:disabled { opacity: 0.5; cursor: not-allowed; transform: none; }
        .btn-wishlist { width: 44px; height: 44px; border-radius: 12px; border: 1px solid rgba(212,175,55,0.3); background: transparent; color: #d4af37; font-size: 1.3rem; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; flex-shrink: 0; }
        .btn-wishlist:hover { background: rgba(212,175,55,0.1); }
        .card-price { padding: 0 20px 5px; font-size: 1.2rem; color: #d4af37; font-weight: 600; }
        .card-name { padding: 15px 20px 5px; font-size: 1.1rem; color: #fff; }
        .flash-msg { position: fixed; top: 20px; right: 20px; padding: 15px 25px; border-radius: 10px; color: #fff; font-family: 'Forum', serif; z-index: 9999; animation: fadeInOut 3s forwards; }
        .flash-success { background: rgba(34,139,34,0.9); }
        .flash-error { background: rgba(220,53,69,0.9); }
        @keyframes fadeInOut { 0% { opacity:0; transform:translateY(-10px); } 10% { opacity:1; transform:translateY(0); } 80% { opacity:1; } 100% { opacity:0; } }
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
            <h1 class="active">Experience <span>Baklava</span></h1>
            <h1>Layers of <span>Perfection</span></h1>
            <h1>Handcrafted with <span>Love</span></h1>
            <h1>Tradition meets <span>Luxury</span></h1>
        </div>
    </section>

    <section class="content">
        <div class="section-header" style="text-align: center; padding: 60px 20px 20px;">
            <h2 style="font-family: 'Forum', serif; font-size: 3rem; color: #d4af37;">Baklava Collection</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 800px; margin: 20px auto;">Handcrafted baklava made with premium ingredients and fine craftsmanship for a perfectly balanced bite.</p>
        </div>

        <div id="product-app">
            <div class="product-grid" v-if="products.length">
                <div class="product-card" v-for="product in products" :key="product.id">
                    <a :href="productUrl(product)" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card-image">
                            <img :src="imageUrl(product)" :alt="product.name" loading="lazy">
                            <span class="price-badge" v-html="getPrice(product)"></span>
                        </div>
                    </a>
                    <div class="card-name" v-text="product.name"></div>
                    <div class="card-price" v-html="product.price_html"></div>
                    <div class="card-actions">
                        <button class="btn-add-cart" @click="addToCart(product)" :disabled="!product.is_saleable || product.adding">
                            <i class="fas fa-shopping-cart"></i>
                            <span v-text="product.adding ? 'Adding...' : 'Add to Cart'"></span>
                        </button>
                        <button class="btn-wishlist" @click="addToWishlist(product)" :title="product.is_wishlist ? 'Remove from Wishlist' : 'Add to Wishlist'">
                            <i :class="product.is_wishlist ? 'fas fa-heart' : 'far fa-heart'"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div v-else-if="loading" style="text-align: center; padding: 60px 20px;">
                <p style="color: rgba(255,255,255,0.7); font-size: 1.2rem;">Loading products...</p>
            </div>
            <div v-else style="text-align: center; padding: 60px 20px;">
                <p style="color: rgba(255,255,255,0.7); font-size: 1.2rem;">No products found.</p>
            </div>
            <div v-if="flashMsg" :class="'flash-msg ' + flashType" v-text="flashMsg"></div>
        </div>
    </section>
    
    @include('shop::partials.thf-footer')

    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const { createApp } = Vue;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
            createApp({
                data() {
                    return { products: [], loading: true, flashMsg: '', flashType: 'flash-success' }
                },
                mounted() {
                    this.fetchProducts();
                },
                methods: {
                    fetchProducts() {
                        fetch("{{ route('shop.api.products.index', ['category_id' => 2]) }}")
                            .then(r => r.json())
                            .then(d => {
                                this.products = d.data.map(p => ({ ...p, adding: false }));
                                this.loading = false;
                            })
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
                    },
                    showFlash(msg, type) {
                        this.flashMsg = msg;
                        this.flashType = type || 'flash-success';
                        setTimeout(() => this.flashMsg = '', 3000);
                    },
                    addToCart(product) {
                        product.adding = true;
                        fetch("{{ route('shop.api.checkout.cart.store') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                            body: JSON.stringify({ product_id: product.id, quantity: 1 })
                        })
                        .then(r => r.json())
                        .then(d => {
                            this.showFlash(d.message || 'Added to cart!', 'flash-success');
                            product.adding = false;
                        })
                        .catch(e => {
                            this.showFlash('Could not add to cart', 'flash-error');
                            product.adding = false;
                        });
                    },
                    addToWishlist(product) {
                        fetch("{{ route('shop.api.customers.account.wishlist.store') }}", {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                            body: JSON.stringify({ product_id: product.id })
                        })
                        .then(r => r.json())
                        .then(d => {
                            product.is_wishlist = !product.is_wishlist;
                            this.showFlash(d.data?.message || d.message || 'Wishlist updated!', 'flash-success');
                        })
                        .catch(e => {
                            window.location.href = "{{ route('shop.customer.session.index') }}";
                        });
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
