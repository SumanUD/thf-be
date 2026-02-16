@inject ('reviewHelper', 'Webkul\Product\Helpers\Review')
@inject ('productViewHelper', 'Webkul\Product\Helpers\View')

@php
    $avgRatings = $reviewHelper->getAverageRating($product);
    $percentageRatings = $reviewHelper->getPercentageRating($product);
    $customAttributeValues = $productViewHelper->getAdditionalData($product);
    $attributeData = collect($customAttributeValues)->filter(fn ($item) => ! empty($item['value']));
    $productBaseImage = product_image()->getProductBaseImage($product);
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $product->name }} | The HazleNut Factory</title>

    <!-- SEO Meta -->
    <meta name="description" content="{{ trim($product->meta_description) != '' ? $product->meta_description : \Illuminate\Support\Str::limit(strip_tags($product->description), 120, '') }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">

    <!-- Open Graph -->
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name }}">
    <meta property="og:image" content="{{ $productBaseImage['medium_image_url'] }}">
    <meta property="og:description" content="{!! htmlspecialchars(trim(strip_tags($product->description))) !!}">
    <meta property="og:url" content="{{ route('shop.product_or_category.index', $product->url_key) }}">

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
        }

        /* Main Container */
        .product-container {
            max-width: 1400px;
            margin: 120px auto 60px;
            padding: 0 40px;
        }

        /* Breadcrumb */
        .breadcrumb {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
        }

        .breadcrumb a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb a:hover {
            color: #d4af37;
        }

        /* Product Grid */
        .product-detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            margin-bottom: 80px;
        }

        /* Image Gallery */
        .product-gallery {
            position: sticky;
            top: 100px;
        }

        .main-image {
            width: 100%;
            height: 600px;
            border-radius: 16px;
            overflow: hidden;
            background: rgba(20, 20, 20, 0.9);
            border: 1px solid rgba(212, 175, 55, 0.2);
            margin-bottom: 20px;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-gallery {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .thumbnail {
            height: 120px;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s;
        }

        .thumbnail.active,
        .thumbnail:hover {
            border-color: #d4af37;
        }

        .thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Product Info */
        .product-info h1 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 15px;
            color: #fff;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .stars {
            display: flex;
            gap: 5px;
            color: #d4af37;
        }

        .rating-text {
            color: rgba(255, 255, 255, 0.6);
        }

        .product-price {
            font-size: 2.2rem;
            color: #d4af37;
            font-weight: 600;
            margin: 25px 0;
        }

        .product-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1.05rem;
        }

        /* Add to Cart Section */
        .add-to-cart-section {
            background: rgba(20, 20, 20, 0.8);
            padding: 30px;
            border-radius: 16px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            margin-bottom: 30px;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .quantity-label {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.05rem;
        }

        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(10, 10, 10, 0.9);
            padding: 8px 15px;
            border-radius: 10px;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .quantity-btn {
            background: none;
            border: none;
            color: #d4af37;
            font-size: 1.3rem;
            cursor: pointer;
            padding: 5px 10px;
            transition: transform 0.2s;
        }

        .quantity-btn:hover {
            transform: scale(1.2);
        }

        .quantity-input {
            background: none;
            border: none;
            color: #fff;
            width: 50px;
            text-align: center;
            font-size: 1.1rem;
            font-family: "Forum", serif;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
        }

        .btn-add-cart {
            flex: 1;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #0a0a0a;
            border: none;
            padding: 16px 32px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            font-family: "Forum", serif;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.4);
        }

        .btn-wishlist {
            background: transparent;
            border: 2px solid rgba(212, 175, 55, 0.5);
            color: #d4af37;
            padding: 16px 24px;
            border-radius: 12px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-wishlist:hover {
            background: rgba(212, 175, 55, 0.15);
            border-color: #d4af37;
        }

        /* Product Details Tabs */
        .product-tabs {
            margin-top: 60px;
        }

        .tab-buttons {
            display: flex;
            gap: 5px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            margin-bottom: 30px;
        }

        .tab-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            padding: 15px 30px;
            cursor: pointer;
            font-size: 1.05rem;
            font-family: "Forum", serif;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .tab-btn.active {
            color: #d4af37;
            border-bottom-color: #d4af37;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .specs-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .spec-item {
            display: flex;
            justify-content: space-between;
            padding: 15px;
            background: rgba(20, 20, 20, 0.6);
            border-radius: 10px;
        }

        .spec-label {
            color: rgba(255, 255, 255, 0.6);
        }

        .spec-value {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .product-detail-grid {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .product-gallery {
                position: static;
            }

            .main-image {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            .product-container {
                margin-top: 100px;
                padding: 0 20px;
            }

            .product-info h1 {
                font-size: 2rem;
            }

            .action-buttons {
                flex-direction: column;
            }

            .specs-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <div class="product-container">
        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="{{ route('shop.home.index') }}">Home</a>
            <span>/</span>
            <a href="#">Products</a>
            <span>/</span>
            <span>{{ $product->name }}</span>
        </div>

        <!-- Product Detail Grid -->
        <div class="product-detail-grid">
            <!-- Image Gallery -->
            <div class="product-gallery">
                <div class="main-image">
                    <img src="{{ $productBaseImage['large_image_url'] }}" alt="{{ $product->name }}" id="mainImage">
                </div>
                <div class="thumbnail-gallery">
                    @foreach($product->images as $index => $image)
                    <div class="thumbnail {{ $index == 0 ? 'active' : '' }}" onclick="changeImage('{{ $image->url }}', this)">
                        <img src="{{ $image->url }}" alt="{{ $product->name }}">
                    </div>
                    @endforeach
                    @if($product->images->count() == 0)
                    <div class="thumbnail active">
                        <img src="{{ $productBaseImage['medium_image_url'] }}" alt="{{ $product->name }}">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="product-info">
                <h1>{{ $product->name }}</h1>

                <div class="product-rating">
                    <div class="stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($avgRatings))
                                <i class="fas fa-star"></i>
                            @elseif($i == ceil($avgRatings) && $avgRatings - floor($avgRatings) >= 0.5)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-text">({{ $avgRatings }} / 5)</span>
                </div>

                <div class="product-price">
                    {!! $product->getTypeInstance()->getPriceHtml() !!}
                </div>

                <div class="product-description">
                    {!! $product->description !!}
                </div>

                <!-- Add to Cart Section -->
                <div class="add-to-cart-section">
                    <form action="{{ route('shop.api.checkout.cart.store') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="quantity-selector">
                            <span class="quantity-label">Quantity:</span>
                            <div class="quantity-controls">
                                <button type="button" class="quantity-btn" onclick="decreaseQty()">-</button>
                                <input type="number" name="quantity" value="1" min="1" max="99" class="quantity-input" id="quantity">
                                <button type="button" class="quantity-btn" onclick="increaseQty()">+</button>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <button type="submit" class="btn-add-cart">
                                <i class="fas fa-shopping-cart"></i> Add to Cart
                            </button>
                            <button type="button" class="btn-wishlist" onclick="addToWishlist({{ $product->id }})">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Product Tabs -->
                <div class="product-tabs">
                    <div class="tab-buttons">
                        <button class="tab-btn active" onclick="openTab('details')">Details</button>
                        <button class="tab-btn" onclick="openTab('specifications')">Specifications</button>
                    </div>

                    <div id="details" class="tab-content active">
                        <div class="product-description">
                            {!! $product->short_description !!}
                        </div>
                    </div>

                    <div id="specifications" class="tab-content">
                        <div class="specs-grid">
                            @foreach($attributeData as $attribute)
                            <div class="spec-item">
                                <span class="spec-label">{{ $attribute['label'] }}</span>
                                <span class="spec-value">{{ $attribute['value'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include("shop::partials.thf-footer")

    <script>
        // Image Gallery
        function changeImage(imageUrl, thumbnail) {
            document.getElementById('mainImage').src = imageUrl;
            document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
            thumbnail.classList.add('active');
        }

        // Quantity Controls
        function increaseQty() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
        }

        function decreaseQty() {
            const input = document.getElementById('quantity');
            if (parseInt(input.value) > 1) {
                input.value = parseInt(input.value) - 1;
            }
        }

        // Tabs
        function openTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }

        // Add to Cart
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const data = {};
            formData.forEach((value, key) => data[key] = value);

            fetch(this.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.data || data.message) {
                    alert('Added to cart successfully!');
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to add to cart');
            });
        });

        // Add to Wishlist
        function addToWishlist(productId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/api/customers/account/wishlist', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                alert('Added to wishlist!');
            })
            .catch(error => {
                alert('Please sign in to add to wishlist');
            });
        }
    </script>
</body>
</html>
