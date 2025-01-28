@extends('layouts.public')
@section('title', $meta_title ?? 'Princess V65 - Alquiler de barcos')
@section('meta_description', $meta_description ?? 'Descubre la Princess V65, un barco de lujo ideal para tus aventuras en el Mediterráneo.')
@section('meta_keywords', $meta_keywords ?? 'Princess V65, alquiler de barcos, lujo, Denia')

@php
    use Illuminate\Support\Facades\App;
@endphp
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/princess.css') }}">
    <link rel="stylesheet" href="{{ asset('css/effects.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

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
            <li class="li_links">
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

<section class="banner-card">
  <div class="banner-image" style="background-image: url('{{ asset('img/princess/princes-frontal2.jpg') }}');"></div>
  <div class="overlay"></div>
  <div class="banner-content">
    <h2>{{ __('princess_v65') }}</h2>
  </div>
</section>


<div class="slideshow-container">
  <div class="slides">
        <img src="{{ asset('img/princess/princess.jpg') }}" alt="Imagen 1">
        <img src="{{ asset('img/princess/princes7.jpg') }}" alt="Imagen 2">
        <img src="{{ asset('img/princess/princes1.jpg') }}" alt="Imagen 3">
        <img src="{{ asset('img/princess/princes2.jpg') }}" alt="Imagen 4">
        <img src="{{ asset('img/princess/princes3.jpg') }}" alt="Imagen 5">
        <img src="{{ asset('img/princess/princes4.jpg') }}" alt="Imagen 6">
        <img src="{{ asset('img/princess/princes5.jpg') }}" alt="Imagen 7">
        <img src="{{ asset('img/princess/princess6.jpg') }}" alt="Imagen 8">
        </div>
  <button class="slider-button-prev" onclick="scrollSlides(-1)">&#10094;</button>
  <button class="slider-button-next" onclick="scrollSlides(1)">&#10095;</button>
</div>

<section class="description-boat">
    <p>{!! __('princess_v65_section') !!}</p>
</section>

<!-- Modal de descripción -->
<div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modal-description-container">
        <!-- Aquí se cargará la descripción dinámicamente -->
      </div>
    </div>
  </div>
</div>

<!-- Características del barco -->
<main class="layout">
    <section class="characteristics">
        <h3>{{ __('boat_features') }}</h3>
        <div class="info-list">
            <div class="info-row light">
                <span><strong>{{ __('model') }}</strong></span>
                <span>Princess V65</span>
            </div>
            <div class="info-row">
                <span><strong>{{ __('length') }}</strong></span>
                <span>12m</span>
            </div>
            <div class="info-row light">
                <span><strong>{{ __('breadth') }}</strong></span>
                <span>4.5m</span>
            </div>
            <div class="info-row">
                <span><strong>{{ __('capacity') }}</strong></span>
                <span>12 personas</span>
            </div>
            <div class="info-row light">
                <span><strong>{{ __('crew') }}</strong></span>
                <span>2 personas</span>
            </div>
            <div class="info-row">
                <span><strong>{{ __('engine') }}</strong></span>
                <span>200CV</span>
            </div>
            <div class="info-row light">
                <span><strong>{{ __('equipment') }}</strong></span>
                <span>{{ __('sundeck') }}, {{ __('retractable_awning') }}, {{ __('music') }}, {{ __('fridge') }}</span>
            </div>
        </div>
    </section>

<!-- Especificaciones -->
<section class="right-boxes">
        <h3>{{ __('specifications') }}</h3>
        <div class="row">
            <div class="box">
                <i class="fa-solid fa-users"></i> {{ __('crew') }}
            </div>
            <div class="box">
                <i class="fa-solid fa-bed"></i> {{ __('bed_linen') }}
            </div>
            <div class="box">
                <i class="fa-solid fa-ship"></i> {{ __('autopilot') }}
            </div>
        </div>
        <div class="row">
            <div class="box">
                <i class="fa-solid fa-wind"></i> {{ __('air_conditioning') }}
            </div>
            <div class="box">
                <i class="fa-solid fa-car-battery"></i> {{ __('generator') }}
            </div>
        </div>
        <div class="row large">
            <div class="box">
                <i class="fa-solid fa-anchor"></i> {{ __('skipper') }}
            </div>
            <div class="box">
                <i class="fa-solid fa-music"></i> {{ __('external_speakers') }}
            </div>
        </div>
    </section> 
