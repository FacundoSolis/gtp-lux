@extends('layouts.public')

@push('styles')
@vite('resources/css/menu.css')
@vite('resources/css/available-boats.css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
@endpush

@section('content')

<!-- Menú fijo -->
<header class="topbar">
    <div class="topbar__logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
    </div>

    <div class="topbar__settingsDropdowns">
        <div class="settingsDropdown js-language-dropdown" aria-label="Choose language">
            <div class="dropdown" tabindex="0">
                <span class="value" aria-label="Current language value">
                    <span>Español</span>
                </span>
                <ul>
                    <li><a href="#" class="language">Français</a></li>
                    <li><a href="#" class="language">English</a></li>
                    <li><span class="selected">Español</span></li>
                    <li><a href="#" class="language">Italiano</a></li>
                    <li><a href="#" class="language">Deutsch</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<!-- Contenedor principal -->
<main class="container">
    <h2>Barcos Disponibles</h2>

    <div class="main-layout">
        <!-- Barra lateral del calendario -->
        <div class="sidebar">
            <div id="availability-calendar" style="width: 100%; height: 400px;"></div> <!-- Aseguramos que el calendario tiene suficiente altura -->

            <!-- Información seleccionada dentro de un formulario -->
            <form class="selected-info">
                <div class="form-group">
                    <label for="port_id"><strong>Puerto:</strong></label>
                    <input type="text" id="port_id" value="{{ $portId ? 'Marina De Denia' : '' }}" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="dates"><strong>Fechas seleccionadas:</strong></label>
                    <input type="text" id="dates" value="{{ $pickupDate && $returnDate ? $pickupDate . ' - ' . $returnDate : '' }}" class="form-control" readonly>
                </div>
            </form>
        </div>

        <!-- Tarjetas de barcos -->
        <div class="boat-cards">
            @foreach ($boats as $boat)
                <div class="boat-card {{ $boat->isReserved($pickupDate, $returnDate) ? 'reserved' : 'available' }}">
                    <!-- Asignar la imagen de cada barco -->
                    @if ($boat->name == 'Sunseeker Portofino')
                        <img src="{{ asset('img/yates.png') }}" alt="Sunseeker Portofino" class="boat-card__image">
                    @elseif ($boat->name == 'Princess V65')
                        <img src="{{ asset('img/yates2.png') }}" alt="Princess V65" class="boat-card__image">
                    @endif

                    <div class="boat-card__details">
                        <h3 class="boat-card__name">{{ $boat->name }}</h3>
                        <p class="boat-card__description">{{ $boat->description }}</p>

                        <!-- Superposición de "Reservado" -->
                        @if ($boat->isReserved($pickupDate, $returnDate))
                            <div class="reserved-overlay">
                                <span>Reservado</span>
                            </div>
                        @endif

                        <!-- Botón "Seleccionar" que se desactiva si el barco está reservado -->
                        <a href="{{ route('boat.page', ['boat_id' => $boat->id, 'port_id' => $portId, 'pickup_date' => $pickupDate, 'return_date' => $returnDate]) }}" 
                           class="btn-form {{ $boat->isReserved($pickupDate, $returnDate) ? 'disabled' : '' }}">
                            Seleccionar {{ $boat->name }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</main>

@endsection

@push('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.css">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.js"></script>

<script>
    const calendarEl = document.getElementById('availability-calendar');
    const portSelect = document.getElementById('port_id');
    const pickupInput = document.getElementById('pickup_date');
    const returnInput = document.getElementById('return_date');

    const calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        locale: 'es',
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '',
        },
        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
                const portId = portSelect.value;
                const selectedStartDate = pickupInput.value;
                const selectedEndDate = returnInput.value;

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

            if (!pickupInput.value) {
                pickupInput.value = clickedDate;
                const pickupDate = new Date(clickedDate);
                returnInput.setAttribute('min', pickupDate.toISOString().split('T')[0]);
            } else if (!returnInput.value) {
                returnInput.value = clickedDate;
            } else {
                pickupInput.value = clickedDate;
                returnInput.value = '';
                returnInput.removeAttribute('min');
            }
        },
    });

    pickupInput.addEventListener('click', function () {
        calendarEl.style.display = 'block';
        calendar.render();
    });

    returnInput.addEventListener('click', function () {
        calendarEl.style.display = 'block';
        calendar.render();
    });

    calendar.render();

</script>
@endpush
