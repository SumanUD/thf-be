// Text Animation
const texts = document.querySelectorAll('.banner-texts h1');
let currentIndex = 0;

function rotateText() {
    texts.forEach((text, index) => {
        text.classList.remove('active');
    });

    currentIndex = (currentIndex + 1) % texts.length;
    texts[currentIndex].classList.add('active');
}

// Rotate text every 3 seconds
setInterval(rotateText, 3000);

// Video brightness on scroll
const video = document.querySelector('.video-banner video');
window.addEventListener('scroll', () => {
    const scrollPercent = window.scrollY / window.innerHeight;
    const brightness = Math.max(0.4, 0.8 - (scrollPercent * 0.4));
    video.style.filter = `brightness(${brightness})`;
});

// Add to Cart function (placeholder - will integrate with Bagisto API)
function addToCart(productId) {
    // This will be connected to Bagisto's cart API
    alert('Product added to cart! (Demo - will connect to Bagisto API with database)');

    // Actual implementation would be:
    // fetch('{{ route("shop.api.checkout.cart.store") }}', {
    //     method: 'POST',
    //     headers: {
    //         'Content-Type': 'application/json',
    //         'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //     },
    //     body: JSON.stringify({
    //         product_id: productId,
    //         quantity: 1
    //     })
    // });
}

// Menu Toggle - now handled by header.js universally

