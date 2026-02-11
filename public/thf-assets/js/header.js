// THF Header Global JavaScript
// Universal header handler for all pages

(function() {
    // Prevent double-initialization
    if (window.__thfHeaderInitialized) return;
    window.__thfHeaderInitialized = true;

    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const megaMenu = document.querySelector('.mega-menu');
        const header = document.querySelector('.header');
        const searchToggle = document.querySelector('.search-toggle');
        const searchBox = document.querySelector('.search-container .search-box');

        // --- Mega Menu Toggle ---
        if (menuToggle && megaMenu) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                e.preventDefault();
                megaMenu.classList.toggle('active');
                menuToggle.classList.toggle('active');
                document.body.style.overflow = megaMenu.classList.contains('active') ? 'hidden' : '';
            });

            // Close menu on clicking outside
            document.addEventListener('click', function(e) {
                if (!megaMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                    if (megaMenu.classList.contains('active')) {
                        megaMenu.classList.remove('active');
                        menuToggle.classList.remove('active');
                        document.body.style.overflow = '';
                    }
                }
            });

            // Close menu on Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && megaMenu.classList.contains('active')) {
                    megaMenu.classList.remove('active');
                    menuToggle.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        }

        // --- Search Toggle ---
        if (searchToggle && searchBox) {
            searchToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                searchBox.classList.toggle('active');
                if (searchBox.classList.contains('active')) {
                    var input = searchBox.querySelector('input');
                    if (input) input.focus();
                }
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.search-container')) {
                    searchBox.classList.remove('active');
                }
            });
        }

        // --- Gallery Navigation (Bestsellers in mega menu) ---
        var galleryTrack = document.querySelector('.gallery-track');
        var prevBtn = document.querySelector('.g-arrow.prev');
        var nextBtn = document.querySelector('.g-arrow.next');
        var indicators = document.querySelectorAll('.gallery-indicator');
        var galleryItems = document.querySelectorAll('.mega-menu .gallery-item');
        var currentSlide = 0;
        var slideWidth = 310;
        var maxSlides = Math.max(0, galleryItems.length - 3);

        function updateGallery() {
            if (galleryTrack) {
                var translateX = -(currentSlide * slideWidth);
                galleryTrack.style.transform = 'translateX(' + translateX + 'px)';
            }
            if (indicators && indicators.length > 0) {
                indicators.forEach(function(indicator, index) {
                    indicator.classList.remove('active');
                    if (index === Math.floor(currentSlide / 2)) {
                        indicator.classList.add('active');
                    }
                });
            }
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                if (currentSlide > 0) {
                    currentSlide--;
                    updateGallery();
                }
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                if (currentSlide < maxSlides) {
                    currentSlide++;
                    updateGallery();
                }
            });
        }

        if (indicators && indicators.length > 0) {
            indicators.forEach(function(indicator, index) {
                indicator.addEventListener('click', function() {
                    currentSlide = index * 2;
                    if (currentSlide > maxSlides) {
                        currentSlide = maxSlides;
                    }
                    updateGallery();
                });
            });
        }

        updateGallery();

        // --- Scroll-based header styling ---
        if (header) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }

        // --- Cart Count ---
        if (typeof window.updateCartCount !== 'function') {
            window.updateCartCount = function() {
                fetch('/api/checkout/cart')
                    .then(function(response) { return response.json(); })
                    .then(function(data) {
                        var count = data.data ? data.data.items_qty || 0 : 0;
                        var headerCartCount = document.getElementById('header-cart-count');
                        if (headerCartCount) {
                            headerCartCount.textContent = count;
                        }
                    })
                    .catch(function(error) {
                        console.error('Failed to update cart count:', error);
                    });
            };
        }
        window.updateCartCount();
    });
})();
