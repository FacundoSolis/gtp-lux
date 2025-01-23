let lastScrollTop = 0; // Posición previa del scroll
const header = document.querySelector('.header'); // Selecciona el header

window.addEventListener('scroll', () => {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
    if (currentScroll > lastScrollTop) {
        // Scroll hacia abajo - Oculta el menú
        header.style.top = '-100px'; // Ajusta según la altura del menú
    } else {
        // Scroll hacia arriba - Muestra el menú
        header.style.top = '0';
    }
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Previene valores negativos
});
