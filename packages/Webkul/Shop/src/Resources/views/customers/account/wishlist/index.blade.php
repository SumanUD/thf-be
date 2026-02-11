@php
    $customer = auth()->guard('customer')->user();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Wishlist | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">

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

        body {
            font-family: "Forum", serif;
            background: #0a0a0a;
            color: rgba(255, 255, 255, 0.9);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
        }

        .profile-container {
            max-width: 1200px;
            margin: 120px auto 60px;
            padding: 0 40px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 50px;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        .profile-header h1 {
            font-size: 3rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .profile-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
        }

        @media (max-width: 992px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        .profile-sidebar {
            background: rgba(18, 18, 18, 0.95);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 16px;
            padding: 30px;
            height: fit-content;
        }

        .profile-nav-title {
            font-size: 1.3rem;
            color: #d4af37;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        .profile-nav-list {
            list-style: none;
        }

        .profile-nav-item {
            margin-bottom: 5px;
        }

        .profile-nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 18px;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }

        .profile-nav-link:hover,
        .profile-nav-link.active {
            background: rgba(212, 175, 55, 0.1);
            color: #d4af37;
            transform: translateX(5px);
        }

        .profile-nav-link i {
            width: 20px;
            text-align: center;
        }

        .profile-content {
            background: rgba(18, 18, 18, 0.95);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 16px;
            padding: 40px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
        }

        .content-header h2 {
            font-size: 2rem;
            font-weight: 300;
            color: #fff;
        }

        /* Wishlist Grid */
        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .wishlist-card {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.15);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .wishlist-card:hover {
            border-color: rgba(212, 175, 55, 0.4);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .wishlist-image {
            position: relative;
            width: 100%;
            height: 280px;
            overflow: hidden;
            background: rgba(20, 20, 20, 0.9);
        }

        .wishlist-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .wishlist-card:hover .wishlist-image img {
            transform: scale(1.1);
        }

        .remove-btn {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .remove-btn:hover {
            background: #dc3545;
            transform: scale(1.1);
        }

        .wishlist-info {
            padding: 20px;
        }

        .wishlist-name {
            font-size: 1.1rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .wishlist-price {
            font-size: 1.3rem;
            color: #d4af37;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .wishlist-actions {
            display: flex;
            gap: 10px;
        }

        .add-to-cart-btn {
            flex: 1;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2), rgba(180, 150, 50, 0.2));
            border: 1px solid rgba(212, 175, 55, 0.5);
            color: #d4af37;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            font-family: "Forum", serif;
            transition: all 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(180, 150, 50, 0.3));
            border-color: #d4af37;
        }

        .view-product-btn {
            background: transparent;
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: rgba(255, 255, 255, 0.7);
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .view-product-btn:hover {
            border-color: rgba(212, 175, 55, 0.5);
            color: #d4af37;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 5rem;
            color: rgba(212, 175, 55, 0.3);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.8rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 10px;
            font-weight: 300;
        }

        .empty-state p {
            color: rgba(255, 255, 255, 0.5);
            margin-bottom: 30px;
        }

        .shop-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .shop-button:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        @media (max-width: 768px) {
            .profile-container {
                margin-top: 100px;
                padding: 0 20px;
            }

            .profile-header h1 {
                font-size: 2.2rem;
            }

            .profile-content {
                padding: 25px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <div class="profile-container">
        <div class="profile-header">
            <h1>My Wishlist</h1>
            <p>Save your favorite products for later</p>
        </div>

        <div class="profile-grid">
            <aside class="profile-sidebar">
                <h3 class="profile-nav-title">Account Menu</h3>
                <nav>
                    <ul class="profile-nav-list">
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.profile.index') }}" class="profile-nav-link">
                                <i class="fas fa-user"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.orders.index') }}" class="profile-nav-link">
                                <i class="fas fa-shopping-bag"></i>
                                <span>My Orders</span>
                            </a>
                        </li>
                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.wishlist.index') }}" class="profile-nav-link active">
                                <i class="fas fa-heart"></i>
                                <span>Wishlist</span>
                            </a>
                        </li>
                        @endif
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.addresses.index') }}" class="profile-nav-link">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Addresses</span>
                            </a>
                        </li>
                        <li class="profile-nav-item">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('customerLogout').submit();" class="profile-nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <form id="customerLogout" method="POST" action="{{ route('shop.customer.session.destroy') }}" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </aside>

            <main class="profile-content">
                <div class="content-header">
                    <h2>Saved Items</h2>
                </div>

                <div id="wishlistContainer">
                    <div class="empty-state">
                        <i class="fas fa-heart"></i>
                        <h3>Loading wishlist...</h3>
                    </div>
                </div>
            </main>
        </div>
    </div>

    @include("shop::partials.thf-footer")

    <script>
        // Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const megaMenu = document.querySelector('.mega-menu');

        if (menuToggle && megaMenu) {
            menuToggle.addEventListener('click', () => {
                megaMenu.classList.toggle('active');
            });

            document.addEventListener('click', (e) => {
                if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target) && megaMenu.classList.contains('active')) {
                    megaMenu.classList.remove('active');
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                    megaMenu.classList.remove('active');
                }
            });
        }

        // Fetch Wishlist
        fetch('{{ route("shop.api.customers.account.wishlist.index") }}')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('wishlistContainer');

                if (data.data && data.data.length > 0) {
                    container.innerHTML = '<div class="wishlist-grid">' +
                        data.data.map(item => `
                            <div class="wishlist-card">
                                <div class="wishlist-image">
                                    <img src="${item.product.base_image?.medium_image_url || item.product.images?.[0]?.url || '/path/to/placeholder.jpg'}" alt="${item.product.name}">
                                    <button class="remove-btn" onclick="removeFromWishlist(${item.id}, event)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="wishlist-info">
                                    <div class="wishlist-name">${item.product.name}</div>
                                    <div class="wishlist-price">${item.product.formatted_price || item.product.price}</div>
                                    <div class="wishlist-actions">
                                        <button class="add-to-cart-btn" onclick="addToCart(${item.product.id}, event)">
                                            <i class="fas fa-shopping-cart"></i> Add to Cart
                                        </button>
                                        <a href="${item.product.url || '#'}" class="view-product-btn">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        `).join('') +
                        '</div>';
                } else {
                    container.innerHTML = `
                        <div class="empty-state">
                            <i class="fas fa-heart"></i>
                            <h3>Your wishlist is empty</h3>
                            <p>Save products you love and they'll appear here</p>
                            <a href="{{ route('shop.home.index') }}" class="shop-button">
                                <i class="fas fa-shopping-cart"></i>
                                <span>Start Shopping</span>
                            </a>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error fetching wishlist:', error);
                document.getElementById('wishlistContainer').innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-heart"></i>
                        <h3>Your wishlist is empty</h3>
                        <p>Save products you love and they'll appear here</p>
                        <a href="{{ route('shop.home.index') }}" class="shop-button">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Start Shopping</span>
                        </a>
                    </div>
                `;
            });

        function removeFromWishlist(wishlistId, event) {
            event.preventDefault();
            event.stopPropagation();

            if (!confirm('Remove this item from wishlist?')) {
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch(`{{ route('shop.api.customers.account.wishlist.destroy', '') }}/${wishlistId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    location.reload();
                }
            })
            .catch(error => {
                console.error('Error removing from wishlist:', error);
                alert('Failed to remove item. Please try again.');
            });
        }

        function addToCart(productId, event) {
            event.preventDefault();
            event.stopPropagation();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/api/checkout/cart', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.data || data.message) {
                    alert('Added to cart!');
                    // Update cart count
                    const cartCount = document.getElementById('header-cart-count');
                    if (cartCount && data.data?.items_qty) {
                        cartCount.textContent = data.data.items_qty;
                    }
                }
            })
            .catch(error => {
                console.error('Error adding to cart:', error);
                alert('Failed to add to cart. Please try again.');
            });
        }
    </script>
</body>
</html>