</main> 


<!-- Sección interactiva del barco -->
<section class="boat-details-section">
    <div class="model-container">
        <!-- Título dentro de la imagen -->
        <h2 class="model-title">{{ __('sunseeker_portofino_53') }} -3D</h2>
        <!-- Model-viewer para controlar manualmente -->
                <model-viewer
            id="boatModel"
            src="models/tripo_pbr_model_fc88fb62-435e-4823-98f4-af5d68f8e28a.glb"
            alt="Barco Sunseeker"
            camera-controls
            field-of-view="70deg"
            camera-orbit="75deg 80deg 3m"            
            style="display: block;">
        </model-viewer>
    </div>
</section>

@include('partials.progress-bar', ['step' => 1])


<div class="container">
    <h1 class="text-center">{{ __('calendar') }}</h1>
    <h4 class="text-center">{{ __('add_dates') }}</h4>
    
    <div class="row justify-content-between align-items-start">
        <!-- Columna del calendario -->
        <div class="col-md-6">
            <form id="reservation-form" action="{{ route('form') }}" method="GET">
            @csrf
                <input type="hidden" name="boat_id" value="3">

                <!-- Selección del puerto -->
                <div class="mb-3">
                    <label for="port_id" class="form-label">{{ __('port') }}</label>
                    <select id="port_id" name="port_id" class="form-control" required>
                        <option value="">{{ __('departure_place') }}</option>
                        @foreach($ports as $port)
                            <option value="{{ $port->id }}">{{ $port->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Selección de fechas -->
                <div class="row">
                    <div class="col">
                        <label for="pickup_date" class="form-label">{{ __('pickup_time') }}</label>
                        <input type="text" id="pickup_date" name="pickup_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                    </div>
                    <div class="col">
                        <label for="return_date" class="form-label">{{ __('delivery_time') }}</label>
                        <input type="text" id="return_date" name="return_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                    </div>
                </div>

                <!-- Calendario -->
                <div id="availability-calendar" class="calendar-wrapper mt-3">
                    <!-- Aquí se renderiza el calendario -->
                </div>
            </form>
        </div>

        <!-- Columna de la tarjeta de precios -->
        <div class="col-md-6">
            <section id="price-summary" class="price-card mt-3">
                <h5>Resumen de precios</h5>
                <p><strong>Total:</strong> <span id="total-price">0€</span></p>
                    <button id="price-list-button" class="btn btn-list-price mx-2">{{ __('check_price_list') }}</button>
                <form id="reservation-form" action="{{ route('form') }}" method="GET">
                @csrf
                <input type="hidden" name="port_id" id="hidden-port-id" value="{{ request('port_id') }}">
                    <input type="hidden" name="name" value="Reserva sin nombre">
                    <input type="hidden" name="pickup_date" id="hidden-pickup-date" value="{{ request('pickup_date') }}">
                    <input type="hidden" name="return_date" id="hidden-return-date" value="{{ request('return_date') }}">
                    <input type="hidden" name="boat_id" value="{{ request('boat_id') }}">
                    <input type="hidden" name="price" id="hidden-price" value="0">

                    <button type="submit" id="proceedToPaymentButton" class="btn btn-primary mt-3">{{ __('proceed_to_payment') }}</button>
                </form>
            </section>
        <!-- Detalles de precios -->
        <section class="pricing-details-columns">
                <div class="characteristics2">
                    <h3>{{ __('included_in_price') }}</h3>
                    <div class="info-list2">
                        <div class="info-row2"><span>{{ __('full_insurance') }}</span><span>✔</span></div>
                        <div class="info-row2"><span>{{ __('drinks') }}</span><span>✔</span></div>
                        <div class="info-row2"><span>{{ __('snorkel_gear') }}</span><span>✔</span></div>
                        <div class="info-row2"><span>{{ __('paddle_surf') }}</span><span>✔</span></div>
                        <div class="info-row2"><span>{{ __('towels') }}</span><span>✔</span></div>
                    </div>
                </div>
                <div class="characteristics3">
                    <h3>{{ __('not_included_in_price') }}</h3>
                    <div class="info-list3">
                        <div class="info-row3"><span>{{ __('fuel') }}</span><span>✘</span></div>
                        <div class="info-row3"><span>{{ __('premium_drinks') }}</span><span>✘</span></div>
                        <div class="info-row3"><span>{{ __('special_equipment') }}</span><span>✘</span></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Modal para lista de precios -->
<div id="priceListModal" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('check_price_list') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-price-list-container">
                <div id="price-list-content">Cargando precios...</div>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
  <div class="dual-section">
    <!-- Bloque del Clima -->
    <div class="weather-card">
      <h3 class="card-title">Condiciones Actuales</h3>
      <div class="iframe-container">
        <div id="ww_35f04e9f55df0" 
             v='1.3' 
             loc='id' 
             a='{"t":"horizontal","lang":"es","sl_lpl":1,"ids":["wl4500"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722"}'>
          Más previsiones: 
          <a href="https://oneweather.org/es/madrid/25_days/" id="ww_35f04e9f55df0_u" target="_blank">
            Previsión tiempo 30 días Madrid
          </a>
        </div>
        <script async src="https://app3.weatherwidget.org/js/?id=ww_35f04e9f55df0"></script>
      </div>
    </div>

    <!-- Bloque del Mapa -->
    <div class="map-card">
      <h3 class="card-title">Nuestra Ubicación</h3>
      <div class="iframe-container">
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6215.198940442461!2d0.12064989999999999!3d38.8416328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129e1adfd387435b%3A0xde918d9340020fd2!2sMarina%20de%20D%C3%A9nia!5e0!3m2!1ses!2ses!4v1737275044808!5m2!1ses!2ses"
          frameborder="0" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
    </div>
  </div>
</div>

<!-- Footer personalizado -->
<footer class="footer">
  <div class="footer-container">
    <!-- Columna 1: Logo y Redes Sociales -->
    <div class="footer-column">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo.png') }}" alt="{{ __('footer') }}" class="footer-logo">
      </a>
      <div class="social-icons">
        <p>{{ __('social_media') }}</p>
        <!-- Nuevos íconos sociales -->
        <div class="content-center">
          <ul>
            <li>
              <a href="https://www.facebook.com/" target="_blank">
                <i class="fa fa-facebook fa-2x"></i>
              </a>
            </li>
            <li>
              <a href="https://instagram.com/" target="_blank">
                <i class="fa fa-instagram fa-2x"></i>
              </a>
            </li>
          </ul>
        </div>
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
        <li><a href="{{ route('cancelacion') }}">{!! __('cancellation_policy') !!}</a></li>
        <li><a href="{{ route('nosotros') }}">{!! __('about_us') !!}</a></li>
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
    <script>
            window.additionalImages = [
                "{{ asset('img/val5.jpg') }}",
                "{{ asset('img/val6.jpg') }}",
                "{{ asset('img/val7.jpg') }}",
                "{{ asset('img/val8.jpg') }}"
    ];
    </script>

<script src="{{ asset('js/listapreciosportofino.js') }}"></script>
<script src="{{ asset('js/syncddate.js') }}"></script>
<script src="{{ asset('js/slider2.js') }}"></script>
<script src="{{ asset('js/effects.js') }}"></script>
<script src="{{ asset('js/boat2.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.5/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/es.js"></script>
<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('availability-calendar');
    const portSelect = document.getElementById('port_id');
    const pickupInput = document.getElementById('pickup_date');
    const returnInput = document.getElementById('return_date');
    const priceSummary = document.getElementById('price-summary');
    const totalPriceElement = document.getElementById('total-price');
    const boatId = 4; // ID del barco actualizado
    const priceListButton = document.getElementById('price-list-button');
    const priceListModal = new bootstrap.Modal(document.getElementById('priceListModal'));
    const urlParams = new URLSearchParams(window.location.search);
    const pickupDate = urlParams.get('pickup_date'); // 
    const queryParams = new URLSearchParams(window.location.search);
    const pickupDateFromUrl = queryParams.get('pickup_date'); // Fecha inicial desde la URL
    const returnDateFromUrl = queryParams.get('return_date'); // Fecha final desde la URL
    const dropdownContainer = document.querySelector('.dropdown');
    const dropdownValue = dropdownContainer.querySelector('.value');
    const languageDropdown = document.getElementById('languageDropdown');
    const hiddenPriceInput = document.getElementById('hidden-price');
    const proceedButton = document.getElementById('proceedToPaymentButton');
    const reservationForm = document.getElementById('reservation-form');
    const portIdInput = document.getElementById('hidden-port-id'); // Campo oculto del puerto
    const boatIdInput = document.querySelector('input[name="boat_id"]'); // Campo oculto del barco

    proceedButton.addEventListener('click', (event) => {
        event.preventDefault();

        // Validar que las fechas estén completas
        if (!pickupInput.value || !returnInput.value) {
            alert('Por favor selecciona las fechas antes de proceder.');
            return;
        }

        // Asegurarse de que el precio esté sincronizado
        if (totalPriceElement) {
            hiddenPriceInput.value = totalPriceElement.textContent.replace('€', '').trim();
        }

        // Construir la URL con los parámetros necesarios
        const params = new URLSearchParams({
            _token: document.querySelector('input[name="_token"]').value,
            boat_id: boatIdInput.value,
            port_id: portIdInput.value,
            pickup_date: pickupInput.value,
            return_date: returnInput.value,
            price: hiddenPriceInput.value, // Pasar el precio calculado
        });

        // Redirigir a la URL con los parámetros
        window.location.href = `/reservation/form?${params.toString()}`;
    });
    
    console.log('Pickup Date from URL:', pickupDateFromUrl); // Verificar si el valor se extrae correctamente
    console.log('Return Date from URL:', returnDateFromUrl);

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
        // Función para calcular el precio
        function calculatePrice(boatId, startDate, endDate) {
            if (!startDate || !endDate) return;

            axios
                .get('/calculate-price', {
                    params: { boat_id: boatId, start_date: startDate, end_date: endDate },
                })
                .then((response) => {
                    const totalPrice = response.data.total_price;
                    console.log('Precio calculado por el backend:', totalPrice); // Log del precio calculado
                    showPriceSummary(totalPrice);
                })
                .catch((error) => {
                    console.error('Error al calcular el precio:', error);
                    alert('No se pudo calcular el precio. Intenta nuevamente.');
                });
        }
        // Mostrar resumen de precios
        function showPriceSummary(totalPrice) {
            if (totalPriceElement && priceSummary) {
                totalPriceElement.textContent = `${totalPrice}€`;
                priceSummary.style.display = 'block';
            }
        }
            // Sincronizar fechas en los inputs con las de la URL
        if (pickupDateFromUrl) pickupInput.value = pickupDateFromUrl;
        if (returnDateFromUrl) returnInput.value = returnDateFromUrl;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            locale: 'es',
            initialView: 'dayGridMonth',
            initialDate: pickupDateFromUrl || new Date().toISOString().split('T')[0], // Usar fecha de la URL o actual
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: '',
            },
            buttonText: {
                today: 'Hoy',
                month: 'Mes',
                week: 'Semana',
                day: 'Día',
                list: 'Agenda',
            },
            events: async function (fetchInfo, successCallback, failureCallback) {
                try {
                    const portId = portSelect.value;
                    const endpoint = portId
                        ? `/reservations/calendar/${boatId}/${portId}`
                        : `/reservations/all/${boatId}`;

                    const response = await axios.get(endpoint, {
                        params: {
                            startDate: fetchInfo.startStr,
                            endDate: fetchInfo.endStr,
                        },
                    });

                    const events = response.data.map((reservation) => ({
                        title: reservation.available ? 'Disponible' : 'Reservado',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.available ? 'green' : 'red',
                    }));

                    successCallback(events);
                } catch (error) {
                    failureCallback(error);
                }
            },
            
            dateClick: function (info) {
            if (!pickupInput.value) {
                pickupInput.value = info.dateStr;
            } else if (!returnInput.value) {
                returnInput.value = info.dateStr;
            } else {
                pickupInput.value = info.dateStr;
                returnInput.value = '';
            }
            highlightSelectedDates(pickupInput.value, returnInput.value);
        },
    });    
    calendar.render();

    // Asegurar que el calendario se posicione en la fecha inicial
    if (pickupDateFromUrl) {
        calendar.gotoDate(pickupDateFromUrl);
        highlightSelectedDates(pickupDateFromUrl, returnDateFromUrl);
    }

    // Función para resaltar las fechas seleccionadas
    function highlightSelectedDates(startDate, endDate) {
        if (!startDate) return;

            const dayCells = document.querySelectorAll('.fc-day[data-date]');
        const selectedDates = [];

        // Restablece los estilos de todas las celdas
        dayCells.forEach((dayCell) => {
            dayCell.style.backgroundColor = '';
            dayCell.style.color = '';
        });

        let currentDate = new Date(startDate);
        const end = endDate ? new Date(endDate) : currentDate;

        while (currentDate <= end) {
            const dateStr = currentDate.toISOString().split('T')[0];
            const dayCell = document.querySelector(`.fc-day[data-date="${dateStr}"]`);
            if (dayCell) {
                dayCell.style.backgroundColor = '#007BFF';
                dayCell.style.color = '#fff';
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }
    }
        // Actualizar campos ocultos
        function updateHiddenFields() {
            document.querySelector('input[name="pickup_date"]').value = pickupInput.value;
            document.querySelector('input[name="return_date"]').value = returnInput.value;
            document.getElementById('hidden-pickup-date').value = pickupInput.value;
            document.getElementById('hidden-return-date').value = returnInput.value;
    // Sincroniza el precio calculado
    const totalPrice = totalPriceElement.textContent.replace('€', '').trim();
    document.getElementById('hidden-price').value = totalPrice;
    console.log('Hidden fields updated:', {
        pickup_date: pickupInput.value,
        return_date: returnInput.value,
        price: totalPrice,
    });
}

    // Escuchar cambios en los inputs
    pickupInput.addEventListener('change', () => {
        highlightSelectedDates(pickupInput.value, returnInput.value);
        updateHiddenFields();
    });

    returnInput.addEventListener('change', () => {
        highlightSelectedDates(pickupInput.value, returnInput.value);
        updateHiddenFields();
    });
    
    // Personalización visual
    const style = document.createElement('style');
    style.innerHTML = `
        .fc-day.fc-day-past {
            pointer-events: none;
            opacity: 0.5;
        }
        .fc-day[data-date] {
            transition: background-color 0.2s ease;
        }
        .fc-day-today {
            background-color: transparent !important;
            color: inherit !important;
        }
    `;
    document.head.appendChild(style);

    async function fetchAllReservations() {
        try {
            const response = await axios.get(`/reservations/all/${boatId}`);
            const events = response.data.map((reservation) => ({
                title: reservation.available ? 'Disponible' : 'Reservado',
                start: reservation.start,
                end: reservation.end,
                color: reservation.available ? 'green' : 'red',
            }));

            calendar.getEventSources().forEach((source) => source.remove());
            calendar.addEventSource(events);
        } catch (error) {
            console.error('Error al cargar todas las reservas:', error);
        }
    }

    fetchAllReservations();
});
</script>