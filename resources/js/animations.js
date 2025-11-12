function handleScrollAnimations() {
    document.querySelectorAll('.fade-in').forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100 && rect.bottom > 0) {
            const delay = el.style.getPropertyValue('--delay') || '0s';
            el.style.transitionDelay = delay;
            el.classList.add('visible');
        } else {
            el.classList.remove('visible');
        }
    });
}

document.addEventListener('DOMContentLoaded', handleScrollAnimations);
window.addEventListener('scroll', handleScrollAnimations);
