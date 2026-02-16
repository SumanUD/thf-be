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
            font-family: 'Century Gothic', 'Futura', 'Trebuchet MS', Arial, sans-serif;
            background: #0a0a0a;
            color: #fff;
            min-height: 100vh;
        }

        .search-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 80px;
        }

        .search-header {
            margin-bottom: 40px;
        }

        .search-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #d4af37;
            margin-bottom: 10px;
        }

        .search-subtitle {
            font-size: 1.1rem;
            color: #ccc;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .product-card {
            background: rgba(18, 18, 18, 0.95);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(212, 175, 55, 0.1);
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.3);
        }

        .card-image {
            position: relative;
            width: 100%;
            height: 300px;
            overflow: hidden;
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover .card-image img {
            transform: scale(1.05);
        }

        .price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #000;
            padding: 8px 16px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .hover-actions {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            display: flex;
            gap: 10px;
            padding: 15px;
            background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .product-card:hover .hover-actions {
            transform: translateY(0);
        }

        .hover-actions button {
            flex: 1;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: rgba(212, 175, 55, 0.9);
            color: #000;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .hover-actions button:hover {
            background: #d4af37;
            transform: scale(1.05);
        }

        .card-content {
            padding: 25px;
        }

        .card-content h3 {
            font-size: 1.5rem;
            margin-bottom: 12px;
            color: #d4af37;
            font-weight: 600;
        }

        .card-content p {
            color: #ccc;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .no-results {
            text-align: center;
            padding: 100px 20px;
        }

        .no-results i {
            font-size: 5rem;
            color: #d4af37;
            margin-bottom: 20px;
        }

        .no-results h2 {
            font-size: 2rem;
            color: #d4af37;
            margin-bottom: 10px;
        }

        .no-results p {
            font-size: 1.1rem;
            color: #ccc;
        }

        @media (max-width: 768px) {
            .search-container {
                padding: 40px 20px;
            }

            .search-title {
                font-size: 2rem;
            }

            .product-grid {
                grid-template-columns: 1fr;
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
            <h1 class="search-title">Search Results</h1>
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
                alert('Product added to cart!');
                updateCartCount();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product to cart');
            });
        }

        // Add to Wishlist Function
        function addToWishlist(productId) {
            @guest('customer')
                alert('Please login to add items to wishlist');
                window.location.href = '{{ route("shop.customer.session.create") }}';
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
                alert('Product added to wishlist!');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add product to wishlist');
            });
        }

        // Update Cart Count
        function updateCartCount() {
            axios.get('{{ route("shop.api.checkout.cart.index") }}')
                .then(response => {
                    const count = response.data.data?.items_qty || 0;
                    document.getElementById('header-cart-count').textContent = count;
                })
                .catch(error => console.error('Error updating cart count:', error));
        }

        // Load Products
        function loadProducts() {
            const query = '{{ $query }}';
            const params = new URLSearchParams(window.location.search);

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
                    <a href="${product.url_key ? '/' + product.url_key : '/product/' + product.id}" class="product-card">
                        <div class="card-image">
                            <img src="${product.base_image?.medium_image_url || '{{ asset("thf-assets/images/placeholder.jpg") }}'}"
                                 alt="${product.name}">
                            <div class="price-badge">₹${product.price}</div>
                            <div class="hover-actions">
                                <button onclick="event.preventDefault(); addToCart(${product.id})">
                                    <i class="fas fa-shopping-cart"></i> Add to Cart
                                </button>
                                <button onclick="event.preventDefault(); addToWishlist(${product.id})">
                                    <i class="fas fa-heart"></i> Wishlist
                                </button>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3>${product.name}</h3>
                            <p>${product.short_description || 'Premium quality product from The HazleNut Factory'}</p>
                        </div>
                    </a>
                `).join('');
            })
            .catch(error => {
                console.error('Error loading products:', error);
                document.getElementById('no-results').style.display = 'block';
            });
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
