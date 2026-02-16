<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    
    <style>
        /* Base styles matching THF Home */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            background: #000;
            color: white;
            font-family: 'Forum', serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .search-main {
            flex: 1;
            padding: 120px 5% 60px;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        .search-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .search-title {
            font-size: 3.5rem;
            font-weight: 300;
            letter-spacing: -1px;
            margin-bottom: 15px;
        }

        .search-title span { color: #d4af37; }

        .search-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            font-family: sans-serif;
        }

        /* Product Grid - Fixed Card Sizing */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 350px)); /* Fixed max-width for cards */
            gap: 40px;
            justify-content: center; /* Centers cards if there are few */
        }

        /* THF Product Card Redesign - Internal Layout */
        .product-card {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            text-decoration: none;
            color: inherit;
            width: 100%;
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .card-image-wrapper {
            position: relative;
            padding-top: 100%;
            overflow: hidden;
            background: #1a1a1a;
        }

        .card-image-wrapper img {
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .card-image-wrapper img {
            transform: scale(1.1);
        }

        .card-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            font-size: 1.25rem;
            font-weight: 400;
            margin-bottom: 10px;
            color: #fff;
            height: 3rem;
            overflow: hidden;
            line-height: 1.2;
        }

        .card-content .price {
            font-size: 1.5rem;
            color: #d4af37;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn-add-to-cart {
            flex: 1;
            background: #d4af37;
            color: #000;
            border: none;
            border-radius: 8px;
            padding: 10px;
            font-family: 'Forum', serif;
            font-weight: 600;
            font-size: 0.85rem;
            cursor: pointer;
            transition: 0.3s;
            text-transform: uppercase;
            display: flex; align-items: center; justify-content: center; gap: 5px;
        }

        .btn-add-to-cart:hover {
            background: #c9a033;
        }

        .btn-wishlist {
            width: 40px;
            height: 40px;
            background: transparent;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 8px;
            color: #d4af37;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem;
        }

        .no-results {
            text-align: center;
            padding: 100px 20px;
        }

        .no-results i { font-size: 5rem; color: #d4af37; margin-bottom: 20px; opacity: 0.5; }
        .no-results h2 { font-size: 2.5rem; margin-bottom: 10px; font-weight: 300; }

        @media (max-width: 768px) {
            .search-main { padding-top: 100px; }
            .search-title { font-size: 2.5rem; }
            .product-grid { grid-template-columns: 1fr; gap: 25px; max-width: 400px; margin: 0 auto; }
        }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')

    <main class="search-main">
        <div class="search-header">
            <h1 class="search-title">Search <span>Results</span></h1>
            <p class="search-subtitle">Showing items for: <strong>{{ $query }}</strong></p>
        </div>

        <div class="product-grid" id="products-container">
            <!-- Products loaded via JS -->
        </div>

        <div id="no-results" class="no-results" style="display: none;">
            <i class="fas fa-search"></i>
            <h2>No Treasures Found</h2>
            <p>We couldn't find any matches for your search. Try another term.</p>
        </div>
    </main>

    @include('shop::partials.thf-footer')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function loadProducts() {
            const query = '{{ $query }}';
            axios.get('{{ route("shop.api.products.index") }}', { params: { query: query, limit: 50 } })
            .then(response => {
                const products = response.data.data;
                const container = document.getElementById('products-container');
                const noResults = document.getElementById('no-results');

                if (!products || products.length === 0) {
                    container.style.display = 'none';
                    noResults.style.display = 'block';
                    return;
                }

                container.innerHTML = products.map(product => `
                    <div class="product-card">
                        <a href="${product.url_key ? '/' + product.url_key : '/product/' + product.id}" style="text-decoration:none; color:inherit;">
                            <div class="card-image-wrapper">
                                <img src="${product.base_image?.medium_image_url || '{{ asset("thf-assets/images/placeholder.jpg") }}'}" alt="${product.name}">
                            </div>
                        </a>
                        <div class="card-content">
                            <h3>${product.name}</h3>
                            <div class="price">${product.price_html ? extractPrice(product.price_html) : '₹' + product.price}</div>
                            <div class="card-actions">
                                <button class="btn-add-to-cart" onclick="addToCart(${product.id})">
                                    <i class="fas fa-shopping-bag"></i> ADD TO CART
                                </button>
                                <button class="btn-wishlist" onclick="addToWishlist(${product.id})" title="Add to Wishlist">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error(error);
                document.getElementById('no-results').style.display = 'block';
            });
        }

        function extractPrice(html) {
            const div = document.createElement('div');
            div.innerHTML = html;
            return div.innerText.trim();
        }

        function addToCart(productId) {
            axios.post('{{ route("shop.api.checkout.cart.store") }}', { product_id: productId, quantity: 1 }, 
            { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
            .then(response => {
                if (response.data.message) {
                    updateCartCount();
                    showToast(response.data.message, 'success');
                }
            })
            .catch(error => showToast('Failed to add to cart', 'error'));
        }

        function addToWishlist(productId) {
            @guest('customer')
                showToast('Please login first', 'info');
                setTimeout(() => window.location.href = '{{ route("shop.customer.session.create") }}', 1000);
                return;
            @endguest
            axios.post('{{ route("shop.api.customers.account.wishlist.store") }}', { product_id: productId },
            { headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content } })
            .then(response => showToast(response.data.data.message, 'success'))
            .catch(error => showToast('Action failed', 'error'));
        }

        function showToast(msg, type) {
            const toast = document.createElement('div');
            toast.style.cssText = `position:fixed; bottom:30px; right:30px; background:#1a1a1a; color:#fff; padding:15px 25px; border-radius:8px; border-left:4px solid ${type==='success'?'#d4af37':'#ff4d4d'}; box-shadow:0 10px 30px rgba(0,0,0,0.5); z-index:10000; transition:0.3s; transform:translateY(100px); opacity:0;`;
            toast.textContent = msg;
            document.body.appendChild(toast);
            setTimeout(() => { toast.style.transform = 'translateY(0)'; toast.style.opacity = '1'; }, 10);
            setTimeout(() => { toast.style.transform = 'translateY(100px)'; toast.style.opacity = '0'; setTimeout(()=>toast.remove(), 300); }, 3000);
        }

        function updateCartCount() {
            axios.get('{{ route("shop.api.checkout.cart.index") }}')
            .then(response => {
                const count = response.data.data?.items_qty || 0;
                const badge = document.getElementById('header-cart-count');
                if (badge) badge.textContent = count;
            });
        }

        document.addEventListener('DOMContentLoaded', () => { loadProducts(); updateCartCount(); });
    </script>
</body>
</html>
