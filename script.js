document.addEventListener('DOMContentLoaded', () => {
    
    // --- Reveal Animations on Scroll ---
    const revealElements = document.querySelectorAll('.reveal');
    
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, {
        threshold: 0.1
    });

    revealElements.forEach((el, index) => {
        // Add a small delay for staggered effect
        el.style.transitionDelay = `${(index % 3) * 0.1}s`;
        revealObserver.observe(el);
    });

    // --- Hero Parallax Effect ---
    const hero = document.querySelector('.hero');
    const heroBg = document.querySelector('.hero-background');

    if (hero && heroBg) {
        hero.addEventListener('mousemove', (e) => {
            const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
            const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
            
            heroBg.style.transform = `translate(${moveX}px, ${moveY}px)`;
        });
    }

    // --- Smooth Anchor Links ---
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80, // Offset for navbar
                    behavior: 'smooth'
                });
            }
        });
    });

    // --- Navbar Scroll Effect ---
    const nav = document.querySelector('nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            nav.style.padding = '0.5rem 0';
            nav.style.background = 'rgba(5, 5, 5, 0.9)';
        } else {
            nav.style.padding = '0';
            nav.style.background = 'rgba(5, 5, 5, 0.7)';
        }
    });

    // --- Form Submission (AJAX) ---
    const contactForm = document.getElementById('contactForm');
    const formStatus = document.getElementById('formStatus');

    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            formStatus.style.display = 'block';
            formStatus.textContent = 'Enviando...';
            formStatus.className = '';

            // Simulate a network delay
            setTimeout(() => {
                formStatus.textContent = '¡Gracias! Tu mensaje ha sido enviado con éxito (Simulación local).';
                formStatus.className = 'success';
                contactForm.reset();
            }, 1500);
        });
    }
});
