@php
    $customer = auth()->guard('customer')->user();
    $addresses = $customer->addresses;
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Addresses | The HazleNut Factory</title>

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

        .add-address-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.2), rgba(180, 150, 50, 0.2));
            border: 1px solid rgba(212, 175, 55, 0.5);
            color: #d4af37;
            padding: 12px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 1rem;
            font-family: "Forum", serif;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .add-address-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(180, 150, 50, 0.3));
            border-color: #d4af37;
            transform: translateY(-2px);
        }

        /* Address Cards */
        .address-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .address-card {
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.15);
            border-radius: 12px;
            padding: 25px;
            transition: all 0.3s ease;
            position: relative;
        }

        .address-card:hover {
            border-color: rgba(212, 175, 55, 0.4);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .address-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .address-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: #fff;
        }

        .address-company {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.95rem;
            margin-top: 4px;
        }

        .default-badge {
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
            white-space: nowrap;
        }

        .address-details {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .address-details .detail-row {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 8px;
        }

        .address-details .detail-row i {
            color: rgba(212, 175, 55, 0.6);
            margin-top: 4px;
            width: 16px;
            flex-shrink: 0;
        }

        .address-phone {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            margin-bottom: 20px;
        }

        .address-phone i {
            color: rgba(212, 175, 55, 0.6);
        }

        .address-actions {
            display: flex;
            gap: 10px;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
            padding-top: 15px;
        }

        .address-action-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-family: "Forum", serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
        }

        .address-action-btn.edit {
            background: rgba(212, 175, 55, 0.1);
            color: #d4af37;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .address-action-btn.edit:hover {
            background: rgba(212, 175, 55, 0.2);
            border-color: #d4af37;
        }

        .address-action-btn.delete {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }

        .address-action-btn.delete:hover {
            background: rgba(220, 53, 69, 0.2);
            border-color: #dc3545;
        }

        .address-action-btn.default {
            background: rgba(76, 175, 80, 0.1);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .address-action-btn.default:hover {
            background: rgba(76, 175, 80, 0.2);
            border-color: #4caf50;
        }

        /* Empty State */
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

            .content-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .address-grid {
                grid-template-columns: 1fr;
            }

            .address-actions {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <div class="profile-container">
        <div class="profile-header">
            <h1>My Addresses</h1>
            <p>Manage your saved delivery addresses</p>
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
                                <a href="{{ route('shop.customers.account.wishlist.index') }}" class="profile-nav-link">
                                    <i class="fas fa-heart"></i>
                                    <span>Wishlist</span>
                                </a>
                            </li>
                        @endif
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.addresses.index') }}"
                                class="profile-nav-link active">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Addresses</span>
                            </a>
                        </li>
                        <li class="profile-nav-item">
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('customerLogout').submit();"
                                class="profile-nav-link">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <form id="customerLogout" method="POST" action="{{ route('shop.customer.session.destroy') }}"
                    style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </aside>

            <main class="profile-content">
                <div class="content-header">
                    <h2>Saved Addresses</h2>
                    <a href="{{ route('shop.customers.account.addresses.create') }}" class="add-address-btn">
                        <i class="fas fa-plus"></i>
                        <span>Add New Address</span>
                    </a>
                </div>

                @if (!$addresses->isEmpty())
                    <div class="address-grid">
                        @foreach ($addresses as $address)
                            <div class="address-card">
                                <div class="address-card-header">
                                    <div>
                                        <div class="address-name">{{ $address->first_name }} {{ $address->last_name }}</div>
                                        @if ($address->company_name)
                                            <div class="address-company">{{ $address->company_name }}</div>
                                        @endif
                                    </div>
                                    @if ($address->default_address)
                                        <span class="default-badge"><i class="fas fa-check-circle"></i> Default</span>
                                    @endif
                                </div>

                                <div class="address-details">
                                    <div class="detail-row">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $address->address }}, {{ $address->city }}, {{ $address->state }},
                                            {{ $address->country }}, {{ $address->postcode }}</span>
                                    </div>
                                </div>

                                @if ($address->phone)
                                    <div class="address-phone">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $address->phone }}</span>
                                    </div>
                                @endif

                                <div class="address-actions">
                                    <a href="{{ route('shop.customers.account.addresses.edit', $address->id) }}"
                                        class="address-action-btn edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form method="POST"
                                        action="{{ route('shop.customers.account.addresses.delete', $address->id) }}"
                                        id="delete-address-{{ $address->id }}" style="display: none;">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <button class="address-action-btn delete"
                                        onclick="if(confirm('Are you sure you want to delete this address?')) document.getElementById('delete-address-{{ $address->id }}').submit();">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>

                                    @if (!$address->default_address)
                                        <form method="POST"
                                            action="{{ route('shop.customers.account.addresses.update.default', $address->id) }}"
                                            id="default-address-{{ $address->id }}" style="display: none;">
                                            @method('PATCH')
                                            @csrf
                                        </form>
                                        <button class="address-action-btn default"
                                            onclick="document.getElementById('default-address-{{ $address->id }}').submit();">
                                            <i class="fas fa-star"></i> Set Default
                                        </button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-map-marker-alt"></i>
                        <h3>No addresses saved yet</h3>
                        <p>Add your delivery addresses to make checkout faster</p>
                        <a href="{{ route('shop.customers.account.addresses.create') }}" class="shop-button">
                            <i class="fas fa-plus"></i>
                            <span>Add New Address</span>
                        </a>
                    </div>
                @endif
            </main>
        </div>
    </div>

    @include("shop::partials.thf-footer")

    <script>
        // Menu Toggle - handled by header.js
    </script>
</body>

</html>