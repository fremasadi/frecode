import './bootstrap';

/* ============================================
   PORTFOLIO ANIMATION ENGINE
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
    initSplashScreen();
    initNavbarEffects();
    initActiveNavHighlight();
});

/* --- 0. Splash Screen --- */

function initSplashScreen() {
    const splash = document.getElementById('splash-screen');

    // If no splash element or already seen this session, skip
    if (!splash) {
        startMainAnimations();
        return;
    }

    if (sessionStorage.getItem('splash-seen')) {
        splash.remove();
        startMainAnimations();
        return;
    }

    // Show splash, hide main content
    document.body.classList.add('splash-active');

    // After splash animation plays (~2.2s), fade it out
    setTimeout(() => {
        splash.classList.add('splash-fade-out');
        document.body.classList.remove('splash-active');
        document.body.classList.add('splash-done');

        // Start main animations after splash fades
        setTimeout(() => {
            startMainAnimations();
            splash.remove();
        }, 600);

        sessionStorage.setItem('splash-seen', '1');
    }, 2200);
}

function startMainAnimations() {
    initScrollAnimations();
    initHeroSequence();
    initCounterAnimation();
}

/* --- 1. Scroll-triggered Animations (Intersection Observer) --- */

function initScrollAnimations() {
    const elements = document.querySelectorAll('.animate-on-scroll');

    if (!elements.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15,
        rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));

    // Auto-stagger: Find grids with [data-stagger] and apply stagger classes to children
    document.querySelectorAll('[data-stagger]').forEach(grid => {
        const children = grid.querySelectorAll('.animate-on-scroll');
        children.forEach((child, index) => {
            child.classList.add(`stagger-${Math.min(index + 1, 8)}`);
        });
    });
}

/* --- 2. Hero Entrance Sequence --- */

function initHeroSequence() {
    const heroSection = document.getElementById('home');
    if (!heroSection) return;

    // Gather hero elements by their data-hero-order attribute
    const heroElements = heroSection.querySelectorAll('[data-hero-order]');
    const sortedElements = Array.from(heroElements).sort(
        (a, b) => parseInt(a.dataset.heroOrder) - parseInt(b.dataset.heroOrder)
    );

    // Typing effect for subtitle
    const typingEl = heroSection.querySelector('[data-typing]');

    // Stagger the entrance of hero elements
    sortedElements.forEach((el, index) => {
        const delay = 200 + (index * 200); // Start at 200ms, 200ms apart
        setTimeout(() => {
            el.classList.add('visible');
        }, delay);
    });

    // Typing effect after main elements visible
    if (typingEl) {
        const text = typingEl.dataset.typing;
        typingEl.textContent = '';
        typingEl.classList.add('typing-container');

        let charIndex = 0;
        const startDelay = 600;

        setTimeout(() => {
            const typeInterval = setInterval(() => {
                typingEl.textContent += text.charAt(charIndex);
                charIndex++;
                if (charIndex >= text.length) {
                    clearInterval(typeInterval);
                    setTimeout(() => {
                        typingEl.classList.add('typing-done');
                    }, 1500);
                }
            }, 60);
        }, startDelay);
    }

    // Start scroll indicator bounce after sequence completes
    const scrollIndicator = heroSection.querySelector('[data-scroll-indicator]');
    if (scrollIndicator) {
        const totalDelay = 200 + (sortedElements.length * 200) + 400;
        setTimeout(() => {
            scrollIndicator.style.opacity = '1';
            scrollIndicator.classList.add('animate-bounce');
        }, totalDelay);
    }
}

/* --- 3. Counter Animation (Stats Numbers) --- */

function initCounterAnimation() {
    const counters = document.querySelectorAll('[data-counter]');

    if (!counters.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(el => observer.observe(el));
}

function animateCounter(el) {
    const target = parseInt(el.dataset.counter);
    const suffix = el.dataset.counterSuffix || '';
    const duration = 2000;
    const startTime = performance.now();

    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);

        // Ease out cubic
        const eased = 1 - Math.pow(1 - progress, 3);
        const current = Math.round(eased * target);

        el.textContent = current + suffix;

        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }

    requestAnimationFrame(update);
}

/* --- 4. Navbar Scroll Effects --- */

function initNavbarEffects() {
    const navbar = document.querySelector('[data-navbar]');
    if (!navbar) return;

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    }, { passive: true });
}

/* --- 5. Active Navigation Highlight --- */

function initActiveNavHighlight() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');

    if (!sections.length || !navLinks.length) return;

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
                });
            }
        });
    }, {
        threshold: 0.3,
        rootMargin: '-80px 0px -50% 0px'
    });

    sections.forEach(section => observer.observe(section));
}
