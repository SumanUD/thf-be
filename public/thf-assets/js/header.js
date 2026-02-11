// THF Header Global JavaScript
// Only initialize if MenuController doesn't exist (avoid conflicts with home.js)

if (typeof window.MenuController === 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const megaMenu = document.querySelector('.mega-menu');

        if (menuToggle && megaMenu) {
            // Toggle menu
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                megaMenu.classList.toggle('active');
                menuToggle.classList.toggle('active');
            });

            // Close menu on clicking outside
            document.addEventListener('click', function(e) {
                if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                    if (megaMenu.classList.contains('active')) {
                        megaMenu.classList.remove('active');
                        menuToggle.classList.remove('active');
                    }
                }
            });

            // Close menu on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                    megaMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                }
            });
        }

        // Update cart count on page load
        if (typeof updateCartCount !== 'function') {
            window.updateCartCount = function() {
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
            };
            updateCartCount();
        }
    });
}
