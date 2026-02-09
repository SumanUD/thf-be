// Text animation with GSAP
document.addEventListener('DOMContentLoaded', () => {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);

        const texts = gsap.utils.toArray(".banner-texts h1");
        let current = 0;

        const totalHeight = texts.length * window.innerHeight;

        ScrollTrigger.create({
            trigger: ".video-banner",
            start: "top top",
            end: `+=${totalHeight}`,
            pin: true,
            scrub: 1,
            onUpdate: (self) => {
                const progress = self.progress;
                const index = Math.floor(progress * texts.length);
                
                if (index !== current && index < texts.length) {
                    texts[current].classList.remove('active');
                    current = index;
                    texts[current].classList.add('active');
                }
            }
        });

        texts[0].classList.add('active');
    }
});

// Add to cart function
function addToCart(productId) {
    fetch('{{ route("shop.api.checkout.cart.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            showNotification('Added to cart!', 'success');
            updateCartCount();
        }
    })
    .catch(error => {
        showNotification('Error adding to cart', 'error');
    });
}

// Add to wishlist
function addToWishlist(productId) {
    fetch('{{ route("shop.api.customers.account.wishlist.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        showNotification('Added to wishlist!', 'success');
    })
    .catch(error => {
        showNotification('Please sign in to add to wishlist', 'error');
    });
}

// Show notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#d4af37' : '#ff6b6b'};
        color: #0a0a0a;
        padding: 15px 25px;
        border-radius: 8px;
        z-index: 10000;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

// Update cart count
function updateCartCount() {
    fetch('{{ route("shop.api.checkout.cart.index") }}')
        .then(response => response.json())
        .then(data => {
            const count = data.data ? data.data.items_qty || 0 : 0;
            const headerCartCount = document.getElementById('header-cart-count');
            if (headerCartCount) headerCartCount.textContent = count;
        })
        .catch(() => {});
}

// Initialize
updateCartCount();
