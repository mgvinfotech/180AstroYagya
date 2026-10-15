/**
 * 108 ASTRO YAGYA - FRONTEND INTERACTION & ANIMATION SCRIPTS
 * Matching: https://108astroyagya.com/
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Theme Toggle (Light & Dark Mode)
    initThemeToggle();

    // 2. Scroll Reveal Animations (IntersectionObserver)
    initScrollReveals();

    // 3. Sticky Navbar
    const navbar = document.querySelector('.main-navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 30) {
            navbar?.classList.add('scrolled');
        } else {
            navbar?.classList.remove('scrolled');
        }
    });

    // 4. Hero Banner Slider
    const slides = document.querySelectorAll('.hero-slider-item');
    const dotsContainer = document.getElementById('heroSliderDots');
    let currentSlide = 0;
    let slideTimer = null;

    if (slides.length > 0) {
        if (dotsContainer) {
            dotsContainer.innerHTML = '';
            slides.forEach((_, idx) => {
                const dot = document.createElement('button');
                dot.type = 'button';
                dot.className = `w-3 h-3 rounded-full transition-all ${idx === 0 ? 'bg-amber-400 w-8' : 'bg-white/40'}`;
                dot.addEventListener('click', () => {
                    goToSlide(idx);
                    resetTimer();
                });
                dotsContainer.appendChild(dot);
            });
        }

        function goToSlide(idx) {
            slides[currentSlide].classList.remove('active');
            slides[currentSlide].style.display = 'none';

            currentSlide = (idx + slides.length) % slides.length;

            slides[currentSlide].style.display = 'flex';
            slides[currentSlide].classList.add('active');

            if (dotsContainer) {
                const dots = dotsContainer.children;
                for (let i = 0; i < dots.length; i++) {
                    dots[i].className = (i === currentSlide) 
                        ? 'w-8 h-3 rounded-full bg-amber-400 transition-all'
                        : 'w-3 h-3 rounded-full bg-white/40 transition-all';
                }
            }
        }

        function nextSlide() {
            goToSlide(currentSlide + 1);
        }

        function resetTimer() {
            if (slideTimer) clearInterval(slideTimer);
            slideTimer = setInterval(nextSlide, 7000);
        }

        slides.forEach((s, idx) => {
            s.style.display = idx === 0 ? 'flex' : 'none';
        });

        resetTimer();

        document.getElementById('heroPrevBtn')?.addEventListener('click', () => {
            goToSlide(currentSlide - 1);
            resetTimer();
        });
        document.getElementById('heroNextBtn')?.addEventListener('click', () => {
            goToSlide(currentSlide + 1);
            resetTimer();
        });
    }

    // 5. Category Filter for Services
    const filterButtons = document.querySelectorAll('[data-service-filter]');
    const serviceItems = document.querySelectorAll('.service-grid-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => {
                b.classList.remove('active', 'bg-amber-500', 'text-white');
                b.classList.add('text-slate-600');
            });
            btn.classList.add('active', 'bg-amber-500', 'text-white');
            btn.classList.remove('text-slate-600');

            const filter = btn.getAttribute('data-service-filter');
            serviceItems.forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category-slug') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // 6. Animated Counter for Stats
    const counters = document.querySelectorAll('.stat-counter');
    let animated = false;

    function runCounters() {
        if (animated || counters.length === 0) return;
        
        counters.forEach(c => {
            const rect = c.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                animated = true;
                counters.forEach(counterItem => {
                    const target = parseInt(counterItem.getAttribute('data-target') || '0', 10);
                    if (!target) return;
                    const step = Math.ceil(target / 45);
                    let count = 0;
                    const timer = setInterval(() => {
                        count += step;
                        if (count >= target) {
                            counterItem.textContent = target.toLocaleString() + '+';
                            clearInterval(timer);
                        } else {
                            counterItem.textContent = count.toLocaleString() + '+';
                        }
                    }, 28);
                });
            }
        });
    }

    window.addEventListener('scroll', runCounters);
    runCounters();

    // 7. AJAX Booking Form
    const inquiryForms = document.querySelectorAll('#vedicInquiryForm, #testimonialSubmitForm');
    inquiryForms.forEach(form => {
        form.addEventListener('submit', async function (e) {
            e.preventDefault();
            const submitBtn = form.querySelector('button[type="submit"]');
            const alertBox = document.getElementById('inquiryAlertBox') || form.querySelector('.inquiry-alert-local');

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Submitting...';
            }

            if (alertBox) {
                alertBox.classList.add('hidden');
                alertBox.innerHTML = '';
            }

            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    if (alertBox) {
                        alertBox.className = 'p-4 rounded-xl mb-6 bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-400 dark:border-emerald-700 text-emerald-800 dark:text-emerald-200 text-sm flex items-center gap-3';
                        alertBox.innerHTML = '<i class="fa fa-check-circle text-2xl text-emerald-600 dark:text-emerald-400"></i> <div><strong>Hari Om!</strong> ' + data.message + '</div>';
                        alertBox.classList.remove('hidden');
                    }
                    form.reset();
                    alertBox?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else {
                    let errMsg = data.message || 'Please check the entered details.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    if (alertBox) {
                        alertBox.className = 'p-4 rounded-xl mb-6 bg-rose-50 dark:bg-rose-950/80 border border-rose-400 dark:border-rose-700 text-rose-800 dark:text-rose-200 text-sm flex items-center gap-3';
                        alertBox.innerHTML = '<i class="fa fa-exclamation-triangle text-2xl text-rose-600 dark:text-rose-400"></i> <div>' + errMsg + '</div>';
                        alertBox.classList.remove('hidden');
                    }
                }
            } catch (err) {
                if (alertBox) {
                    alertBox.className = 'p-4 rounded-xl mb-6 bg-rose-50 dark:bg-rose-950/80 border border-rose-400 text-rose-800 dark:text-rose-200 text-sm';
                    alertBox.innerHTML = 'An unexpected error occurred. Please contact us directly by phone or WhatsApp.';
                    alertBox.classList.remove('hidden');
                }
            } finally {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<span>Submit Sacred Request</span> <i class="fa fa-paper-plane"></i>';
                }
            }
        });
    });

    // 8. Mobile Drawer
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileDrawer = document.getElementById('mobileMenuDrawer');
    const mobileCloseBtn = document.getElementById('mobileCloseBtn');

    mobileMenuBtn?.addEventListener('click', () => {
        mobileDrawer?.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    });

    mobileCloseBtn?.addEventListener('click', () => {
        mobileDrawer?.classList.add('hidden');
        document.body.style.overflow = '';
    });
});

/**
 * Initialize Light and Dark Mode toggle
 */
function initThemeToggle() {
    const toggleBtn = document.getElementById('themeToggleBtn');
    const modeText = document.getElementById('themeModeText');

    function updateLabel(isDark) {
        if (modeText) {
            modeText.textContent = isDark ? 'Dark' : 'Light';
        }
    }

    const isInitiallyDark = document.documentElement.classList.contains('dark');
    updateLabel(isInitiallyDark);

    toggleBtn?.addEventListener('click', function () {
        const isDark = document.documentElement.classList.toggle('dark');
        localStorage.setItem('astro_theme', isDark ? 'dark' : 'light');
        updateLabel(isDark);
    });
}

/**
 * Scroll Reveal Animations using IntersectionObserver
 */
function initScrollReveals() {
    const revealElements = document.querySelectorAll('.reveal-fade-up, .reveal-fade-left, .reveal-fade-right');
    
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries, obs) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-revealed');
                    obs.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => observer.observe(el));
    } else {
        // Fallback for browsers without IntersectionObserver
        revealElements.forEach(el => el.classList.add('is-revealed'));
    }
}
