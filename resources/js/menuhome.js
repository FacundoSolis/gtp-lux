document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.welcome-hamburger-menu');
    const mobileMenu = document.querySelector('.welcome-mobile-menu');
    const closeButton = document.querySelector('.welcome-close-menu');
    const body = document.body;

    // Alternar el estado del menú móvil
    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', function () {
            const isActive = mobileMenu.classList.contains('active');
            if (isActive) {
                // Cerrar el menú
                mobileMenu.classList.remove('active');
                hamburgerMenu.classList.remove('active');
                body.classList.remove('no-scroll'); // Habilita el scroll
            } else {
                // Abrir el menú
                mobileMenu.classList.add('active');
                hamburgerMenu.classList.add('active');
                body.classList.add('no-scroll'); // Deshabilita el scroll
            }
        });
    }

    // Cerrar menú móvil al hacer clic en la "X"
    if (closeButton) {
        closeButton.addEventListener('click', function () {
            mobileMenu.classList.remove('active');
            hamburgerMenu.classList.remove('active');
            body.classList.remove('no-scroll');
        });
    }
});
