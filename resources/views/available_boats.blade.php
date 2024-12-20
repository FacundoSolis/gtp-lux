@extends('layouts.public')

@push('styles')
@vite('resources/css/menu.css')
@vite('resources/css/available-boats.css')
@vite('resources/js/calendar.js')
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
            <div id="availability-calendar" style="width: 100%; height: 400px;"></div>
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
            @include('partials.available_boats', [
                'boats' => $boats,
                'portId' => $portId,
                'pickupDate' => $pickupDate,
                'returnDate' => $returnDate,
            ])
        </div>
    </div>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/main.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('availability-calendar');
    const portId = '{{ request()->port_id }}';
    const boatsContainer = document.querySelector('.boat-cards');
    const initialDate = pickupDate || new Date().toISOString().split('T')[0]; // Usar la fecha pasada o la actual

    // Fechas iniciales pasadas desde la URL o inputs
    const pickupDate = '{{ request()->pickup_date }}';
    const returnDate = '{{ request()->return_date }}';

    const pickupInput = document.getElementById('pickup_date') || {};
    const returnInput = document.getElementById('return_date') || {};

    if (pickupDate) pickupInput.value = pickupDate;
    if (returnDate) returnInput.value = returnDate;

    const calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap',
        locale: 'es',
        initialView: 'dayGridMonth',
        initialDate: initialDate, // Configurar fecha inicial correctamente
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: '',
        },
        selectable: true,
        dateClick: function (info) {
            handleDateSelection(info.dateStr);
        },
        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
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
                }));
                successCallback(events);
            } catch (error) {
                console.error('Error al cargar eventos:', error);
                failureCallback(error);
            }
        },
    });

    calendar.render();

    function handleDateSelection(dateStr) {
        if (!pickupInput.value) {
            pickupInput.value = dateStr;
        } else if (!returnInput.value) {
            if (new Date(dateStr) <= new Date(pickupInput.value)) {
                alert('La fecha de entrega debe ser posterior a la fecha de recogida.');
                return;
            }
            returnInput.value = dateStr;
            updateAvailableBoats();
        } else {
            pickupInput.value = dateStr;
            returnInput.value = '';
        }
        highlightSelectedDates();
    }

    function handleDateSelection(dateStr) {
    if (!pickupInput.value) {
        pickupInput.value = dateStr;
    } else if (!returnInput.value) {
        if (new Date(dateStr) <= new Date(pickupInput.value)) {
            alert('La fecha de entrega debe ser posterior a la fecha de recogida.');
            return;
        }
        returnInput.value = dateStr;
        updateAvailableBoats();
    } else {
        pickupInput.value = dateStr;
        returnInput.value = '';
    }
    highlightSelectedDates();
}

async function updateAvailableBoats() {
    try {
        boatsContainer.innerHTML = '<p>Cargando barcos disponibles...</p>';
        const response = await axios.get('/available-boats', {
            params: {
                port_id: portId,
                pickup_date: pickupInput.value,
                return_date: returnInput.value,
            },
        });
        boatsContainer.innerHTML = response.data;
    } catch (error) {
        console.error('Error al cargar barcos disponibles:', error);
        boatsContainer.innerHTML = '<p>Error al cargar los barcos disponibles.</p>';
    }
}


    updateAvailableBoats();
    highlightSelectedDates();
});


</script>
@endsection
