let lastScrollTop = 0; // Posición previa del scroll
const header = document.querySelector('.header'); // Selecciona el header

window.addEventListener('scroll', () => {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // Si haces scroll hacia abajo, oculta el menú
        header.style.top = '-100px'; // Ajusta según la altura del menú
    } else if (currentScroll === 0) {
        // Si estás en el tope superior, muestra el menú
        header.style.top = '0';
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // Actualiza la posición previa
});
