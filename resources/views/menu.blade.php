<!-- resources/views/components/menu.blade.php -->
<header class="topbar {{ $isWelcomePage ? 'topbar--transparent' : '' }}">
    @if(!$isWelcomePage)
        <div class="topbar__logo">
            <a href="{{ route('welcome') }}">
            </a>
        </div>
    @endif
    <nav class="nav-menu">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
    <div class="hamburger-menu">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="mobile-menu">
        <span class="close-menu">✕</span>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="#quienes-somos">Quiénes somos</a></li>
            <li class="settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                    </span>
                    <ul>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/france.svg') }}" alt="Français" class="flag-icon"> Français
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/usa.svg') }}" alt="English" class="flag-icon"> English
                            </a>
                        </li>
                        <li>
                            <span class="selected">
                                <img src="{{ asset('img/flags/spain.svg') }}" alt="Español" class="flag-icon"> Español
                            </span>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/italy.svg') }}" alt="Italiano" class="flag-icon"> Italiano
                            </a>
                        </li>
                        <li>
                            <a href="#" class="language">
                                <img src="{{ asset('img/flags/germany.svg') }}" alt="Deutsch" class="flag-icon"> Deutsch
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const hamburgerMenu = document.querySelector('.hamburger-menu');
    const mobileMenu = document.querySelector('.mobile-menu');
    const menuLinks = document.querySelectorAll('.mobile-menu ul li a');
    const closeButton = document.querySelector('.close-menu');
    const body = document.body;

    // Alternar el estado del menú móvil
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

    // Cerrar menú móvil al hacer clic en la "X"
    closeButton.addEventListener('click', function () {
        mobileMenu.classList.remove('active');
        hamburgerMenu.classList.remove('active'); // Asegura que el icono vuelva a hamburguesa
        body.classList.remove('no-scroll'); // Habilita el scroll
    });

    // Cerrar el menú al hacer clic en un enlace
    menuLinks.forEach(link => {
        link.addEventListener('click', function () {
            mobileMenu.classList.remove('active'); // Ocultar menú móvil
            hamburgerMenu.classList.remove('active'); // Restaurar icono hamburguesa
            body.classList.remove('no-scroll'); // Habilita el scroll
        });
    });
});


</script>
