// THF Header Global JavaScript
// Menu Toggle Functionality

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const megaMenu = document.querySelector('.mega-menu');
    const header = document.querySelector('.header');

    if (menuToggle && megaMenu) {
        // Toggle menu
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            megaMenu.classList.toggle('active');
            menuToggle.classList.toggle('active');

            // Toggle hamburger to X animation
            if (megaMenu.classList.contains('active')) {
                menuToggle.setAttribute('aria-expanded', 'true');
            } else {
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });

        // Close menu on clicking outside
        document.addEventListener('click', function(e) {
            if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                if (megaMenu.classList.contains('active')) {
                    megaMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                    menuToggle.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Close menu on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                megaMenu.classList.remove('active');
                menuToggle.classList.remove('active');
                menuToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // Search Toggle
    const searchToggle = document.querySelector('.search-toggle');
    const searchBox = document.querySelector('.search-box');

    if (searchToggle && searchBox) {
        searchToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            searchBox.classList.toggle('active');
            if (searchBox.classList.contains('active')) {
                const searchInput = searchBox.querySelector('input');
                if (searchInput) {
                    searchInput.focus();
                }
            }
        });

        // Close search on clicking outside
        document.addEventListener('click', function(e) {
            if (!searchBox.contains(e.target) && !searchToggle.contains(e.target)) {
                searchBox.classList.remove('active');
            }
        });
    }

    // Bestseller Gallery Navigation
    const galleryTrack = document.querySelector('.gallery-track');
    const prevBtn = document.querySelector('.g-arrow.prev');
    const nextBtn = document.querySelector('.g-arrow.next');
    const indicators = document.querySelectorAll('.gallery-indicator');

    if (galleryTrack && prevBtn && nextBtn) {
        let currentIndex = 0;
        const items = document.querySelectorAll('.gallery-item');
        const itemsPerView = 3;
        const totalPages = Math.ceil(items.length / itemsPerView);

        function updateGallery() {
            const offset = -currentIndex * 100;
            galleryTrack.style.transform = `translateX(${offset}%)`;

            // Update indicators
            indicators.forEach((indicator, index) => {
                indicator.classList.toggle('active', index === currentIndex);
            });
        }

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % totalPages;
            updateGallery();
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalPages) % totalPages;
            updateGallery();
        });

        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', () => {
                currentIndex = index;
                updateGallery();
            });
        });

        // Auto-rotate gallery
        setInterval(() => {
            currentIndex = (currentIndex + 1) % totalPages;
            updateGallery();
        }, 5000);
    }

    // Update cart count on page load
    updateCartCount();
});

// Update cart count function
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
