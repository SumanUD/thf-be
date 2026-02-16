<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Results | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">

    @push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Forum', serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
        }

        .search-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 120px 80px 60px;
        }

        .search-header {
            margin-bottom: 60px;
            text-align: center;
        }

        .search-title {
            font-size: 3.5rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        .search-title span {
            color: #d4af37;
        }

        .search-subtitle {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
            font-family: 'Century Gothic', sans-serif;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 40px;
            margin-top: 40px;
        }

        .product-card {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
            border-color: rgba(212, 175, 55, 0.2);
        }

        .card-image {
            position: relative;
            width: 100%;
            padding-top: 100%; /* 1:1 Aspect Ratio */
            overflow: hidden;
            background: #1a1a1a;
        }

        .card-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-card:hover .card-image img {
            transform: scale(1.1);
        }

        .price-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(10px);
            color: #d4af37;
            padding: 8px 16px;
            border-radius: 30px;
            font-weight: 400;
            font-size: 1.1rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            z-index: 2;
        }

        .card-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: #fff;
            font-weight: 400;
            line-height: 1.2;
            min-h-[3rem];
        }

        .card-content .price {
            font-size: 1.5rem;
            color: #d4af37;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .card-actions {
            display: flex;
            gap: 12px;
            margin-top: auto;
        }

        .btn-add-to-cart {
            flex-grow: 1;
            background: #d4af37;
            color: #000;
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: 'Forum', serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-add-to-cart:hover {
            background: #c9a033;
            transform: translateY(-2px);
        }

        .btn-wishlist {
            width: 45px;
            height: 45px;
            background: transparent;
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 8px;
            color: #d4af37;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: #d4af37;
        }

        .no-results {
            text-align: center;
            padding: 100px 20px;
        }

        .no-results i {
            font-size: 5rem;
            color: #d4af37;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .no-results h2 {
            font-size: 2.5rem;
            color: #fff;
            margin-bottom: 15px;
            font-weight: 300;
        }

        .no-results p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.6);
            font-family: 'Century Gothic', sans-serif;
        }

        @media (max-width: 1024px) {
            .search-container {
                padding: 100px 40px 40px;
            }
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 100px 20px 40px;
            }

            .search-title {
                font-size: 2.5rem;
            }

            .product-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
                gap: 20px;
            }
        }
    </style>
    @endpush
</head>
<body>
    @include('shop::partials.thf-header')

    <div class="search-container">
        <div class="search-header">
            <h1 class="search-title">Search <span>Results</span></h1>
            <p class="search-subtitle">Showing results for: <strong>{{ $query }}</strong></p>
        </div>

        <div class="product-grid" id="products-container">
            <!-- Products will be loaded via JavaScript -->
        </div>

        <div id="no-results" class="no-results" style="display: none;">
            <i class="fas fa-search"></i>
            <h2>No Products Found</h2>
            <p>We couldn't find any products matching "{{ $query }}". Try a different search term.</p>
        </div>
    </div>

    @include('shop::partials.thf-footer')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Load Products
        function loadProducts() {
            const query = '{{ $query }}';
            
            axios.get('{{ route("shop.api.products.index") }}', {
                params: {
                    query: query,
                    limit: 50
                }
            })
            .then(response => {
                const products = response.data.data;
                const container = document.getElementById('products-container');
                const noResults = document.getElementById('no-results');

                if (products.length === 0) {
                    container.style.display = 'none';
                    noResults.style.display = 'block';
                    return;
                }

                container.innerHTML = products.map(product => `
                    <div class="product-card">
                        <a href="${product.url_key ? '/' + product.url_key : '/product/' + product.id}" class="card-image-link">
                            <div class="card-image">
                                <img src="${product.base_image?.medium_image_url || '{{ asset("thf-assets/images/placeholder.jpg") }}'}"
                                     alt="${product.name}">
                                <div class="price-badge">${product.price_html ? extractPrice(product.price_html) : '₹' + product.price}</div>
                            </div>
                        </a>
                        <div class="card-content">
                            <h3>${product.name}</h3>
                            <div class="price">${product.price_html || '₹' + product.price}</div>
                            
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
                console.error('Error loading products:', error);
                document.getElementById('no-results').style.display = 'block';
            });
        }

        // Helper to extract price text from HTML if needed
        function extractPrice(html) {
            const div = document.createElement('div');
            div.innerHTML = html;
            return div.innerText.trim();
        }

        // Add to Cart Function
        function addToCart(productId) {
            axios.post('{{ route("shop.api.checkout.cart.store") }}', {
                product_id: productId,
                quantity: 1
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (response.data.message) {
                    // Show a toast or update cart count
                    updateCartCount();
                    // You could add a custom toast here to match THF style
                    showToast(response.data.message, 'success');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Failed to add product to cart', 'error');
            });
        }

        // Add to Wishlist Function
        function addToWishlist(productId) {
            @guest('customer')
                showToast('Please login to add items to wishlist', 'info');
                setTimeout(() => {
                    window.location.href = '{{ route("shop.customer.session.create") }}';
                }, 1500);
                return;
            @endguest

            axios.post('{{ route("shop.api.customers.account.wishlist.store") }}', {
                product_id: productId
            }, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                showToast(response.data.data.message || 'Product added to wishlist!', 'success');
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('Failed to add product to wishlist', 'error');
            });
        }

        // Simple Toast for THF
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.style.cssText = `
                position: fixed;
                bottom: 30px;
                right: 30px;
                background: #1a1a1a;
                color: #fff;
                padding: 15px 25px;
                border-radius: 8px;
                border-left: 4px solid ${type === 'success' ? '#d4af37' : '#ff4d4d'};
                box-shadow: 0 10px 30px rgba(0,0,0,0.5);
                z-index: 10000;
                font-family: 'Century Gothic', sans-serif;
                transition: all 0.3s ease;
                transform: translateY(100px);
                opacity: 0;
            `;
            toast.textContent = message;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transform = 'translateY(0)';
                toast.style.opacity = '1';
            }, 10);

            setTimeout(() => {
                toast.style.transform = 'translateY(100px)';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Update Cart Count
        function updateCartCount() {
            axios.get('{{ route("shop.api.checkout.cart.index") }}')
                .then(response => {
                    const count = response.data.data?.items_qty || 0;
                    const badge = document.getElementById('header-cart-count');
                    if (badge) badge.textContent = count;
                })
                .catch(error => console.error('Error updating cart count:', error));
        }

        // Load products on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadProducts();
            updateCartCount();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="{{ asset('thf-assets/js/home.js') }}"></script>
</body>
</html>
