document.addEventListener('DOMContentLoaded', function () {
    // --- Función para manejar los dropdowns de idiomas ---
    function setupLanguageDropdowns(selector) {
        const dropdowns = document.querySelectorAll(selector);

        dropdowns.forEach(dropdown => {
            const valueSpan = dropdown.querySelector('.value'); // Elemento que muestra el idioma seleccionado
            const languageOptions = dropdown.querySelectorAll('ul li a'); // Opciones de idiomas

            languageOptions.forEach(option => {
                option.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Actualizar el idioma seleccionado en la interfaz
                    const selectedLanguageHTML = this.innerHTML; // Contenido completo (flag + texto)
                    valueSpan.innerHTML = selectedLanguageHTML;

                    // Obtener el código del idioma seleccionado
                    const selectedLangCode = this.getAttribute('data-lang-code');

                    // Cambiar idioma en el servidor
                    updateLanguage(selectedLangCode);
                });
            });
        });
    }

    // --- Función para enviar el idioma seleccionado al servidor ---
    function updateLanguage(langCode) {
        fetch(`/set-language?lang=${langCode}`, {
            method: 'GET',
        })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Recargar la página para aplicar el nuevo idioma
                } else {
                    console.error('Error al cambiar el idioma');
                }
            })
            .catch(error => console.error('Error al realizar la petición:', error));
    }

    // Inicializar dropdowns de idiomas en escritorio y móvil
    setupLanguageDropdowns('.dropdown');

    // --- Menú Móvil ---
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
