@php
    $customer = auth()->guard('customer')->user();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile | The HazleNut Factory</title>

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

        /* Main Container */
        .profile-container {
            max-width: 1200px;
            margin: 120px auto 60px;
            padding: 0 40px;
        }

        /* Profile Header */
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

        /* Profile Grid */
        .profile-grid {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }

        @media (max-width: 992px) {
            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar Navigation */
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

        /* Profile Content */
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

        .edit-button {
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
            transition: all 0.3s ease;
        }

        .edit-button:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.3), rgba(180, 150, 50, 0.3));
            border-color: #d4af37;
            transform: translateY(-2px);
        }

        /* Profile Info Grid */
        .info-grid {
            display: grid;
            gap: 25px;
        }

        .info-row {
            display: grid;
            grid-template-columns: 200px 1fr;
            padding: 20px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.08);
            transition: all 0.3s ease;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-row:hover {
            background: rgba(212, 175, 55, 0.05);
            border-radius: 8px;
        }

        @media (max-width: 768px) {
            .info-row {
                grid-template-columns: 1fr;
                gap: 8px;
            }
        }

        .info-label {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 400;
        }

        .info-value {
            font-size: 1.05rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Delete Account Section */
        .danger-zone {
            margin-top: 50px;
            padding: 30px;
            background: rgba(139, 0, 0, 0.1);
            border: 1px solid rgba(220, 53, 69, 0.3);
            border-radius: 12px;
        }

        .danger-zone h3 {
            color: #dc3545;
            margin-bottom: 15px;
            font-size: 1.3rem;
            font-weight: 400;
        }

        .danger-zone p {
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .delete-button {
            background: rgba(220, 53, 69, 0.2);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #dc3545;
            padding: 12px 24px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            font-family: "Forum", serif;
            transition: all 0.3s ease;
        }

        .delete-button:hover {
            background: rgba(220, 53, 69, 0.3);
            border-color: #dc3545;
        }

        /* Modal Styles */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: rgba(18, 18, 18, 0.98);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 16px;
            padding: 40px;
            max-width: 500px;
            width: 90%;
        }

        .modal-header {
            margin-bottom: 25px;
        }

        .modal-header h2 {
            font-size: 1.8rem;
            color: #fff;
            font-weight: 400;
        }

        .modal-body {
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-group input {
            width: 100%;
            padding: 14px 18px;
            background: rgba(10, 10, 10, 0.8);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            color: #fff;
            font-family: "Forum", serif;
            font-size: 1rem;
        }

        .form-group input:focus {
            outline: none;
            border-color: #d4af37;
        }

        .modal-footer {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
        }

        .modal-button {
            padding: 12px 24px;
            border-radius: 10px;
            font-family: "Forum", serif;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .modal-button.cancel {
            background: transparent;
            border: 1px solid rgba(212, 175, 55, 0.3);
            color: rgba(255, 255, 255, 0.7);
        }

        .modal-button.cancel:hover {
            border-color: rgba(212, 175, 55, 0.5);
            color: #d4af37;
        }

        .modal-button.confirm {
            background: rgba(220, 53, 69, 0.3);
            border: 1px solid rgba(220, 53, 69, 0.5);
            color: #dc3545;
        }

        .modal-button.confirm:hover {
            background: rgba(220, 53, 69, 0.4);
            border-color: #dc3545;
        }

        /* Responsive */
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
        }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <h1>My Account</h1>
            <p>Manage your profile and preferences</p>
        </div>

        <!-- Profile Grid -->
        <div class="profile-grid">
            <!-- Sidebar Navigation -->
            <aside class="profile-sidebar">
                <h3 class="profile-nav-title">Account Menu</h3>
                <nav>
                    <ul class="profile-nav-list">
                        <li class="profile-nav-item">
                            <a href="{{ route('shop.customers.account.profile.index') }}"
                                class="profile-nav-link active">
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
                            <a href="{{ route('shop.customers.account.addresses.index') }}" class="profile-nav-link">
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

            <!-- Profile Content -->
            <main class="profile-content">
                <div class="content-header">
                    <h2>Profile Information</h2>
                    <a href="{{ route('shop.customers.account.profile.edit') }}" class="edit-button">
                        <i class="fas fa-edit"></i>
                        <span>Edit Profile</span>
                    </a>
                </div>

                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">First Name</div>
                        <div class="info-value">{{ $customer->first_name }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Last Name</div>
                        <div class="info-value">{{ $customer->last_name }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $customer->email }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Gender</div>
                        <div class="info-value">{{ $customer->gender ?? 'Not specified' }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Date of Birth</div>
                        <div class="info-value">{{ $customer->date_of_birth ?? 'Not specified' }}</div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value">{{ $customer->phone ?? 'Not specified' }}</div>
                    </div>
                </div>

                <!-- Danger Zone -->
                <div class="danger-zone">
                    <h3><i class="fas fa-exclamation-triangle"></i> Danger Zone</h3>
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                    <button type="button" class="delete-button" onclick="openDeleteModal()">
                        <i class="fas fa-trash-alt"></i> Delete My Account
                    </button>
                </div>
            </main>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Delete Account</h2>
            </div>
            <form method="POST" action="{{ route('shop.customers.account.profile.destroy') }}" id="deleteAccountForm">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="password">Enter your password to confirm</label>
                        <input type="password" id="password" name="password" placeholder="Your password" required>
                    </div>
                    <p style="color: rgba(220, 53, 69, 0.8); font-size: 0.95rem; margin-top: 15px;">
                        <i class="fas fa-exclamation-circle"></i> This action cannot be undone. All your data will be
                        permanently deleted.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-button cancel" onclick="closeDeleteModal()">Cancel</button>
                    <button type="submit" class="modal-button confirm">Delete Account</button>
                </div>
            </form>
        </div>
    </div>

    @include("shop::partials.thf-footer")

    <script>
        // Menu Toggle - handled by header.js



        // Delete Modal Functions
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            document.getElementById('password').value = '';
        }

        // Close modal on overlay click
        document.getElementById('deleteModal').addEventListener('click', function (e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && document.getElementById('deleteModal').classList.contains('active')) {
                closeDeleteModal();
            }
        });
    </script>
</body>

</html>