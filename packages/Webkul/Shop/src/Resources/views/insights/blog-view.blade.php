<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $blog->title }} | The HazleNut Factory</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: "Forum", serif; background: #0a0a0a; color: rgba(255, 255, 255, 0.9); line-height: 1.8; }
        .hero-banner { 
            width: 100%; height: 500px; margin-top: 80px;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.8)), url('{{ $blog->image }}') center/cover no-repeat;
            display: flex; align-items: center; justify-content: center; text-align: center;
        }
        .hero-content { max-width: 900px; padding: 0 20px; }
        .hero-title { font-size: 4rem; color: #fff; text-transform: uppercase; margin-bottom: 20px; line-height: 1.1; }
        .blog-meta { color: #d4af37; font-size: 1.1rem; letter-spacing: 1px; }
        
        .content-wrapper { max-width: 900px; margin: -100px auto 100px; padding: 60px; background: rgba(15,15,15,0.9); border-radius: 30px; border: 1px solid rgba(212,175,55,0.1); backdrop-filter: blur(20px); position: relative; z-index: 10; }
        .blog-content { font-size: 1.2rem; color: rgba(255,255,255,0.8); }
        .blog-content p { margin-bottom: 25px; }
        .blog-content h2, .blog-content h3 { color: #fff; margin: 40px 0 20px; }
        
        .back-link { display: inline-flex; align-items: center; gap: 10px; color: #d4af37; text-decoration: none; margin-bottom: 40px; transition: 0.3s; }
        .back-link:hover { color: #fff; transform: translateX(-5px); }

        @media (max-width: 768px) {
            .hero-title { font-size: 2.5rem; }
            .content-wrapper { padding: 30px 20px; margin-top: -50px; border-radius: 0; }
        }
    </style>
</head>
<body class="thf-dark-theme">
    @include('shop::partials.thf-header')

    <div class="hero-banner">
        <div class="hero-content">
            <div class="blog-meta">{{ $blog->category }} | {{ $blog->reading_time }} MIN READ</div>
            <h1 class="hero-title">{{ $blog->title }}</h1>
            <div style="color: rgba(255,255,255,0.6)">By {{ $blog->author }} | {{ $blog->created_at->format('M d, Y') }}</div>
        </div>
    </div>

    <div class="content-wrapper">
        <a href="{{ route('shop.insights.blogs') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Back to Journal
        </a>

        <div class="blog-content">
            {!! $blog->content !!}
        </div>
    </div>

    @include("shop::partials.thf-footer")
</body>
</html>
