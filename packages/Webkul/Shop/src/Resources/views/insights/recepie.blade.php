@php
    $channel = core()->getCurrentChannel();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recipes | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">

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

        /* Navigation Header */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.1);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo img {
            height: 50px;
        }

        .menu-toggle {
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 10px;
            transition: color 0.3s ease;
        }

        .menu-toggle:hover {
            color: #d4af37;
        }

        /* Mega Menu */
        .mega-menu {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, rgba(10, 10, 10, 0.98), rgba(20, 20, 20, 0.95));
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
            backdrop-filter: blur(20px);
        }

        .mega-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mega-panel {
            max-width: 1400px;
            margin: 0 auto;
            padding: 120px 60px 60px;
        }

        .menu-left {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 40px;
        }

        .links-col .col-title {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 25px;
            color: #d4af37;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .links-col ul {
            list-style: none;
        }

        .links-col ul li {
            margin-bottom: 15px;
        }

        .links-col ul li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 1rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .links-col ul li a:hover {
            color: #d4af37;
            transform: translateX(5px);
        }

        .header-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .header-center img {
            height: 30px;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }

        .nav-link:hover {
            color: #d4af37;
        }

        /* HERO BANNER */
        .hero-banner {
            width: 100%;
            height: 400px;
            background:
                linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)),
                url('{{ asset("thf-assets/images/recipe-banner.jpg") }}') center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            margin-top: 80px;
        }

        .hero-content {
            position: relative;
            z-index: 3;
            color: white;
            max-width: 800px;
            padding: 0 40px;
            animation: fadeInUp 1.2s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 300;
            letter-spacing: -1.5px;
            margin-bottom: 16px;
            text-transform: uppercase;
            line-height: 1.1;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            position: relative;
            padding-bottom: 20px;
        }

        .hero-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 1px;
            background: linear-gradient(90deg, transparent, #d4af37, transparent);
        }

        .hero-sub {
            font-size: 1.3rem;
            opacity: 0.85;
            font-weight: 300;
            letter-spacing: 0.5px;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* MAIN CONTAINER */
        .container {
            max-width: 1200px;
            margin: -80px auto 60px;
            padding: 0 40px;
            position: relative;
            z-index: 5;
        }

        /* FLOATING CARD */
        .floating-card {
            background: rgba(15, 15, 15, 0.85);
            padding: 50px;
            border-radius: 24px;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.15);
            box-shadow:
                0 25px 60px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.05);
            animation: cardFloatUp 0.9s cubic-bezier(0.4, 0, 0.2, 1) 0.3s both;
        }

        @keyframes cardFloatUp {
            from { opacity: 0; transform: translateY(60px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* RECIPES HEADER */
        .recipes-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .recipes-header h1 {
            font-size: 2.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }

        .recipes-header h1::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 2px;
            background: #d4af37;
        }

        .recipes-header p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* RECIPE CATEGORIES */
        .recipe-categories {
            display: flex;
            gap: 15px;
            margin-bottom: 50px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .category-btn {
            padding: 12px 28px;
            background: rgba(20, 20, 20, 0.7);
            border: 1px solid rgba(212, 175, 55, 0.2);
            color: rgba(255, 255, 255, 0.8);
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "Forum", serif;
            font-size: 1rem;
        }

        .category-btn:hover {
            background: rgba(212, 175, 55, 0.1);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .category-btn.active {
            background: rgba(212, 175, 55, 0.15);
            border-color: #d4af37;
            color: #d4af37;
        }

        /* FEATURED RECIPE */
        .featured-recipe {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            margin-bottom: 60px;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .featured-recipe:hover {
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .featured-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        @media (max-width: 992px) {
            .featured-content {
                grid-template-columns: 1fr;
            }
        }

        .featured-image {
            height: 100%;
            min-height: 500px;
            overflow: hidden;
            position: relative;
        }

        .featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .featured-recipe:hover .featured-image img {
            transform: scale(1.05);
        }

        .featured-text {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .featured-badge {
            display: inline-block;
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 20px;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .featured-title {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .featured-description {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 25px;
            line-height: 1.7;
        }

        .recipe-meta {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            background: rgba(10, 10, 10, 0.5);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .meta-item {
            text-align: center;
        }

        .meta-icon {
            width: 50px;
            height: 50px;
            background: rgba(212, 175, 55, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            color: #d4af37;
            font-size: 1.3rem;
            border: 1px solid rgba(212, 175, 55, 0.2);
        }

        .meta-label {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .meta-value {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .view-recipe-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
            padding: 14px 32px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            align-self: flex-start;
            font-family: "Forum", serif;
        }

        .view-recipe-btn:hover {
            background: linear-gradient(135deg, rgba(212, 175, 55, 1), rgba(180, 150, 50, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.3);
        }

        /* RECIPE GRID */
        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 40px;
            margin-bottom: 60px;
        }

        .recipe-card {
            background: rgba(20, 20, 20, 0.7);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
        }

        .recipe-card:hover {
            transform: translateY(-10px);
            border-color: rgba(212, 175, 55, 0.3);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .recipe-card-image {
            height: 240px;
            overflow: hidden;
            position: relative;
        }

        .recipe-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .recipe-card:hover .recipe-card-image img {
            transform: scale(1.1);
        }

        .recipe-card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            background: rgba(212, 175, 55, 0.15);
            color: #d4af37;
            padding: 6px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            border: 1px solid rgba(212, 175, 55, 0.3);
        }

        .recipe-card-content {
            padding: 30px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .recipe-card-title {
            font-size: 1.5rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.4;
        }

        .recipe-card-description {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1rem;
            margin-bottom: 20px;
            line-height: 1.6;
            flex: 1;
        }

        .recipe-card-meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
            background: rgba(10, 10, 10, 0.5);
            padding: 15px;
            border-radius: 10px;
        }

        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .card-meta-item i {
            color: #d4af37;
            width: 16px;
        }

        .recipe-card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .recipe-card-link {
            color: #d4af37;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .recipe-card-link:hover {
            color: #fff;
            transform: translateX(5px);
        }

        .difficulty {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.9rem;
            padding: 6px 15px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
        }

        /* RECIPE DETAILS MODAL */
        .recipe-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            backdrop-filter: blur(20px);
            overflow-y: auto;
            padding: 40px 20px;
        }

        .recipe-modal.active {
            display: flex;
        }

        .recipe-modal-content {
            background: rgba(15, 15, 15, 0.95);
            border-radius: 24px;
            width: 90%;
            max-width: 900px;
            border: 1px solid rgba(212, 175, 55, 0.2);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: modalSlideUp 0.4s ease;
        }

        @keyframes modalSlideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            color: #d4af37;
            font-size: 1.2rem;
            cursor: pointer;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .modal-close:hover {
            background: rgba(212, 175, 55, 0.2);
            transform: rotate(90deg);
        }

        .modal-header {
            height: 300px;
            position: relative;
            overflow: hidden;
        }

        .modal-header img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .modal-body {
            padding: 40px;
        }

        .modal-title {
            font-size: 2.5rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .modal-meta-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 40px;
            background: rgba(10, 10, 10, 0.5);
            padding: 25px;
            border-radius: 15px;
        }

        .modal-description {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
            margin-bottom: 40px;
            line-height: 1.7;
        }

        .recipe-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        @media (max-width: 768px) {
            .recipe-content {
                grid-template-columns: 1fr;
            }
        }

        .ingredients-section, .instructions-section {
            background: rgba(20, 20, 20, 0.5);
            padding: 30px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .section-title {
            font-size: 1.8rem;
            font-weight: 300;
            color: #fff;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 15px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        .ingredients-list {
            list-style: none;
        }

        .ingredients-list li {
            padding: 12px 0;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .ingredients-list li:last-child {
            border-bottom: none;
        }

        .ingredient-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 4px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .ingredient-checkbox.checked {
            background: #d4af37;
            border-color: #d4af37;
            position: relative;
        }

        .ingredient-checkbox.checked::after {
            content: '✓';
            position: absolute;
            color: #000;
            font-size: 12px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .instructions-list {
            list-style: none;
            counter-reset: step-counter;
        }

        .instructions-list li {
            padding: 20px 0 20px 50px;
            color: rgba(255, 255, 255, 0.8);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            position: relative;
            line-height: 1.6;
        }

        .instructions-list li:last-child {
            border-bottom: none;
        }

        .instructions-list li::before {
            counter-increment: step-counter;
            content: counter(step-counter);
            position: absolute;
            left: 0;
            top: 20px;
            width: 35px;
            height: 35px;
            background: rgba(212, 175, 55, 0.1);
            border: 1px solid rgba(212, 175, 55, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
            font-weight: 500;
        }

        .modal-footer {
            padding: 30px 40px;
            background: rgba(10, 10, 10, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .print-btn, .share-btn {
            padding: 12px 28px;
            border-radius: 12px;
            border: none;
            font-family: "Forum", serif;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .print-btn {
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.9), rgba(180, 150, 50, 0.9));
            color: #000;
        }

        .share-btn {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .print-btn:hover, .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(212, 175, 55, 0.2);
        }

        /* SEASONAL RECIPES */
        .seasonal-section {
            margin-top: 80px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .section-header h2 {
            font-size: 2.2rem;
            font-weight: 300;
            color: #fff;
            position: relative;
            padding-bottom: 15px;
        }

        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: #d4af37;
        }

        .view-all-btn {
            color: #d4af37;
            text-decoration: none;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .view-all-btn:hover {
            color: #fff;
            transform: translateX(5px);
        }

        /* Footer */
        .footer {
            background: rgba(10, 10, 10, 0.95);
            padding: 60px 40px 30px;
            border-top: 1px solid rgba(212, 175, 55, 0.1);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            color: #d4af37;
            font-size: 1.2rem;
            margin-bottom: 20px;
            font-weight: 400;
        }

        .footer-section a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .footer-section a:hover {
            color: #d4af37;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.5);
        }

        /* RESPONSIVE */
        @media (max-width: 1200px) {
            .container {
                max-width: 100%;
            }
        }

        @media (max-width: 992px) {
            .menu-left {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .recipe-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
            
            .modal-meta-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 15px 20px;
            }

            .header-right {
                display: none;
            }

            .container {
                padding: 0 20px;
                margin-top: -60px;
            }

            .floating-card {
                padding: 30px;
            }

            .hero-banner {
                height: 350px;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .recipe-grid {
                grid-template-columns: 1fr;
            }

            .featured-title {
                font-size: 1.8rem;
            }

            .featured-text {
                padding: 30px;
            }

            .recipe-meta {
                grid-template-columns: repeat(2, 1fr);
            }

            .modal-body {
                padding: 30px 20px;
            }

            .modal-title {
                font-size: 2rem;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }

        @media (max-width: 576px) {
            .menu-left {
                grid-template-columns: 1fr;
            }

            .mega-panel {
                padding: 100px 30px 40px;
            }

            .recipe-categories {
                flex-direction: column;
                align-items: stretch;
            }

            .category-btn {
                text-align: center;
            }

            .featured-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .recipe-card-meta {
                grid-template-columns: 1fr;
            }

            .modal-footer {
                flex-direction: column;
                align-items: stretch;
            }

            .print-btn, .share-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Header -->
    <header class="header">
        <div class="header-left">
            <a href="{{ route('shop.home.index') }}" class="logo">
                <img src="{{ asset('thf-assets/images/logo-transparent-white.png') }}" alt="THF Logo">
            </a>
            <div class="menu-toggle">
                <i class="fas fa-bars"></i>
            </div>
        </div>

        <div class="header-center">
            <a href="{{ route('shop.home.index') }}">
                <img src="{{ asset('thf-assets/images/name-logo.png') }}" alt="The Hazlenut Factory">
            </a>
        </div>

        <div class="header-right">
            <a href="{{ route('shop.search.index') }}" class="nav-link">SHOP</a>
            <a href="{{ route('shop.insights.blogs') }}" class="nav-link">BLOG</a>
            <a href="{{ route('shop.insights.recepie') }}" class="nav-link" style="color: #d4af37;">RECIPES</a>
            <a href="{{ route('shop.store-locator.index') }}" class="nav-link">STORES</a>
            <a href="{{ route('shop.faq.faq-index') }}" class="nav-link">FAQS</a>
            @guest('customer')
                <a href="{{ route('shop.customer.session.create') }}" class="nav-link">SIGN IN</a>
            @else
                <a href="{{ route('shop.customers.account.profile.index') }}" class="nav-link">MY ACCOUNT</a>
            @endguest
        </div>
    </header>

    <!-- Mega Menu -->
    <nav class="mega-menu">
        <div class="mega-panel">
            <div class="menu-left">
                <div class="links-col">
                    <div class="col-title">Sweets</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Baklava</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Labon</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Dates</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Mewabite</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Assorted Collection</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Collections</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Luxury Gifting</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Premium Coffee</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Merchandise</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Corporate Gifting</a></li>
                        <li><a href="#">Gifting Brochures</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Seasonal</div>
                    <ul>
                        <li><a href="{{ route('shop.collection.index') }}">Festive Hampers</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Diwali Specials</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Eid Collection</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">Christmas Treats</a></li>
                        <li><a href="{{ route('shop.collection.index') }}">New Year Gifting</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Corporate</div>
                    <ul>
                        <li><a href="{{ route('shop.corporate.index') }}">Bulk Orders</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Custom Branding</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Employee Gifting</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Client Appreciation</a></li>
                        <li><a href="{{ route('shop.corporate.index') }}">Corporate Catalog</a></li>
                    </ul>
                </div>

                <div class="links-col">
                    <div class="col-title">Services & Info</div>
                    <ul>
                        <li><a href="{{ route('shop.insights.recepie') }}">Recipes</a></li>
                        <li><a href="{{ route('shop.insights.blogs') }}">Blog</a></li>
                        <li><a href="{{ route('shop.career.career-index') }}">Careers</a></li>
                        <li><a href="#">JalGhar</a></li>
                        <li><a href="{{ route('shop.contact.contact-index') }}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">Sweet Recipes</div>
            <div class="hero-sub">Create magical moments in your kitchen with our curated collection of premium dessert recipes. From traditional sweets to modern treats, inspired by The HazleNut Factory.</div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container">
        <div class="floating-card">
            <!-- Recipes Header -->
            <div class="recipes-header">
                <h1>Premium Dessert Recipes</h1>
                <p>Discover recipes that bring the taste of THF to your home. Each recipe features our signature ingredients and techniques.</p>
            </div>

            <!-- Recipe Categories -->
            <div class="recipe-categories">
                <button class="category-btn active" data-category="all">All Recipes</button>
                <button class="category-btn" data-category="festive">Festive Specials</button>
                <button class="category-btn" data-category="traditional">Traditional Sweets</button>
                <button class="category-btn" data-category="modern">Modern Desserts</button>
                <button class="category-btn" data-category="quick">Quick Treats</button>
                <button class="category-btn" data-category="healthy">Healthy Options</button>
                <button class="category-btn" data-category="seasonal">Seasonal Recipes</button>
            </div>

            <!-- Featured Recipe -->
            <div class="featured-recipe" data-category="traditional">
                <div class="featured-content">
                    <div class="featured-image">
                        <img src="{{ asset('thf-assets/images/recipes/featured-baklava.jpg') }}" alt="Premium Baklava">
                    </div>
                    <div class="featured-text">
                        <span class="featured-badge">Chef's Special</span>
                        <h2 class="featured-title">THF Signature Baklava</h2>
                        <p class="featured-description">Our master confectioner reveals the secrets to making restaurant-quality baklava at home. This recipe uses premium Iranian pistachios and 40 layers of hand-stretched phyllo dough.</p>
                        
                        <div class="recipe-meta">
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="far fa-clock"></i>
                                </div>
                                <div class="meta-label">Prep Time</div>
                                <div class="meta-value">45 mins</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-fire"></i>
                                </div>
                                <div class="meta-label">Cook Time</div>
                                <div class="meta-value">35 mins</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="meta-label">Servings</div>
                                <div class="meta-value">8-10</div>
                            </div>
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="fas fa-signal"></i>
                                </div>
                                <div class="meta-label">Difficulty</div>
                                <div class="meta-value">Advanced</div>
                            </div>
                        </div>
                        
                        <button class="view-recipe-btn" data-recipe="baklava">
                            <i class="fas fa-utensils"></i> View Full Recipe
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recipe Grid -->
            <div class="recipe-grid">
                <!-- Recipe 1 -->
                <div class="recipe-card" data-category="modern">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=800" alt="Date & Nut Truffles">
                        <span class="recipe-card-badge">No Bake</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Date & Nut Energy Truffles</h3>
                        <p class="recipe-card-description">Healthy, no-bake energy balls made with premium dates, nuts, and a hint of cardamom. Perfect for quick energy boosts.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>20 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-leaf"></i>
                                <span>Vegan</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>12 pieces</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Easy</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="date-truffles">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Beginner</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe 2 -->
                <div class="recipe-card" data-category="festive">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1605105526819-bf0d67b86a20?w=800" alt="Diwali Dry Fruit Ladoo">
                        <span class="recipe-card-badge">Festive</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Diwali Dry Fruit Ladoo</h3>
                        <p class="recipe-card-description">Celebrate Diwali with these rich, nutritious ladoos made with 7 types of nuts, dates, and a touch of ghee.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>30 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-fire"></i>
                                <span>15 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>15 pieces</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Medium</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="diwali-ladoo">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Intermediate</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe 3 -->
                <div class="recipe-card" data-category="healthy">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?w=800" alt="Jaggery & Nut Barfi">
                        <span class="recipe-card-badge">Sugar-Free</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Jaggery & Mixed Nut Barfi</h3>
                        <p class="recipe-card-description">A healthier version of traditional barfi using organic jaggery instead of sugar, packed with nuts and seeds.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>25 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-fire"></i>
                                <span>20 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>16 pieces</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Medium</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="jaggery-barfi">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Intermediate</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe 4 -->
                <div class="recipe-card" data-category="quick">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?w=800" alt="Rose & Pistachio Shrikhand">
                        <span class="recipe-card-badge">Quick Dessert</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Rose & Pistachio Shrikhand</h3>
                        <p class="recipe-card-description">Elegant dessert ready in 15 minutes. Greek yogurt infused with rose water and topped with crushed pistachios.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>15 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-ice-cream"></i>
                                <span>Chill 2hrs</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>4 servings</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Easy</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="rose-shrikhand">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Beginner</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe 5 -->
                <div class="recipe-card" data-category="traditional">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1626132647523-66f5bf380027?w=800" alt="Premium Besan Ladoo">
                        <span class="recipe-card-badge">Classic</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Premium Besan Ladoo with Saffron</h3>
                        <p class="recipe-card-description">Elevate the traditional besan ladoo with premium ingredients like aged gram flour and Kashmiri saffron.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>40 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-fire"></i>
                                <span>25 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>20 pieces</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Advanced</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="besan-ladoo">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Expert</span>
                        </div>
                    </div>
                </div>

                <!-- Recipe 6 -->
                <div class="recipe-card" data-category="modern">
                    <div class="recipe-card-image">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=800" alt="Chocolate Date Cake">
                        <span class="recipe-card-badge">Baking</span>
                    </div>
                    <div class="recipe-card-content">
                        <h3 class="recipe-card-title">Flourless Chocolate Date Cake</h3>
                        <p class="recipe-card-description">Rich, moist chocolate cake sweetened naturally with dates. Gluten-free and surprisingly healthy.</p>
                        
                        <div class="recipe-card-meta">
                            <div class="card-meta-item">
                                <i class="far fa-clock"></i>
                                <span>30 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-fire"></i>
                                <span>40 mins</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-users"></i>
                                <span>8 slices</span>
                            </div>
                            <div class="card-meta-item">
                                <i class="fas fa-signal"></i>
                                <span>Medium</span>
                            </div>
                        </div>
                        
                        <div class="recipe-card-footer">
                            <button class="recipe-card-link" data-recipe="chocolate-cake">
                                View Recipe <i class="fas fa-arrow-right"></i>
                            </button>
                            <span class="difficulty">Intermediate</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seasonal Recipes Section -->
            <div class="seasonal-section">
                <div class="section-header">
                    <h2>Winter Special Recipes</h2>
                    <a href="#" class="view-all-btn">
                        View All Seasonal Recipes <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="recipe-grid">
                    <!-- Seasonal Recipe 1 -->
                    <div class="recipe-card" data-category="seasonal">
                        <div class="recipe-card-image">
                            <img src="https://images.unsplash.com/photo-1607532941433-304659e8198a?w=800" alt="Premium Gajar Halwa">
                            <span class="recipe-card-badge">Winter Special</span>
                        </div>
                        <div class="recipe-card-content">
                            <h3 class="recipe-card-title">Red Carrot Halwa with Dry Fruits</h3>
                            <p class="recipe-card-description">Winter's favorite dessert made with red carrots, reduced milk, and topped with silver leaf.</p>
                            
                            <div class="recipe-card-meta">
                                <div class="card-meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>1 hour</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-fire"></i>
                                    <span>45 mins</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>6 servings</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Medium</span>
                                </div>
                            </div>
                            
                            <div class="recipe-card-footer">
                                <button class="recipe-card-link" data-recipe="gajar-halwa">
                                    View Recipe <i class="fas fa-arrow-right"></i>
                                </button>
                                <span class="difficulty">Intermediate</span>
                            </div>
                        </div>
                    </div>

                    <!-- Seasonal Recipe 2 -->
                    <div class="recipe-card" data-category="seasonal">
                        <div class="recipe-card-image">
                            <img src="https://images.unsplash.com/photo-1603569283847-aa295f0d016a?w=800" alt="Saffron Almond Milk">
                            <span class="recipe-card-badge">Warm Drink</span>
                        </div>
                        <div class="recipe-card-content">
                            <h3 class="recipe-card-title">Saffron Almond Milk with Dates</h3>
                            <p class="recipe-card-description">Warm, comforting drink perfect for winter evenings. Packed with nutrition and flavor.</p>
                            
                            <div class="recipe-card-meta">
                                <div class="card-meta-item">
                                    <i class="far fa-clock"></i>
                                    <span>20 mins</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-fire"></i>
                                    <span>10 mins</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>2 servings</span>
                                </div>
                                <div class="card-meta-item">
                                    <i class="fas fa-signal"></i>
                                    <span>Easy</span>
                                </div>
                            </div>
                            
                            <div class="recipe-card-footer">
                                <button class="recipe-card-link" data-recipe="badam-milk">
                                    View Recipe <i class="fas fa-arrow-right"></i>
                                </button>
                                <span class="difficulty">Beginner</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recipe Detail Modal -->
    <div class="recipe-modal" id="recipeModal">
        <div class="recipe-modal-content">
            <button class="modal-close" id="modalClose">
                <i class="fas fa-times"></i>
            </button>
            
            <div class="modal-header">
                <img id="modalImage" src="" alt="Recipe Image">
            </div>
            
            <div class="modal-body">
                <h2 id="modalTitle" class="modal-title"></h2>
                
                <div class="modal-meta-grid" id="modalMeta"></div>
                
                <p id="modalDescription" class="modal-description"></p>
                
                <div class="recipe-content">
                    <div class="ingredients-section">
                        <h3 class="section-title">Ingredients</h3>
                        <ul class="ingredients-list" id="ingredientsList"></ul>
                    </div>
                    
                    <div class="instructions-section">
                        <h3 class="section-title">Instructions</h3>
                        <ol class="instructions-list" id="instructionsList"></ol>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="print-btn" id="printRecipe">
                    <i class="fas fa-print"></i> Print Recipe
                </button>
                <button class="share-btn" id="shareRecipe">
                    <i class="fas fa-share-alt"></i> Share Recipe
                </button>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include("shop::partials.thf-footer")

    <script>
        // Menu Toggle
        const menuToggle = document.querySelector('.menu-toggle');
        const megaMenu = document.querySelector('.mega-menu');

        menuToggle.addEventListener('click', () => {
            megaMenu.classList.toggle('active');
        });

        // Close menu on clicking outside
        document.addEventListener('click', (e) => {
            if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target) && megaMenu.classList.contains('active')) {
                megaMenu.classList.remove('active');
            }
        });

        // Close menu on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                megaMenu.classList.remove('active');
            }
        });

        // Recipe Category Filtering
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                document.querySelectorAll('.category-btn').forEach(btn => {
                    btn.classList.remove('active');
                });
                button.classList.add('active');

                // Filter recipes
                const category = button.getAttribute('data-category');
                const allRecipes = document.querySelectorAll('.recipe-card, .featured-recipe');
                
                allRecipes.forEach(recipe => {
                    if (category === 'all' || recipe.getAttribute('data-category') === category) {
                        recipe.style.display = 'flex';
                        setTimeout(() => {
                            recipe.style.opacity = '1';
                            recipe.style.transform = 'translateY(0)';
                        }, 50);
                    } else {
                        recipe.style.opacity = '0';
                        recipe.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            recipe.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });

        // Recipe Data
        const recipes = {
            'baklava': {
                title: 'THF Signature Baklava',
                image: '{{ asset("thf-assets/images/recipes/featured-baklava.jpg") }}',
                description: 'Our master confectioner reveals the secrets to making restaurant-quality baklava at home. This recipe uses premium Iranian pistachios and 40 layers of hand-stretched phyllo dough, brushed with clarified butter and baked to golden perfection.',
                prepTime: '45 mins',
                cookTime: '35 mins',
                servings: '8-10',
                difficulty: 'Advanced',
                category: 'Traditional Sweets',
                calories: '320 per serving',
                ingredients: [
                    '500g premium phyllo dough',
                    '300g Iranian pistachios, finely chopped',
                    '200g walnuts, finely chopped',
                    '250g unsalted butter, clarified',
                    '1 cup sugar',
                    '1 cup water',
                    '1/2 cup honey',
                    '1 tsp rose water',
                    '1/2 tsp ground cardamom',
                    'Whole pistachios for garnish'
                ],
                instructions: [
                    'Preheat oven to 180°C (350°F). Butter a 9x13 inch baking pan.',
                    'Combine chopped pistachios and walnuts with 2 tablespoons sugar. Set aside.',
                    'Carefully unroll phyllo dough. Keep covered with damp cloth to prevent drying.',
                    'Place one sheet of phyllo in pan, brush lightly with clarified butter. Repeat with 10 sheets.',
                    'Sprinkle 1/3 of nut mixture evenly over phyllo.',
                    'Add 5 more phyllo sheets, brushing each with butter. Add another 1/3 of nuts.',
                    'Repeat with 5 more phyllo sheets and remaining nuts.',
                    'Top with remaining phyllo sheets (about 15-20), brushing each with butter.',
                    'Using sharp knife, cut baklava into diamond or square shapes.',
                    'Bake for 30-35 minutes until golden brown and crisp.',
                    'While baking, make syrup: Combine sugar, water, honey, rose water, and cardamom. Simmer for 10 minutes.',
                    'Pour hot syrup over hot baklava immediately after removing from oven.',
                    'Let cool completely (at least 4 hours) before serving.',
                    'Garnish with whole pistachios before serving.'
                ]
            },
            'date-truffles': {
                title: 'Date & Nut Energy Truffles',
                image: '{{ asset("thf-assets/images/recipes/date-truffles.jpg") }}',
                description: 'Healthy, no-bake energy balls perfect for quick snacks or dessert. These truffles are naturally sweetened with dates and packed with nuts and seeds for energy.',
                prepTime: '20 mins',
                cookTime: '0 mins',
                servings: '12 pieces',
                difficulty: 'Easy',
                category: 'Healthy Options',
                calories: '85 per piece',
                ingredients: [
                    '2 cups pitted dates (premium Medjool)',
                    '1 cup mixed nuts (almonds, walnuts, cashews)',
                    '1/2 cup desiccated coconut',
                    '2 tbsp cocoa powder',
                    '1 tsp vanilla extract',
                    '1/2 tsp cardamom powder',
                    'Pinch of sea salt',
                    'Extra coconut for rolling'
                ],
                instructions: [
                    'Soak dates in warm water for 10 minutes if they are dry. Drain well.',
                    'In food processor, pulse nuts until coarsely chopped. Remove 1/4 cup for topping.',
                    'Add dates, coconut, cocoa powder, vanilla, cardamom, and salt to processor.',
                    'Process until mixture comes together into a sticky dough.',
                    'Take small portions (about 1 tbsp) and roll into balls.',
                    'Roll balls in reserved chopped nuts or extra coconut.',
                    'Place on baking sheet and refrigerate for at least 1 hour to firm up.',
                    'Store in airtight container in refrigerator for up to 2 weeks.'
                ]
            },
            'diwali-ladoo': {
                title: 'Diwali Dry Fruit Ladoo',
                image: '{{ asset("thf-assets/images/recipes/diwali-ladoo.jpg") }}',
                description: 'Celebrate Diwali with these rich, nutritious ladoos that combine 7 types of nuts with dates and a touch of ghee. Perfect for festive gifting.',
                prepTime: '30 mins',
                cookTime: '15 mins',
                servings: '15 pieces',
                difficulty: 'Medium',
                category: 'Festive Specials',
                calories: '150 per piece',
                ingredients: [
                    '1 cup almonds',
                    '1 cup cashews',
                    '1/2 cup walnuts',
                    '1/2 cup pistachios',
                    '1/4 cup pumpkin seeds',
                    '1/4 cup sunflower seeds',
                    '2 tbsp sesame seeds',
                    '15-20 pitted dates',
                    '2 tbsp ghee',
                    '1/4 tsp cardamom powder',
                    'Pinch of saffron strands',
                    'Edible silver leaf for garnish'
                ],
                instructions: [
                    'Dry roast all nuts separately on low heat until fragrant. Let cool completely.',
                    'In food processor, grind nuts to coarse powder (not fine).',
                    'Add dates and pulse until mixture starts to come together.',
                    'Heat ghee in pan, add cardamom and saffron. Pour over nut mixture.',
                    'Mix well until everything is combined and holds shape when pressed.',
                    'Take small portions and roll into smooth ladoos.',
                    'If mixture is dry, add little more ghee. If too sticky, refrigerate for 15 mins.',
                    'Garnish with edible silver leaf.',
                    'Store in airtight container for up to 2 weeks.'
                ]
            }
        };

        // Open Recipe Modal
        document.querySelectorAll('.view-recipe-btn, .recipe-card-link').forEach(button => {
            button.addEventListener('click', function() {
                const recipeId = this.getAttribute('data-recipe');
                const recipe = recipes[recipeId] || recipes['baklava'];
                
                // Update modal content
                document.getElementById('modalTitle').textContent = recipe.title;
                document.getElementById('modalImage').src = recipe.image;
                document.getElementById('modalImage').alt = recipe.title;
                document.getElementById('modalDescription').textContent = recipe.description;
                
                // Update meta grid
                const metaGrid = document.getElementById('modalMeta');
                metaGrid.innerHTML = `
                    <div class="meta-item">
                        <div class="meta-icon"><i class="far fa-clock"></i></div>
                        <div class="meta-label">Prep Time</div>
                        <div class="meta-value">${recipe.prepTime}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon"><i class="fas fa-fire"></i></div>
                        <div class="meta-label">Cook Time</div>
                        <div class="meta-value">${recipe.cookTime}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon"><i class="fas fa-users"></i></div>
                        <div class="meta-label">Servings</div>
                        <div class="meta-value">${recipe.servings}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon"><i class="fas fa-signal"></i></div>
                        <div class="meta-label">Difficulty</div>
                        <div class="meta-value">${recipe.difficulty}</div>
                    </div>
                `;
                
                // Update ingredients
                const ingredientsList = document.getElementById('ingredientsList');
                ingredientsList.innerHTML = '';
                recipe.ingredients.forEach(ingredient => {
                    const li = document.createElement('li');
                    li.innerHTML = `
                        <span class="ingredient-checkbox"></span>
                        <span class="ingredient-text">${ingredient}</span>
                    `;
                    ingredientsList.appendChild(li);
                });
                
                // Update instructions
                const instructionsList = document.getElementById('instructionsList');
                instructionsList.innerHTML = '';
                recipe.instructions.forEach(instruction => {
                    const li = document.createElement('li');
                    li.textContent = instruction;
                    instructionsList.appendChild(li);
                });
                
                // Show modal
                document.getElementById('recipeModal').classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        // Close Modal
        document.getElementById('modalClose').addEventListener('click', closeModal);
        
        // Close modal on outside click
        document.getElementById('recipeModal').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && document.getElementById('recipeModal').classList.contains('active')) {
                closeModal();
            }
        });
        
        function closeModal() {
            document.getElementById('recipeModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Ingredient Checklist
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('ingredient-checkbox')) {
                e.target.classList.toggle('checked');
            }
        });

        // Print Recipe
        document.getElementById('printRecipe').addEventListener('click', function() {
            const recipeTitle = document.getElementById('modalTitle').textContent;
            alert(`Printing recipe: ${recipeTitle}\n\nIn a real implementation, this would open the print dialog with formatted recipe.`);
        });

        // Share Recipe
        document.getElementById('shareRecipe').addEventListener('click', function() {
            const recipeTitle = document.getElementById('modalTitle').textContent;
            if (navigator.share) {
                navigator.share({
                    title: recipeTitle,
                    text: `Check out this amazing recipe from The HazleNut Factory: ${recipeTitle}`,
                    url: window.location.href
                });
            } else {
                alert(`Share recipe: ${recipeTitle}\n\nCopy the link to share this recipe.`);
            }
        });

        // View All Seasonal Recipes
        document.querySelector('.view-all-btn').addEventListener('click', function(e) {
            e.preventDefault();
            const seasonalBtn = document.querySelector('[data-category="seasonal"]');
            seasonalBtn.click();
        });
    </script>
</body>
</html>