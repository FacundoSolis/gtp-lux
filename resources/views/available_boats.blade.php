@extends('layouts.public')
@php
    use Illuminate\Support\Facades\App;
@endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/available-boats.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@section('content')

<header class="header">
    <div class="topbar__logo">
        <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
    <nav class="navbar">
        <!-- Menú hamburguesa -->
        <label class="label_hamburguesa" for="menu_hamburguesa">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="list_icon" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </label>
        <input class="menu_hamburguesa" type="checkbox" id="menu_hamburguesa">

        <!-- Enlaces de navegación -->
        <ul class="ul_links">
            <li class="li_links"><a href="#" class="link">{{ __('home') }}</a></li>
            <li class="li_links"><a href="{{ url('pages/contacto') }}" class="link">{{ __('contact') }}</a></li>
            <li class="li_links"><a href="{{ url('pages/nosotros') }}" class="link">{{ __('about_us') }}</a></li>
            <li class="li_links settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img id="currentLanguageFlag" src="{{ asset('path_to_flags/' . App::getLocale() . '.png') }}" 
                             alt="{{ config('languages')[App::getLocale()]['name'] }}" class="flag-icon">
                        {{ config('languages')[App::getLocale()]['name'] }}
                    </span>
                    <ul class="dropdown-menu" id="languageDropdown">
                        @foreach (config('languages') as $code => $language)
                            <li>
                                <a href="{{ route('set-locale', $code) }}" class="language">
                                    <img src="{{ asset('path_to_flags/' . $code . '.png') }}" 
                                         alt="{{ $language['name'] }}" class="flag-icon">
                                    {{ $language['name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>

<!-- Contenedor principal -->
<main class="container">
    <h2>{{ __('available_boats') }}</h2>

    <div class="main-layout">
        <!-- Barra lateral con fechas -->   

        <div class="sidebar">
            <h4>{{ __('choose_date') }}</h4>
            <form action="{{ route('available.boats') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="port_id"><strong>{{ __('port') }}</strong></label>
                    <select id="port_id" name="port_id" class="form-control" required>
                        <option value="1" {{ $portId == 1 ? 'selected' : '' }}>Marina De Denia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup_date"><strong>{{ __('pickup_date') }}</strong></label>
                    <input type="text" id="pickup_date" name="pickup_date" value="{{ old('pickup_date', $pickupDate) }}" class="form-control date-picker" readonly>
                </div>

                <div class="form-group">
                    <label for="return_date"><strong>{{ __('drop_off_date') }}</strong></label>
                    <input type="text" id="return_date" name="return_date" value="{{ old('return_date', $returnDate) }}" class="form-control date-picker" readonly>
                </div>

                <button type="submit" class="btn-form">{{ __('update_search') }}</button>
            </form>
        </div>

        <!-- Tarjetas de barcos -->
        <div class="boat-cards">
            @include('partials.available_boats', [
                'boats' => $boats,
                'portId' => $portId,
                'pickupDate' => $pickupDate,
                'returnDate' => $returnDate,
            ])
        </div>
    </div>
</main>

<!-- Footer personalizado -->
<footer class="footer">
  <div class="footer-container">
    <!-- Columna 1: Logo y descripción -->
    <div class="footer-column">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="{{ __('footer') }}" class="footer-logo">
      </a>
      <div class="social-icons">
        <p>{{ __('social_media') }}</p>
        <a href="https://instagram.com" target="_blank">
          <img src="{{ asset('img/instagram.png') }}" alt="Instagram">
        </a>
        <a href="https://facebook.com" target="_blank">
          <img src="{{ asset('img/facebook.png') }}" alt="Facebook">
        </a>
      </div>
    </div>

  <!-- Columna 2: Contacto -->
  <div class="footer-column footer-align footer-offset">
      <p>{{ __('phone') }}: +34 910 059 958</p>
      <p>{{ __('email') }}: info@gtplux.com</p>
      <p>{{ __('location_address') }}</p>
  </div>
    <!-- Columna 3: Enlaces -->
    <div class="footer-column footer-align footer-offset">
      <ul class="footer-links">
        <li><a href="{{ route('aviso') }}">{!! __('legal_notice') !!}</a></li>
        <li><a href="{{ route('terminos') }}">{!! __('terms_and_conditions') !!}</a></li>
        <li><a href="{{ route('politicas') }}">{!! __('privacy_policy') !!}</a></li>
        <li><a href="{{ route('politicas') }}">{!! __('cancellation_policy') !!}</a></li>
        <li><a href="{{ route('nosotros') }}">{!! __('about_us_title') !!}</a></li>
        <li><a href="{{ route('contacto') }}">{!! __('contact') !!}</a></li>
      </ul>
    </div>

    <!-- Columna 4: Suscripción -->
    <div class="footer-column footer-align footer-offset">
      <p>Suscríbete a nuestro boletín para recibir las últimas noticias y ofertas.</p>
      <form class="subscribe-form">
      <input type="email" placeholder="{{ __('email') }}" class="subscribe-input">
      <button type="submit" class="subscribe-button">SUSCRIBE</button>
      </form>
    </div>
  </div>
</footer>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
$(document).ready(function () {
    const pickupDateInput = $("#pickup_date");
    const returnDateInput = $("#return_date");
    //const reservationForm = document.getElementById('reservation-form');
    const hiddenPriceInput = document.getElementById('hidden-price');
    const totalPriceElement = document.getElementById('total-price');
    const dropdownContainer = document.querySelector('.dropdown');
    const dropdownValue = dropdownContainer.querySelector('.value');
    const languageDropdown = document.getElementById('languageDropdown');

    // Abrir o cerrar el menú al hacer clic en el contenedor
    dropdownValue.addEventListener('click', function (event) {
        event.stopPropagation(); // Evita el cierre inmediato
        const isDropdownOpen = languageDropdown.style.display === 'block';
        languageDropdown.style.display = isDropdownOpen ? 'none' : 'block';
    });

    // Cerrar el menú al hacer clic fuera del dropdown
    document.addEventListener('click', function (event) {
        if (!dropdownContainer.contains(event.target)) {
            languageDropdown.style.display = 'none';
        }
    });

    // Manejar selección de idioma
    languageDropdown.querySelectorAll('.language').forEach(function (item) {
    item.addEventListener('click', function (event) {
        event.preventDefault(); // Evita la navegación del enlace

        const selectedLang = this.getAttribute('href').split('/').pop(); // Extraer idioma del enlace
        fetch(`/set-locale/${selectedLang}`) // Usa el idioma seleccionado dinámicamente
            .then(response => {
                if (response.ok) {
                    location.reload(); // Recargar la página para aplicar el cambio
                } else {
                    console.error('Error al cambiar el idioma.');
                }
            })
            .catch(error => console.error('Error en la solicitud de cambio de idioma:', error));

        // Cerrar el menú después de seleccionar un idioma
        languageDropdown.style.display = 'none';
    });
});

    // Estado para reiniciar fechas
    let lastPickupDate = null;

    // Inicializar Datepicker para Fecha de Recogida
    pickupDateInput.datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0, // No permitir fechas pasadas
        onSelect: function (selectedDate) {
            const selected = new Date(selectedDate);

            // Reiniciar si se selecciona la misma fecha
            if (lastPickupDate && lastPickupDate === selectedDate) {
                pickupDateInput.val(""); // Limpiar campo
                returnDateInput.val(""); // Limpiar devolución
                returnDateInput.datepicker("option", "minDate", null); // Restablecer restricciones
                lastPickupDate = null; // Resetear último valor
                return;
            }

            // Guardar última fecha seleccionada
            lastPickupDate = selectedDate;

            // Establecer la fecha mínima para la devolución
            returnDateInput.datepicker("option", "minDate", selected);
            returnDateInput.datepicker("setDate", null); // Limpiar fecha anterior

            // Abrir automáticamente el selector de devolución
            setTimeout(function () {
                returnDateInput.datepicker("show");
            }, 200); // Retardo para evitar cierres inesperados

            calculatePriceForBoats(); // Llamar a la función de cálculo de precios
        }
    });

    // Inicializar Datepicker para Fecha de Entrega
    returnDateInput.datepicker({
        dateFormat: "yy-mm-dd",
        minDate: pickupDateInput.val() ? new Date(pickupDateInput.val()) : 0, // Sincronizar con la fecha de recogida
        beforeShow: function () {
            const minDate = returnDateInput.datepicker("option", "minDate");
            if (minDate) {
                $(this).datepicker("option", "defaultDate", minDate);
            }
        },
        onSelect: function () {
            setTimeout(function () {
                returnDateInput.datepicker("hide");
            }, 200);

            calculatePriceForBoats(); // Llamar a la función de cálculo de precios
        }
    });

    // Evitar que el calendario se cierre al cambiar de mes
    $(".ui-datepicker").on("click", function (event) {
        event.stopPropagation();
    });

    // Cerrar los Datepickers si se hace clic fuera
    $(document).on("click", function (event) {
        if (!$(event.target).closest(".ui-datepicker, #pickup_date, #return_date").length) {
            pickupDateInput.datepicker("hide");
            returnDateInput.datepicker("hide");
        }
    });

    // Validación del formulario antes de enviar
    $("form").on("submit", function (e) {
        const pickupDate = pickupDateInput.val();
        const returnDate = returnDateInput.val();

        if (!pickupDate || !returnDate) {
            e.preventDefault(); // Prevenir el envío
            alert("Por favor selecciona ambas fechas.");
        }
    });

    // Función para calcular el precio dinámico
    function calculatePriceForBoats() {
        const pickupDate = pickupDateInput.val();
        const returnDate = returnDateInput.val();

        if (pickupDate && returnDate) {
            $(".boat-card").each(function () {
                const boatId = $(this).data("boat-id");
                const dailyPriceElement = $(`#daily-price-${boatId}`);

                if (boatId) {
                    axios.get(`/boats/${boatId}/daily-price`, {
                        params: {
                            start_date: pickupDate,
                            end_date: returnDate,
                        },
                    })
                    .then(function (response) {
                        const totalPrice = response.data.total_price || 0;
                        dailyPriceElement.text(totalPrice + "€");
                    })
                    .catch(function (error) {
                        console.error(`Error al calcular el precio para el barco ${boatId}:`, error);
                        dailyPriceElement.text("Error");
                    });
                }
            });
        }
    }

    // Llama a la función al cargar la página y al cambiar las fechas
    calculatePriceForBoats();

    $("#pickup_date, #return_date").on("change", function () {
        calculatePriceForBoats();
    });
    reservationForm.addEventListener('submit', function () {
        const totalPrice = totalPriceElement.textContent.replace('€', '').trim();
        hiddenPriceInput.value = totalPrice; // Actualiza el campo antes de enviar
    });
});
</script>
@endsection





