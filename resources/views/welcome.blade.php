@extends('layouts.public')
@section('title', 'Alquiler de Barcos en Denia - GtpLux')
@section('meta_description', 'Descubre los mejores barcos en Denia para disfrutar del mar Mediterráneo con GtpLux.')
@section('meta_keywords', 'barcos, alquiler, Denia, Mediterráneo, lujo')
@php
    use Illuminate\Support\Facades\App;

@endphp

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/menuhome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  

@endpush

  <!-- Banner Section -->
@section('content')

<header class="header">
    <nav class="navbar">
        <!-- Menú hamburguesa -->
        <label class="label_hamburguesa" for="menu_hamburguesa">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="list_icon" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </label>
        <input class="menu_hamburguesa" type="checkbox" id="menu_hamburguesa">
        <ul class="ul_links">
            <li class="li_links"><a href="{{ url('/') }}" class="link">{{ __('home') }}</a></li>
            <li class="li_links"><a href="{{ url('pages/contacto') }}" class="link">{{ __('contact') }}</a></li>
            <li class="li_links"><a href="{{ url('pages/nosotros') }}" class="link">{{ __('about_us') }}</a></li>
            <li class="li_links settingsDropdown">
                <div class="dropdown">
                    <span class="value">
                        <img id="currentLanguageFlag" src="{{ asset('path_to_flags/' . App::getLocale() . '.png') }}" 
                             alt="{{ __('' . config('languages')[App::getLocale()]['name']) }}" class="flag-icon">
                        {{ __('' . config('languages')[App::getLocale()]['name']) }}
                    </span>
                    <ul class="dropdown-menu" id="languageDropdown">
                        @foreach (config('languages') as $code => $language)
                            <li>
                                <a href="{{ route('set-locale', $code) }}" class="language">
                                    <img src="{{ asset('path_to_flags/' . $code . '.png') }}" 
                                         alt="{{ __('' . $language['name']) }}" class="flag-icon">
                                    {{ __('' . $language['name']) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        </ul>
    </nav>
</header>

<section class="banner">
  <video class="banner-video" autoplay muted loop>
    <source src="{{ asset('img/video-banner.mp4') }}" type="video/mp4">
  </video>
  <div class="overlay"></div>
  <div class="banner-content">
    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    <h1>{{ __('boat_rental_in_denia') }}</h1>
    <h2>{{ __('gtp_lux_sun_mediterranean_sea') }}</h2>
  </div>
</section>

<!-- Formulario de reserva en forma de card centrado -->
<div class="reservation-form-wrapper">
    <div class="container">
        <div class="card mx-auto" style="width: 70%;">
            <div class="card-body">
                <!-- El formulario ahora se dirige a la ruta 'available.boats' -->
                <form action="{{ route('available.boats') }}" method="GET">
                    @csrf
                    <div class="mb-3">
                      <label for="port_id" class="form-label">{{ __('port') }}</label>
                      <select id="port_id" name="port_id" class="form-control" required style="display: block !important;">
                        <option value="">{{ __('departure_place') }}</option>
                        <option value="1">{{ __('marina_de_denia') }}</option>
                        </select>
                    </div>
                    
                    <div class="mb-3 row">
                        <div class="col">
                          <label for="pickup_date" class="form-label">{{ __('pickup_date') }}</label>
                          <input type="text" id="pickup_date" name="pickup_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                        </div>
                        <div class="col">
                          <label for="return_date" class="form-label">{{ __('drop_off_date') }}</label>
                          <input type="text" id="return_date" name="return_date" class="form-control date-picker" placeholder="DD/MM/AAAA" readonly required>
                        </div>
                    </div>

                    <!-- Contenedor para el calendario -->
                    <div id="availability-calendar" style="width: 100%; height: 300px; display: none;"></div>
                    <button type="submit" class="btn-form">{{ __('search_boat') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="highlight-section">
  <h2 class="highlight-title">{{ __('unforgettable_experience') }}</h2>
</section>


<!-- Slider -->
<section id="slider" class="slider-container">
  <!-- Primera sección: Imagen derecha, texto izquierda -->
  <div class="info-row">
    <div class="slider-with-arrows">
      <button class="prev">&lt;</button>
      <div class="slider">
        <div class="slides">
          <img src="{{ asset('img/protofino/Portofino.png') }}" alt="Imagen 1">
          <img src="{{ asset('img/protofino/portofino2.jpg') }}" alt="Imagen 2">
      </div>
    </div>
      <button class="next">&gt;</button>
  </div>
  <div class="info-text">
    <h3>{{ __('sunseeker_portofino_53') }}</h3>
    <p>{{ __('sunseeker_portofino_53_description') }}</p>
    <a href="{{ route('sunseeker', ['boat_id' => 3, 'port_id' => 1]) }}">
      <button id="reservation-btn" class="btn">{{ __('more_info') }}</button>
    </a>
  </div>
</div>

<!-- Segunda sección: Imagen izquierda, texto derecha -->
<div class="info-row reverse">
  <div class="slider-with-arrows">
    <button class="prev">&lt;</button>
    <div class="slider">
      <div class="slides">
        <img src="{{ asset('img/princess/princess.jpg') }}" alt="Imagen 1">
        <img src="{{ asset('img/princess/princes7.jpg') }}" alt="Imagen 2">
      </div>
      </div>
     <button class="next">&gt;</button>
  </div>
  <div class="info-text">
    <h3>{{ __('princess_v65') }}</h3>
    <p>{{ __('princess_v65_description') }}</p>
      <a href="{{ route('princess', ['boat_id' => 4, 'port_id' => 1]) }}">
        <button id="reservation-btn" class="btn">{{ __('more_info') }}</button>
      </a>
  </div>
</div>
</section>

<!-- Mapa -->
<section class="map-form">
  <div class="map-container">
    <h3 class="map-title">{{ __('our_location') }}</h3>
    <!-- Aquí está el iframe con el mapa de Google -->
    <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6215.198940442461!2d0.12064989999999999!3d38.8416328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x129e1adfd387435b%3A0xde918d9340020fd2!2sMarina%20de%20D%C3%A9nia!5e0!3m2!1ses!2ses!4v1737275044808!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</iframe>
  </div>
</section>

<section class="section-title py-5">
    <div class="container text-center">
        {!! __('h1_title_home') !!}
        {!! __('h1_p_home') !!}
    </div>
</section>

<section class="section-one py-5">
    <div class="container">
        <div class="row align-items-center-1">
            <div class="col-md-6">
                <img src="{{ asset('img/princess/princes7.jpg') }}" alt="Imagen 1" class="img-fluid rounded">
            </div>
            <div class="col-md-6 text-right">
                <h2 class="title-one">{!! __('h2_title_home_1') !!}</h2>
                <p class="paragraph-one">{!! __('h2_p_home_1') !!}</p>
            </div>
        </div>
    </div>
</section>

<section class="section-two py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Texto a la izquierda -->
            <div class="col-md-6 text-left">
                <h2 class="title-two">{!! __('h2_title_home_2') !!}</h2>
                <p class="paragraph-two">{!! __('h2_p_home_2') !!}</p>
            </div>
            <!-- Imagen a la derecha -->
            <div class="col-md-6 image-right">
                <img src="{{ asset('img/protofino/portofino.copa.jpeg') }}" alt="Imagen 2" class="img-fluid rounded">
            </div>
        </div>
    </div>
</section>

<section class="section-three py-5">
    <div class="container">
        <div class="row align-items-center">
            <!-- Imagen a la izquierda -->
            <div class="col-md-6 image-left">
                <img src="{{ asset('img/protofino/portofino2.jpg') }}" alt="Imagen 3" class="img-fluid rounded">
            </div>
            <!-- Texto a la derecha -->
            <div class="col-md-6 text-right">
                <h2 class="title-three">{!! __('h2_title_home_3') !!}</h2>
                <p class="paragraph-three">{!! __('h2_p_home_3') !!}</p>
            </div>
        </div>
    </div>
</section>
<section class="faq-section2 py-5 bg-light2">
    <div class="container2">
        <h2 class="title-faq2">{!! __('h2_title_home_4') !!}</h2>
        <div class="row">
            <!-- Primera columna -->
            <div class="col-md-6">
                <div class="accordion" id="faqAccordionLeft">
                    @php
                        $faqs = json_decode(__('h2_p_home_4'), true);
                        $half = ceil(count($faqs) / 2); // Dividir en dos grupos
                    @endphp
                    @foreach (array_slice($faqs, 0, $half) as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeaderLeft{{ $faq['id'] }}">
                                <button class="accordion-button collapsed no-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeft{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapseLeft{{ $faq['id'] }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapseLeft{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="faqHeaderLeft{{ $faq['id'] }}" data-bs-parent="#faqAccordionLeft">
                                <div class="accordion-body">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- Segunda columna -->
            <div class="col-md-6">
                <div class="accordion" id="faqAccordionRight">
                    @foreach (array_slice($faqs, $half) as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeaderRight{{ $faq['id'] }}">
                                <button class="accordion-button collapsed no-icon" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRight{{ $faq['id'] }}" aria-expanded="false" aria-controls="collapseRight{{ $faq['id'] }}">
                                    {{ $faq['question'] }}
                                </button>
                            </h2>
                            <div id="collapseRight{{ $faq['id'] }}" class="accordion-collapse collapse" aria-labelledby="faqHeaderRight{{ $faq['id'] }}" data-bs-parent="#faqAccordionRight">
                                <div class="accordion-body">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>




<section>
  <div class="form-container">
    <div class="form-card">
      <h3>{{ __('have_questions') }}</h3>
      <form>
        <label for="nombre">{{ __('name') }}</label>
        <input type="text" id="nombre" name="nombre" placeholder="{{ __('example') }} Juan">

        <label for="apellido">{{ __('surname') }}</label>
        <input type="text" id="apellido" name="apellido" placeholder="{{ __('example') }} Pérez">

        <label for="telefono">{{ __('phone') }}</label>
        <input type="tel" id="telefono" name="telefono" placeholder="{{ __('example') }} +34 600 000 000">

        <label for="correo">{{ __('email') }}</label>
        <input type="email" id="correo" name="correo" placeholder="{{ __('example') }} juan.perez@correo.com">

        <label for="motivo">{{ __('subject') }}</label>
        <textarea id="motivo" name="motivo" placeholder="{{ __('help_text') }}"></textarea>

        <button class="form-button">{{ __('send') }}</button>
      </form>
    </div>
  </div>
</section>


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

<!-- Scripts -->
@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('js/slider.js') }}"></script>
  <script src="{{ asset('js/menuhome.js') }}"></script>
  <script src="{{ asset('js/cookieConsent.js') }}"></script>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> <!-- jQuery UI CSS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function () {
      const form = document.querySelector('form'); 
      const calendarEl = document.getElementById('availability-calendar');
      const portSelect = document.getElementById('port_id');
      const pickupInput = document.getElementById('pickup_date');
      const returnInput = document.getElementById('return_date');
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
      // Obtener las fechas seleccionadas, si existen
      const selectedStartDate = '{{ request()->pickup_date }}'; // Fecha de recogida
      const selectedEndDate = '{{ request()->return_date }}'; // Fecha de entrega
      
      if (form) {
        form.addEventListener('submit', function (e) {
            console.log('Formulario enviado');
          });

      // Establecer las fechas en los campos de fecha si ya están en la URL
      if (selectedStartDate) pickupInput.value = selectedStartDate;
      if (selectedEndDate) returnInput.value = selectedEndDate;

      // Inicializa FullCalendar
      const calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap',
          locale: 'es',
          initialView: 'dayGridMonth',
          headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: "",
          },
          events: async function (fetchInfo, successCallback, failureCallback) {
              try {
                  const portId = portSelect.value;
                  if (!portId || !selectedStartDate || !selectedEndDate) {
                      successCallback([]);
                      return;
                  }

                  const response = await axios.get(`/reservations/calendar/${portId}`, {
                      params: {
                          startDate: fetchInfo.startStr,
                          endDate: fetchInfo.endStr,
                      },
                  });

                  const reservations = response.data;
                  const events = reservations.map(reservation => ({
                      title: reservation.available ? 'Disponible' : 'Reservado',
                      start: reservation.start,
                      end: reservation.end,
                      color: reservation.available ? 'green' : 'red',
                      extendedProps: { available: reservation.available },
                  }));

                  successCallback(events);
              } catch (error) {
                  console.error('Error al cargar las reservas:', error);
                  failureCallback(error);
              }
          },
          dateClick: function (info) {
              const clickedDate = info.dateStr;

              // Si no se ha seleccionado fecha de recogida, selecciona la fecha de recogida
              if (!pickupInput.value) {
                  pickupInput.value = clickedDate;
                  // Establece la fecha mínima para la fecha de entrega
                  const pickupDate = new Date(clickedDate);
                  returnInput.setAttribute('min', pickupDate.toISOString().split('T')[0]);
              }
              // Si ya se ha seleccionado la fecha de recogida, selecciona la fecha de entrega
              else if (!returnInput.value) {
                  returnInput.value = clickedDate;
              }
              // Si ya se han seleccionado ambas fechas, reiniciar la selección
              else {
                  pickupInput.value = clickedDate;
                  returnInput.value = ''; // Limpiar la fecha de entrega
                  returnInput.removeAttribute('min'); // Remover la restricción mínima
              }
          },
      });

      // Mostrar el calendario cuando se hace clic en los campos de fecha
      pickupInput.addEventListener('click', function () {
          calendarEl.style.display = 'block';  // Muestra el calendario
          calendar.render();  // Renderiza el calendario
      });

      returnInput.addEventListener('click', function () {
          calendarEl.style.display = 'block';  // Muestra el calendario
          calendar.render();  // Renderiza el calendario
      });

      // Validación del formulario antes de enviarlo
      form.addEventListener('submit', function (e) {
          // Restablecer mensaje de error
          errorMessage.textContent = '';

          // Verificar si el puerto, las fechas de recogida y entrega están vacíos
          if (!portSelect.value || !pickupInput.value || !returnInput.value) {
              e.preventDefault(); // Evitar el envío del formulario
              errorMessage.textContent = '¡Por favor, selecciona un puerto y ambas fechas (recogida y entrega)!'; // Mostrar mensaje de error
          }
      });

      // Cerrar el calendario si se hace clic fuera de él
      document.addEventListener('click', function (event) {
          if (!calendarEl.contains(event.target) && !event.target.matches('#pickup_date, #return_date')) {
              calendarEl.style.display = 'none';  // Oculta el calendario
          }
      });

      calendar.render();

}});

</script>
@endsection
