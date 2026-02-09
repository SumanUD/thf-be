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
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    
    fetch('/api/checkout/cart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.data || data.message) {
            showNotification('Added to cart!', 'success');
            updateCartCount();
        } else if (data.redirect_uri) {
            window.location.href = data.redirect_uri;
        } else {
            showNotification('Error adding to cart', 'error');
        }
    })
    .catch(error => {
        console.error('Cart error:', error);
        showNotification('Error adding to cart', 'error');
    });
}

// Add to wishlist
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
        font-family: "Forum", serif;
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 3000);
}

// Update cart count - FIXED: Use actual API endpoint
function updateCartCount() {
    fetch('/api/checkout/cart')
        .then(response => response.json())
        .then(data => {
            const count = data.data ? data.data.items_qty || 0 : 0;
            const headerCartCount = document.getElementById('header-cart-count');
            if (headerCartCount) {
                headerCartCount.textContent = count;
            }
        })
        .catch(error => {
            console.error('Failed to update cart count:', error);
        });
}

// Initialize
updateCartCount();
