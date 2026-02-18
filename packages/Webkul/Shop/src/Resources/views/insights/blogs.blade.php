@php
    $channel = core()->getCurrentChannel();
    $blogRepository = app('Webkul\CMS\Repositories\BlogRepository');
    $blogs = $blogRepository->where('status', 1)->get();
@endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Blog | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&display=swap">
    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">

    <style>
        /* Base styles matching THF Journal */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: "Forum", serif;
            background: #0a0a0a;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
        }
        .hero-banner {
            width: 100%; height: 380px; margin-top: 80px;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4)), url('{{ asset("thf-assets/images/blog-banner.jpg") }}') center/cover;
            display: flex; align-items: center; justify-content: center; text-align: center;
        }
        .hero-title { font-size: 3.2rem; text-transform: uppercase; color: #fff; }
        .container { max-width: 1200px; margin: -80px auto 60px; padding: 0 40px; position: relative; z-index: 5; }
        .floating-card {
            background: rgba(15, 15, 15, 0.85); padding: 50px; border-radius: 24px; backdrop-filter: blur(20px);
            border: 1px solid rgba(212, 175, 55, 0.15); box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
        }
        .blog-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 40px; margin-top: 50px; }
        .blog-card { background: rgba(20, 20, 20, 0.7); border-radius: 20px; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.05); display: flex; flex-direction: column; transition: 0.3s; }
        .blog-card:hover { transform: translateY(-10px); border-color: #d4af37; }
        .blog-card-image { height: 220px; overflow: hidden; }
        .blog-card-image img { width: 100%; height: 100%; object-fit: cover; }
        .blog-card-content { padding: 30px; flex: 1; display: flex; flex-direction: column; }
        .blog-card-title { font-size: 1.5rem; color: #fff; margin-bottom: 15px; }
        .blog-card-excerpt { color: rgba(255, 255, 255, 0.7); margin-bottom: 20px; flex: 1; }
        .blog-card-link { color: #d4af37; text-decoration: none; }
        .blog-header { text-align: center; margin-bottom: 40px; }
        .blog-header h1 { font-size: 2.8rem; color: #fff; }
    </style>
</head>

<body>
    @include('shop::partials.thf-header')

    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">THF Journal</div>
        </div>
    </div>

    <div class="container">
        <div class="floating-card">
            <div class="blog-header">
                <h1>Latest Stories & Insights</h1>
                <p>Explore articles that celebrate our passion for quality and innovation.</p>
            </div>

            <div class="blog-grid">
                @forelse($blogs as $blog)
                    <article class="blog-card">
                        <a href="{{ route('shop.insights.blog_view', $blog->slug) }}" class="blog-card-image">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}">
                        </a>
                        <div class="blog-card-content">
                            <div style="color:#d4af37; font-size:0.9rem; margin-bottom:10px;">
                                <i class="far fa-folder"></i> {{ $blog->category }}
                            </div>
                            <h3 class="blog-card-title">
                                <a href="{{ route('shop.insights.blog_view', $blog->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $blog->title }}
                                </a>
                            </h3>
                            <p class="blog-card-excerpt">{{ $blog->short_description }}</p>
                            <div class="blog-card-footer">
                                <a href="{{ route('shop.insights.blog_view', $blog->slug) }}" class="blog-card-link">Read More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p style="text-align: center; grid-column: 1/-1;">Stay tuned for our latest stories.</p>
                @endforelse
            </div>
        </div>
    </div>

    @include("shop::partials.thf-footer")
</body>
</html>
