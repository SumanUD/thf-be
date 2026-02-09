        // Menu Controller
        class MenuController {
            constructor() {
                this.menuToggle = document.querySelector('.menu-toggle');
                this.megaMenu = document.querySelector('.mega-menu');
                this.header = document.querySelector('.header');
                this.searchToggle = document.querySelector('.search-toggle');
                this.searchBox = document.querySelector('.search-box');
                this.galleryTrack = document.querySelector('.gallery-track');
                this.prevBtn = document.querySelector('.prev');
                this.nextBtn = document.querySelector('.next');
                this.indicators = document.querySelectorAll('.gallery-indicator');
                this.galleryItems = document.querySelectorAll('.gallery-item');
                this.currentSlide = 0;
                this.slideWidth = 310; // item width + gap
                this.maxSlides = Math.max(0, this.galleryItems.length - 3);

                this.init();
            }

            init() {
                this.menuToggle.addEventListener('click', () => this.toggleMenu());

                document.addEventListener('click', (e) => {
                    if (!this.megaMenu.contains(e.target) &&
                        !this.menuToggle.contains(e.target) &&
                        this.megaMenu.classList.contains('active')) {
                        this.closeMenu();
                    }

                    // Close search if clicking outside
                    if (!e.target.closest('.search-container')) {
                        this.searchBox.classList.remove('active');
                    }
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        this.closeMenu();
                        this.searchBox.classList.remove('active');
                    }
                });

                // Search toggle
                this.searchToggle.addEventListener('click', (e) => {
                    e.stopPropagation();
                    this.searchBox.classList.toggle('active');
                    if (this.searchBox.classList.contains('active')) {
                        this.searchBox.querySelector('input').focus();
                    }
                });

                // Gallery navigation
                if (this.prevBtn && this.nextBtn) {
                    this.prevBtn.addEventListener('click', () => this.prevSlide());
                    this.nextBtn.addEventListener('click', () => this.nextSlide());
                }

                // Indicators
                if (this.indicators) {
                    this.indicators.forEach((indicator, index) => {
                        indicator.addEventListener('click', () => this.goToSlide(index));
                    });
                }

                window.addEventListener('scroll', () => this.handleScroll());
                this.updateGallery();
            }

            toggleMenu() {
                this.megaMenu.classList.toggle('active');
                this.menuToggle.classList.toggle('active');
                document.body.style.overflow = this.megaMenu.classList.contains('active') ? 'hidden' : '';
            }

            closeMenu() {
                this.megaMenu.classList.remove('active');
                this.menuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }

            handleScroll() {
                if (window.scrollY > 50) {
                    this.header.classList.add('scrolled');
                } else {
                    this.header.classList.remove('scrolled');
                }
            }

            prevSlide() {
                if (this.currentSlide > 0) {
                    this.currentSlide--;
                    this.updateGallery();
                }
            }

            nextSlide() {
                if (this.currentSlide < this.maxSlides) {
                    this.currentSlide++;
                    this.updateGallery();
                }
            }

            goToSlide(index) {
                this.currentSlide = index * 2;
                if (this.currentSlide > this.maxSlides) {
                    this.currentSlide = this.maxSlides;
                }
                this.updateGallery();
            }

            updateGallery() {
                if (this.galleryTrack) {
                    const translateX = -(this.currentSlide * this.slideWidth);
                    this.galleryTrack.style.transform = `translateX(${translateX}px)`;
                }

                if (this.indicators) {
                    this.indicators.forEach((indicator, index) => {
                        indicator.classList.remove('active');
                        if (index === Math.floor(this.currentSlide / 2)) {
                            indicator.classList.add('active');
                        }
                    });
                }
            }
        }

        // Scroll Controller
        class LuxuryGiftingScroll {
            constructor() {
                this.video = document.getElementById('background-video');
                this.videoSection = document.querySelector('.video-section');
                this.videoOverlay = document.querySelector('.video-overlay');
                this.imageGallery = document.querySelector('.image-gallery');
                this.galleryItems = document.querySelectorAll('.gallery-item-main');
                this.headingText = document.querySelector('.heading-text');
                this.listItem = document.querySelector('.list-item');
                this.textLine = document.querySelector('.text-line');
                this.scrollIndicator = document.querySelector('.scroll-indicator');
                this.footer = document.querySelector('.footer');

                this.currentIndex = 0;
                this.maxIndex = 6;
                this.isAnimating = false;
                this.animationDuration = 1200;
                this.lastScrollTime = 0;
                this.scrollDelay = 800;

                this.init();
            }

            init() {
                this.video.play().catch(console.log);
                this.headingText.classList.add('visible');
                this.updateDisplay();

                this.handleWheel();
                this.handleKeys();
                this.handleTouch();
            }

            handleWheel() {
                window.addEventListener('wheel', (e) => {
                    e.preventDefault();

                    const now = Date.now();
                    if (now - this.lastScrollTime < this.scrollDelay || this.isAnimating) return;

                    this.lastScrollTime = now;

                    if (Math.abs(e.deltaY) > 5) {
                        if (e.deltaY > 0) {
                            this.nextItem();
                        } else {
                            this.previousItem();
                        }
                    }
                }, { passive: false });
            }

            handleKeys() {
                document.addEventListener('keydown', (e) => {
                    if (this.isAnimating) return;

                    if (e.key === 'ArrowDown' || e.key === ' ') {
                        e.preventDefault();
                        this.nextItem();
                    } else if (e.key === 'ArrowUp') {
                        e.preventDefault();
                        this.previousItem();
                    }
                });
            }

            handleTouch() {
                let touchStartY = 0;

                document.addEventListener('touchstart', (e) => {
                    touchStartY = e.touches[0].clientY;
                }, { passive: true });

                document.addEventListener('touchend', (e) => {
                    if (this.isAnimating) return;

                    const touchEndY = e.changedTouches[0].clientY;
                    const touchDiff = touchStartY - touchEndY;

                    if (Math.abs(touchDiff) > 80) {
                        if (touchDiff > 0) {
                            this.nextItem();
                        } else {
                            this.previousItem();
                        }
                    }
                }, { passive: true });
            }

            nextItem() {
                if (this.currentIndex >= this.maxIndex) return;
                this.currentIndex++;
                this.animateTransition();
            }

            previousItem() {
                if (this.currentIndex <= 0) return;
                this.currentIndex--;
                this.animateTransition();
            }

            animateTransition() {
                if (this.isAnimating) return;
                this.isAnimating = true;
                this.updateDisplay();

                setTimeout(() => {
                    this.isAnimating = false;
                }, this.animationDuration);
            }

            updateDisplay() {
                if (this.currentIndex === this.maxIndex) {
                    this.footer.classList.add('show');
                    this.imageGallery.style.opacity = '1';
                    this.imageGallery.style.zIndex = '1';
                    this.videoSection.style.opacity = '0';
                    this.updateGallery(true);
                    this.listItem.classList.remove('visible', 'active');
                    this.scrollIndicator.style.opacity = '0.2';
                } else {
                    this.footer.classList.remove('show');

                    if (this.currentIndex === 0) {
                        this.resetToInitialState();
                    } else if (this.currentIndex === 1) {
                        this.showTextWithVideo();
                    } else if (this.currentIndex >= 2 && this.currentIndex <= 5) {
                        this.showCategoryGallery();
                    }
                }
            }

            resetToInitialState() {
                this.videoSection.style.opacity = '1';
                this.videoOverlay.style.opacity = '0';
                this.video.style.filter = 'none';
                this.imageGallery.style.opacity = '0';
                this.imageGallery.style.zIndex = '0';
                this.resetAllGalleryItems();

                this.headingText.classList.add('visible');
                this.listItem.classList.remove('visible', 'active');
                this.textLine.style.transform = 'translateY(100%)';
                this.textLine.style.opacity = '0';
                this.scrollIndicator.style.opacity = '0.9';
            }

            showTextWithVideo() {
                this.videoSection.style.opacity = '1';
                this.videoOverlay.style.opacity = '0.4';
                this.video.style.filter = 'blur(4px) brightness(0.7) saturate(1.2)';
                this.imageGallery.style.opacity = '0';
                this.imageGallery.style.zIndex = '0';
                this.resetAllGalleryItems();

                this.headingText.classList.add('visible');
                this.listItem.classList.add('visible', 'active');

                setTimeout(() => {
                    this.textLine.style.transform = 'translateY(0)';
                    this.textLine.style.opacity = '1';
                }, 100);

                this.scrollIndicator.style.opacity = '0.2';
            }

            showCategoryGallery() {
                this.videoSection.style.opacity = '0';
                this.imageGallery.style.opacity = '1';
                this.imageGallery.style.zIndex = '1';

                this.headingText.classList.remove('visible');
                this.listItem.classList.remove('visible', 'active');
                this.scrollIndicator.style.opacity = '0.2';

                this.updateGallery(false);
            }

            resetAllGalleryItems() {
                this.galleryItems.forEach(item => {
                    item.classList.remove('active', 'past');
                    const title = item.querySelector('.category-title');
                    const subtitle = item.querySelector('.category-subtitle');
                    if (title) {
                        title.style.opacity = '0';
                        title.style.transform = 'translateY(50px)';
                    }
                    if (subtitle) {
                        subtitle.style.opacity = '0';
                        subtitle.style.transform = 'translateY(30px)';
                    }
                });
            }

            updateGallery(forFooter = false) {
                this.resetAllGalleryItems();

                const galleryIndex = forFooter ? 3 : this.currentIndex - 2;
                if (galleryIndex >= 0 && galleryIndex < this.galleryItems.length) {
                    const currentItem = this.galleryItems[galleryIndex];
                    currentItem.classList.add('active');

                    setTimeout(() => {
                        const title = currentItem.querySelector('.category-title');
                        const subtitle = currentItem.querySelector('.category-subtitle');

                        if (title) {
                            title.style.opacity = forFooter ? '0.7' : '1';
                            title.style.transform = 'translateY(0)';
                        }
                        if (subtitle) {
                            subtitle.style.opacity = forFooter ? '0.7' : '1';
                            subtitle.style.transform = 'translateY(0)';
                        }
                    }, 300);

                    for (let i = 0; i < galleryIndex; i++) {
                        this.galleryItems[i].classList.add('past');
                    }
                }
            }
        }

        // Update cart count
        function updateCartCount() {
            fetch('{{ route("shop.api.checkout.cart.index") }}')
                .then(response => response.json())
                .then(data => {
                    const count = data.data ? data.data.items_qty || 0 : 0;
                    const cartCount = document.getElementById('cart-count');
                    const headerCartCount = document.getElementById('header-cart-count');
                    if (cartCount) cartCount.textContent = count;
                    if (headerCartCount) headerCartCount.textContent = count;
                })
                .catch(() => {
                    const cartCount = document.getElementById('cart-count');
                    const headerCartCount = document.getElementById('header-cart-count');
                    if (cartCount) cartCount.textContent = '0';
                    if (headerCartCount) headerCartCount.textContent = '0';
                });
        }

        // Initialize
        document.addEventListener('DOMContentLoaded', () => {
            new MenuController();
            new LuxuryGiftingScroll();
            updateCartCount();
        });
