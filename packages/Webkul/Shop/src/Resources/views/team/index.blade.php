<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ core()->getCurrentLocale()->direction }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Our Team | The HazleNut Factory</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Forum&family=Work+Sans:wght@300;400;500;600&display=swap">

    <link rel="stylesheet" href="{{ asset('thf-assets/css/header.css') }}">

<style>
/* ---------- global / reset ---------- */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Work Sans', sans-serif;
    background-color: #0b0b0b !important; /* deep black background */
    color: #fefcf8; /* warm dark brown text */
    line-height: 1.5;
    min-height: 100vh;
}

.container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem 2rem 4rem;
    background-color: transparent; /* ensure container doesn't override body */
}

/* ---------- hero banner (warm gradient) ---------- */
.hero-banner {
    background: linear-gradient(117deg, #f3ebe2 0%, #faf3ec 100%) !important;
    padding: 5rem 2rem;
    text-align: center;
    border-bottom: 1px solid #eedbcb;
    margin-top: 80px; /* for fixed header */
}

.hero-content {
    max-width: 900px;
    margin: 0 auto;
}

.hero-title {
    font-family: 'Forum', serif;
    font-size: 4rem;
    font-weight: 400;
    letter-spacing: 2px;
    color: #4f3b2c; /* rich brown */
    margin-bottom: 1.2rem;
    line-height: 1.1;
}

.hero-sub {
    font-size: 1.25rem;
    font-weight: 300;
    color: #5f4e41; /* medium brown */
    max-width: 650px;
    margin: 0 auto;
    border-top: 2px solid #dbb594; /* warm gold */
    padding-top: 1.5rem;
}

/* ---------- narrative section ---------- */
.story-block {
    background: #fcf6f0 !important; /* warm cream */
    padding: 3.5rem 4rem;
    border-radius: 40px;
    box-shadow: 0 20px 40px -12px rgba(85, 55, 30, 0.08);
    margin-bottom: 5rem;
    border: 1px solid #f0e3d8; /* soft peach */
    position: relative;
}

.story-block::before {
    content: "“";
    font-family: 'Forum', serif;
    font-size: 8rem;
    color: #e5cdb6; /* light tan */
    position: absolute;
    top: -20px;
    left: 30px;
    opacity: 0.4;
    pointer-events: none;
}

.story-text {
    font-size: 1.18rem;
    line-height: 1.8;
    color: #3e332b; /* warm dark brown */
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.story-text p {
    margin-bottom: 1.8rem;
}

.story-text p:first-child {
    font-weight: 500;
    font-size: 1.3rem;
    color: #6f4e37; /* coffee brown */
}

.story-text p:last-child {
    margin-bottom: 0;
}

.signature-line {
    margin-top: 2rem;
    font-family: 'Forum', serif;
    font-size: 1.4rem;
    color: #a0785c; /* warm medium brown */
    display: flex;
    align-items: center;
    gap: 1rem;
}

.signature-line i {
    font-size: 2rem;
    color: #c29a73; /* golden tan */
}

/* ---------- team section header ---------- */
.team-header {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    margin-bottom: 3rem;
    flex-wrap: wrap;
    gap: 20px;
}

.team-header h2 {
    font-family: 'Forum', serif;
    font-size: 3rem;
    font-weight: 400;
    color: #dbb594; /* deep brown */
    letter-spacing: 1px;
    position: relative;
}

.team-header h2:after {
    content: '';
    display: block;
    width: 100px;
    height: 3px;
    background: #dbb594; /* warm gold */
    margin-top: 0.6rem;
}

.team-header span {
    font-size: 1.1rem;
    background: #f0e4d9 !important; /* light peach */
    padding: 0.5rem 1.8rem;
    border-radius: 40px;
    color: #5f3f2c; /* medium brown */
    font-weight: 500;
    letter-spacing: 0.5px;
}

/* ---------- team row (cards) ---------- */
.team-row {
    display: flex;
    gap: 4rem;
    margin-bottom: 6rem;
    align-items: center;
    background: #ffffff !important; /* white cards for contrast */
    border-radius: 48px;
    padding: 2rem 2rem 2rem 2rem;
    box-shadow: 0 25px 45px -18px rgba(65, 43, 30, 0.12);
    border: 1px solid #f2dfd0; /* soft peach */
    transition: all 0.3s ease;
}

.team-row:hover {
    transform: scale(1.01);
    box-shadow: 0 30px 50px -18px rgba(165, 123, 93, 0.25);
}

/* image column */
.team-image-col {
    flex: 0 0 340px;
}

.team-image-wrap {
    width: 100%;
    border-radius: 32px;
    overflow: hidden;
    box-shadow: 0 12px 28px -8px rgba(60, 40, 20, 0.2);
    border: 3px solid #fff6ed; /* cream */
    aspect-ratio: 1 / 1.1;
}

.team-image-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.team-row:hover .team-image-wrap img {
    transform: scale(1.03);
}

/* content column */
.team-content-col {
    flex: 1;
    padding-right: 1rem;
}

.member-name {
    font-family: 'Forum', serif;
    font-size: 3rem;
    font-weight: 400;
    color: #2b1e14; /* dark chocolate */
    line-height: 1.1;
    margin-bottom: 0.25rem;
}

.member-title {
    font-size: 1.25rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    color: #b28056; /* golden brown */
    margin-bottom: 1.5rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
}

.member-title i {
    font-size: 1.4rem;
    color: #ccaa84; /* light gold */
}

.member-bio {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #3f332b; /* warm brown */
    margin-bottom: 2rem;
}

.member-bio p {
    margin-bottom: 1.4rem;
}

.member-bio p:last-child {
    margin-bottom: 0;
}

.highlight-quote {
    background: #fcf5ef !important; /* warm cream */
    padding: 1.6rem 2rem;
    border-radius: 30px;
    margin: 1.5rem 0 1.8rem;
    border-left: 5px solid #c6a27a; /* medium gold */
    font-style: normal;
    font-weight: 400;
    color: #4e3c2f; /* rich brown */
    box-shadow: inset 0 2px 8px #f9ede2; /* soft peach */
    font-size: 1.05rem;
}

.highlight-quote i {
    color: #a57144; /* warm copper */
    margin-right: 8px;
    font-size: 1.2rem;
}

.member-footer {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.btn-outline {
    background: transparent;
    border: 2px solid #c8a27b; /* tan */
    color: #6f4e37; /* coffee brown */
    padding: 0.8rem 2.2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    letter-spacing: 0.5px;
    transition: 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: default;
    opacity: 0.8;
    font-family: 'Work Sans', sans-serif;
}

.btn-outline i {
    font-size: 1.2rem;
    color: #b28056; /* golden brown */
}

.btn-outline:hover {
    background: #f3e5d9; /* light peach */
    border-color: #a56f42; /* darker gold */
}

.pill-badge {
    background: #efe1d3 !important; /* light tan */
    padding: 0.5rem 1.8rem;
    border-radius: 40px;
    font-size: 0.95rem;
    font-weight: 500;
    color: #523d2e; /* dark brown */
    display: inline-flex;
    align-items: center;
    gap: 8px;
    letter-spacing: 0.3px;
}

.pill-badge i {
    color: #a7622b; /* terracotta */
}

/* closing note */
.closing-note {
    text-align: center;
    margin-top: 4rem;
    font-size: 1.3rem;
    font-family: 'Forum', serif;
    color: #6f523b; /* warm brown */
    background: #f5ece3 !important; /* warm cream */
    padding: 2rem;
    border-radius: 100px 100px 40px 40px;
    border: 1px solid #e1cbb8; /* light tan */
}

.closing-note i {
    margin: 0 8px;
    color: #b2652a; /* burnt orange */
}

/* responsive */
@media (max-width: 1000px) {
    .team-row {
        flex-direction: column;
        padding: 2rem;
        gap: 2rem;
    }
    
    .team-image-col {
        flex: 0 0 auto;
        width: 70%;
        max-width: 380px;
    }
    
    .hero-title {
        font-size: 3rem;
    }
    
    .story-block {
        padding: 2.5rem;
    }
    
    .team-header {
        flex-direction: column;
        align-items: flex-start;
    }
}

@media (max-width: 768px) {
    .container {
        padding: 1.5rem 1rem 3rem;
    }
    
    .hero-banner {
        padding: 4rem 1.5rem;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .story-block {
        padding: 2rem;
        border-radius: 30px;
    }
    
    .member-name {
        font-size: 2.2rem;
    }
    
    .team-image-col {
        width: 100%;
        max-width: 100%;
    }
    
    .member-footer {
        flex-direction: column;
    }
    
    .pill-badge, .btn-outline {
        width: 100%;
        justify-content: center;
    }
    
    .closing-note {
        border-radius: 40px;
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-sub {
        font-size: 1rem;
    }
    
    .story-text p:first-child {
        font-size: 1.1rem;
    }
    
    .highlight-quote {
        padding: 1.2rem;
    }
}
    </style>

</head>
<body>
    @include('shop::partials.thf-header')

    <!-- HERO BANNER (original warm gradient) -->
    <div class="hero-banner">
        <div class="hero-content">
            <div class="hero-title">The storytellers</div>
            <div class="hero-sub">Two brothers, one unwavering dream — to craft sweets that carry tradition into the future.</div>
        </div>
    </div>

    <div class="container">
        <!-- STORY NARRATIVE (original warm #fcf6f0 background) -->
        <div class="story-block">
            <div class="story-text">
                <p>Every creation at The Hazelnut Factory reflects the vision of two dreamers who believed that Indian sweets could tell a new story — one of innovation, authenticity, and joy. What began as a small idea in Lucknow has today grown into a celebrated brand of artisanal indulgence, led with heart and guided by craft.</p>
                <p>Fuelled by an unyielding passion for reimagining tradition, Ankit and Badal Sahni set out to bridge the gap between heritage and modern taste. Their journey began with a simple yet profound belief — that Indian desserts could be as global, elegant, and experiential as any fine pâtisserie in the world, without losing their soul. From crafting the perfect texture of baklava to introducing gourmet gifting experiences, they’ve turned The Hazelnut Factory into a space where craftsmanship meets creativity.</p>
                <p>Behind every box, every confection, and every café experience lies their shared commitment to quality and innovation. Together, they’ve built not just a brand but a movement — redefining indulgence for a new generation while staying true to the warmth, hospitality, and cultural richness that make Indian sweets timeless.</p>
                <div class="signature-line">
                    <i class="fas fa-feather-alt"></i> — The heart behind the hazelnut
                </div>
            </div>
        </div>

        <!-- TEAM SECTION HEADER -->
        <div class="team-header">
            <h2>Visionary founders</h2>
            <span><i class="fas fa-hand-holding-heart"></i> handcrafted legacy</span>
        </div>

        <!-- TEAM MEMBER 1: ANKIT SAHNI (left image, right content) -->
        <div class="team-row">
            <div class="team-image-col">
                <div class="team-image-wrap">
                    <!-- actual image path; fallback for demo -->
                    <img src="https://cdn.shopify.com/s/files/1/0780/1759/3645/files/Ankit_bhaiya_500x700_4d78bfd1-5382-4b21-96d4-ef98cea7a9d9.png?v=1688639858" alt="Ankit Sahni" onerror="this.src='https://placehold.co/600x700/efdccf/7b5f4a?text=Ankit+Sahni'">
                </div>
            </div>
            <div class="team-content-col">
                <div class="member-name">ANKIT SAHNI</div>
                <div class="member-title"><i class="fas fa-seedling"></i> Founder, THF</div>

                <div class="member-bio">
                    <p>Our founder, Mr. Ankit Sahni, has always been captivated by the idea of opening a cafe that combines the best of coffee, bakery products, and sweets under one roof. It was this burning passion that led him to embark on a remarkable journey in 2018. Recognizing the scarcity of places offering a diverse range of coffee, bakery treats, and sweets, Ankit decided to fill this gap by establishing The Hazelnut Factory. With unwavering determination, he dedicated an entire year to meticulously crafting the concept before finally unveiling the first THF store in 2019.</p>
                </div>

                <div class="highlight-quote">
                    <i class="fas fa-quote-left"></i> At THF, we take pride in being a vegetarian cafe with an enticing array of egg products in our bakery section. We also understand the importance of catering to different dietary preferences, which is why we offer a plethora of gluten-free and vegan options. Our menu predominantly features delectable continental dishes, while our beverage menu is equally extensive, ensuring there's something for every discerning palate.
                </div>

                <div class="member-footer">
                    <span class="pill-badge"><i class="fab fa-linkedin"></i> Connect (Ankit)</span>
                    <span class="pill-badge"><i class="fas fa-calendar-alt"></i> since 2018</span>
                </div>
            </div>
        </div>

        <!-- TEAM MEMBER 2: BADAL SAHNI (same left/right order) -->
        <div class="team-row">
            <div class="team-image-col">
                <div class="team-image-wrap">
                    <img src="https://cdn.shopify.com/s/files/1/0780/1759/3645/files/Badal_bhaiya_500x700_3239a2f9-bd48-40a6-bf95-aa7a72b847a5.png?v=1689335830" alt="Badal Sahni" onerror="this.src='https://placehold.co/600x700/efdccf/7b5f4a?text=Badal+Sahni'">
                </div>
            </div>
            <div class="team-content-col">
                <div class="member-name">BADAL SAHNI</div>
                <div class="member-title"><i class="fas fa-crown"></i> Director, THF</div>

                <div class="member-bio">
                    <p>Our founder, Mr. Ankit Sahni, has always been captivated by the idea of opening a cafe that combines the best of coffee, bakery products, and sweets under one roof. It was this burning passion that led him to embark on a remarkable journey in 2018. Recognizing the scarcity of places offering a diverse range of coffee, bakery treats, and sweets, Ankit decided to fill this gap by establishing The Hazelnut Factory. With unwavering determination, he dedicated an entire year to meticulously crafting the concept before finally unveiling the first THF store in 2019.</p>
                </div>

                <div class="highlight-quote">
                    <i class="fas fa-quote-left"></i> At THF, we take pride in being a vegetarian cafe with an enticing array of egg products in our bakery section. We also understand the importance of catering to different dietary preferences, which is why we offer a plethora of gluten-free and vegan options. Our menu predominantly features delectable continental dishes, while our beverage menu is equally extensive, ensuring there's something for every discerning palate.
                </div>

                <div class="member-footer">
                    <span class="pill-badge"><i class="fab fa-linkedin"></i> Connect (Badal)</span>
                    <span class="pill-badge"><i class="fas fa-gem"></i> creative director</span>
                </div>
            </div>
        </div>

        <!-- CLOSING ELEMENT with original warm tone -->
        <div class="closing-note">
            <i class="fas fa-wheat-alt"></i> Handcrafted with heritage · every recipe tells a story <i class="fas fa-wheat-alt"></i>
        </div>
    </div>

    <!-- FOOTER -->
    @include("shop::partials.thf-footer")


</body>
</html>