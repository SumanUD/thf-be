<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Order Confirmed | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Forum&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Forum', serif;
        }

        body {
            background: #0a0a0a;
            color: rgba(255, 255, 255, 0.9);
            min-height: 100vh;
        }

        .success-section {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
            padding: 60px 20px;
        }

        .success-card {
            background: rgba(18, 18, 18, 0.95);
            border: 1px solid rgba(212, 175, 55, 0.2);
            border-radius: 20px;
            padding: 70px 50px;
            max-width: 700px;
            width: 100%;
            text-align: center;
            backdrop-filter: blur(10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            position: relative;
        }

        .success-icon svg {
            width: 100%;
            height: 100%;
        }

        .success-icon .bag {
            fill: rgba(212, 175, 55, 0.3);
            stroke: #d4af37;
            stroke-width: 1.5;
        }

        .success-icon .handle {
            fill: none;
            stroke: #d4af37;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .success-icon .check {
            fill: none;
            stroke: #d4af37;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .order-id {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 15px;
            letter-spacing: 0.5px;
        }

        .order-id a {
            color: #d4af37;
            text-decoration: underline;
            transition: color 0.2s;
        }

        .order-id a:hover {
            color: #e5c349;
        }

        .thank-you {
            color: #d4af37;
            font-size: 2.5rem;
            font-weight: 400;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        .info-text {
            color: rgba(255, 255, 255, 0.6);
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .continue-btn {
            display: inline-block;
            background: linear-gradient(135deg, #d4af37 0%, #b8962e 100%);
            color: #000;
            text-decoration: none;
            padding: 16px 50px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            font-family: 'Forum', serif;
        }

        .continue-btn:hover {
            background: linear-gradient(135deg, #e5c349 0%, #d4af37 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(212, 175, 55, 0.4);
            color: #000;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .success-card {
                padding: 40px 25px;
            }

            .thank-you {
                font-size: 1.8rem;
            }

            .success-icon {
                width: 90px;
                height: 90px;
            }
        }
    </style>
</head>
<body>
    @include('shop::partials.thf-header')

    <section class="success-section">
        <div class="success-card">
            <div class="success-icon">
                <svg viewBox="0 0 100 100">
                    <path class="bag" d="M20 35 L15 90 Q15 95 20 95 L80 95 Q85 95 85 90 L80 35 Z"/>
                    <path class="handle" d="M35 35 L35 25 Q35 10 50 10 Q65 10 65 25 L65 35"/>
                    <path class="check" d="M35 60 L45 72 L65 48"/>
                </svg>
            </div>

            <p class="order-id">
                @if (auth()->guard('customer')->user())
                    Your order id is #<a href="{{ route('shop.customers.account.orders.view', $order->id) }}">{{ $order->increment_id }}</a>
                @else
                    Your order id is #{{ $order->increment_id }}
                @endif
            </p>

            <h1 class="thank-you">Thank you for your order!</h1>

            <p class="info-text">
                @if (! empty($order->checkout_message))
                    {!! nl2br($order->checkout_message) !!}
                @else
                    We will email you, your order details and tracking information
                @endif
            </p>

            <a href="{{ route('shop.home.index') }}" class="continue-btn">
                Continue Shopping
            </a>
        </div>
    </section>

    @include('shop::partials.thf-footer')
</body>
</html>
