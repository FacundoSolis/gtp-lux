document.addEventListener('DOMContentLoaded', function () {
    // Verifica si ya se ha aceptado o rechazado la cookie
    if (!document.cookie.includes('cookie_consent=accepted') && !document.cookie.includes('cookie_consent=rejected')) {
        // Crea y muestra el modal de cookies
        const cookieModal = document.createElement('div');
        cookieModal.id = 'cookieModal';
        cookieModal.style.position = 'fixed';
        cookieModal.style.bottom = '0';
        cookieModal.style.width = '100%';
        cookieModal.style.backgroundColor = 'white';
        cookieModal.style.color = '#333';
        cookieModal.style.padding = '20px';
        cookieModal.style.boxShadow = '0 -2px 10px rgba(0, 0, 0, 0.1)';
        cookieModal.style.zIndex = '1000';
        cookieModal.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <p style="flex: 1; margin: 0; font-size: 16px;">
                    Usamos cookies analíticas, de personalización y publicitarias (propias y de terceros) para mostrarte contenido útil y basado en tus preferencias de navegación. 
                    Para aceptar este tipo de cookies, pulsa el botón <strong>Aceptar todas las cookies</strong>; para rechazarlas pulsa el botón <strong>Rechazar todas las cookies</strong>; 
                    y para configurarlas pulsa en <strong><a href="/cookies" style="color: #007bff;">Configuración de cookies</a></strong>. 
                    Para más información, lee nuestra <a href="/cookies" style="color: #007bff;">Política de Cookies</a>.
                </p>
                <div style="display: flex; gap: 10px;">
                    <button id="rejectCookies" style="background: white; color: black; border: 1px solid black; padding: 10px 20px; cursor: pointer; border-radius: 5px;">
                        Rechazar todas las cookies
                    </button>
                    <button id="acceptCookies" style="background: black; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px;">
                        Aceptar todas las cookies
                    </button>
                </div>
            </div>
        `;
        document.body.appendChild(cookieModal);

        // Manejar la aceptación de cookies
        document.getElementById('acceptCookies').addEventListener('click', function () {
            // Guarda la cookie en el navegador
            document.cookie = 'cookie_consent=accepted; path=/; max-age=' + 60 * 60 * 24 * 365;

            // Oculta el modal
            document.getElementById('cookieModal').remove();
        });

        // Manejar el rechazo de cookies
        document.getElementById('rejectCookies').addEventListener('click', function () {
            // Guarda la cookie en el navegador
            document.cookie = 'cookie_consent=rejected; path=/; max-age=' + 60 * 60 * 24 * 365;

            // Oculta el modal
            document.getElementById('cookieModal').remove();
        });
    }
});
