(() => {
    const navLinks = document.querySelectorAll('header nav a');
    const currentPath = window.location.pathname.replace(/\/$/, '') || '/';

    navLinks.forEach((link) => {
        const href = link.getAttribute('href') || '';
        const linkPath = href.replace(/\/$/, '') || '/';
        if (linkPath === '/') {
            if (currentPath === '/') {
                link.classList.add('active');
            }
            return;
        }

        if (currentPath.startsWith(linkPath)) {
            link.classList.add('active');
        }
    });
})();
