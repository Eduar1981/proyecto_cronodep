(() => {
    const navLinks = document.querySelectorAll('header nav a');
    const currentPath = window.location.pathname.replace(/\/$/, '') || '/';

    navLinks.forEach((link) => {
        const linkPath = link.getAttribute('href').replace(/\/$/, '') || '/';
        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });
})();
