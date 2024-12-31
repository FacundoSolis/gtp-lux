document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const mobileMenu = document.querySelector('.mobile-menu');
    const closeButton = document.querySelector('.close-menu');
    const body = document.body;

    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function () {
            mobileMenu.classList.toggle('active');
            hamburgerMenu.classList.toggle('active');
            body.classList.toggle('no-scroll'); // Evitar scroll al abrir el menú móvil
        });
    }

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            hamburgerMenu.classList.remove('active');
            body.classList.remove('no-scroll');
        });
    }

    const menuLinks = document.querySelectorAll('.mobile-menu ul li a');
    if (menuLinks) {
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                mobileMenu.classList.remove('active');
                hamburgerMenu.classList.remove('active');
                body.classList.remove('no-scroll'); // Cerrar el menú al hacer clic en un enlace
            });
        });
    }
});
