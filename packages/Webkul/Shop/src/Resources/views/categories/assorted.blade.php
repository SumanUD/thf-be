<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url()->to('/') }}">
    <meta name="currency" content="{{ core()->getCurrentCurrency()->toJson() }}">
    <title>Assorted Collection | The HazleNut Factory</title>
    
    @bagistoVite(['src/Resources/assets/css/app.css', 'src/Resources/assets/js/app.js'])
    
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
    <div id="app">
    @include('shop::partials.thf-header')
    
    <section class="video-banner">
        <video autoplay muted loop playsinline>
            <source src="{{ asset('thf-assets/images/banner1.mp4') }}" type="video/mp4">
        </video>
        <div class="banner-overlay"></div>
        <div class="banner-texts">
            <h1 class="active">Assorted <span>Collection</span></h1>
            <h1>Best of <span>Everything</span></h1>
            <h1>Perfect <span>Variety</span></h1>
            <h1>Ultimate <span>Gifting</span></h1>
        </div>
    </section>

    <section class="content">
        <div class="section-header" style="text-align: center; padding: 60px 20px 20px;">
            <h2 style="font-family: 'Forum', serif; font-size: 3rem; color: #d4af37;">Assorted Collection</h2>
            <p style="color: rgba(255,255,255,0.7); max-width: 800px; margin: 20px auto;">Handcrafted assortment of our finest creations, made with premium ingredients.</p>
        </div>

        <v-assorted-products></v-assorted-products>
    </section>
    
    @include('shop::partials.thf-footer')
    </div>

    @pushOnce('scripts')
    <script type="text/x-template" id="v-assorted-products-template">
        <div class="product-grid">
            <template v-if="products.length">
                <x-shop::products.card
                    v-for="product in products"
                    ::product="product"
                    ::key="product.id"
                />
            </template>
            <template v-else>
                <p style="text-align: center; grid-column: 1/-1;">Loading products...</p>
            </template>
        </div>
    </script>

    <script type="module">
        app.component('v-assorted-products', {
            template: '#v-assorted-products-template',
            data() {
                return {
                    products: []
                }
            },
            mounted() {
                this.getProducts();
            },
            methods: {
                getProducts() {
                    this.$axios.get("{{ route('shop.api.products.index', ['category_id' => 6]) }}")
                        .then(response => {
                            this.products = response.data.data;
                        })
                        .catch(error => console.log(error));
                }
            }
        });
    </script>
    @endpushOnce
    
    @stack('scripts')
    
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
    <script src="{{ asset('thf-assets/js/category.js') }}"></script>
    
    <script>
        window.addEventListener("load", function() {
            app.mount("#app");
        });
    </script>
</body>
</html>
