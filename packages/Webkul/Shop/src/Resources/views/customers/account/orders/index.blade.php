@php
    $customer = auth()->guard('customer')->user();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Orders | The HazleNut Factory</title>

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

        /* Orders Grid */
        .orders-grid {
            display: grid;
            gap: 20px;
        }

        .order-card {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.15);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .order-card:hover {
            border-color: rgba(212, 175, 55, 0.4);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .order-id {
            font-size: 1.2rem;
            font-weight: 500;
            color: #d4af37;
        }

        .order-date {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
        }

        .order-status {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }

        .status-processing {
            background: rgba(33, 150, 243, 0.2);
            color: #2196f3;
            border: 1px solid rgba(33, 150, 243, 0.3);
        }

        .status-completed {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .status-canceled {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .detail-label {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .detail-value {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.05rem;
            font-weight: 500;
        }

        .order-total {
            font-size: 1.4rem;
            color: #d4af37;
            font-weight: 600;
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

            .order-header {
                flex-direction: column;
                gap: 10px;
            }

            .order-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <div class="profile-container">
        <div class="profile-header">
            <h1>My Orders</h1>
            <p>Track and manage your orders</p>
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
                            <a href="{{ route('shop.customers.account.orders.index') }}" class="profile-nav-link active">
                                <i class="fas fa-shopping-bag"></i>
                                <span>My Orders</span>
                            </a>
                        </li>
                        @if (core()->getConfigData('customer.settings.wishlist.wishlist_option'))
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.wishlist.index') }}" class="profile-nav-link">
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
                    <h2>Order History</h2>
                </div>

                <div id="ordersContainer">
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag"></i>
                        <h3>Loading orders...</h3>
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

        // Fetch Orders
        fetch('{{ route("shop.customers.account.orders.index") }}', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('ordersContainer');

            if (data.records && data.records.length > 0) {
                container.innerHTML = '<div class="orders-grid">' +
                    data.records.map(order => `
                        <a href="${order.actions && order.actions[0] ? order.actions[0].url : '#'}" style="text-decoration: none;">
                            <div class="order-card">
                                <div class="order-header">
                                    <div>
                                        <div class="order-id">Order #${order.id || order.increment_id}</div>
                                        <div class="order-date">${order.created_at || 'N/A'}</div>
                                    </div>
                                    <div class="order-status ${getStatusClass(order.status)}">
                                        ${order.status || 'Pending'}
                                    </div>
                                </div>
                                <div class="order-details">
                                    <div class="detail-item">
                                        <div class="detail-label">Items</div>
                                        <div class="detail-value">${order.total_item_count || 0} item(s)</div>
                                    </div>
                                    <div class="detail-item">
                                        <div class="detail-label">Order Total</div>
                                        <div class="order-total">${order.grand_total || order.base_grand_total || '$0.00'}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    `).join('') +
                    '</div>';
            } else {
                container.innerHTML = `
                    <div class="empty-state">
                        <i class="fas fa-shopping-bag"></i>
                        <h3>No orders yet</h3>
                        <p>Start shopping and your orders will appear here</p>
                        <a href="{{ route('shop.home.index') }}" class="shop-button">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Start Shopping</span>
                        </a>
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error fetching orders:', error);
            document.getElementById('ordersContainer').innerHTML = `
                <div class="empty-state">
                    <i class="fas fa-exclamation-triangle"></i>
                    <h3>Unable to load orders</h3>
                    <p>Please refresh the page to try again</p>
                </div>
            `;
        });

        function getStatusClass(status) {
            if (!status) return 'status-pending';

            const statusLower = status.toLowerCase();
            if (statusLower.includes('completed') || statusLower.includes('delivered')) {
                return 'status-completed';
            } else if (statusLower.includes('processing') || statusLower.includes('shipped')) {
                return 'status-processing';
            } else if (statusLower.includes('canceled') || statusLower.includes('cancelled')) {
                return 'status-canceled';
            }
            return 'status-pending';
        }
    </script>
</body>
</html>
