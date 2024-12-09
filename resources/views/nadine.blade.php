@extends('layouts.app')


@section('content')
<link rel="stylesheet" href="{{ asset('css/valkyrya.css') }}">

<!-- Slider de imágenes y características del barco -->
<section class="container-valkyrya">
    <h2>TORINO</h2>

    <div class="slider-valkyrya">
        <div class="slides-valkyrya">
            <img src="{{ asset('img/val1.jpg') }}" alt="Imagen 1">
            <img src="{{ asset('img/val2.jpg') }}" alt="Imagen 2">
            <img src="{{ asset('img/val3.jpg') }}" alt="Imagen 3">
            <img src="{{ asset('img/val4.jpg') }}" alt="Imagen 4">
            <img src="{{ asset('img/val5.jpg') }}" alt="Imagen 5">
            <img src="{{ asset('img/val6.jpg') }}" alt="Imagen 6">
            <img src="{{ asset('img/val7.jpg') }}" alt="Imagen 7">
            <img src="{{ asset('img/val8.jpg') }}" alt="Imagen 8">
            <img src="{{ asset('img/val9.jpg') }}" alt="Imagen 9">
        </div>
        <span class="prev" onclick="moveSlide(-1)">&#10094;</span>
        <span class="next" onclick="moveSlide(1)">&#10095;</span>
    </div>
</section>

<!-- Características del barco -->
<main class="layout">
    <section class="characteristics">
        <h3>Características del Barco</h3>
        <div class="info-list">
            <div class="info-row light">
                <span><strong>Modelo:</strong></span>
                <span>Sunseeker Portofino 53</span>
            </div>
            <div class="info-row">
                <span><strong>Eslora:</strong></span>
                <span>12m</span>
            </div>
            <div class="info-row light">
                <span><strong>Manga:</strong></span>
                <span>4.5m</span>
            </div>
            <div class="info-row">
                <span><strong>Capacidad:</strong></span>
                <span>12 personas</span>
            </div>
            <div class="info-row light">
                <span><strong>Tripulación:</strong></span>
                <span>2 personas</span>
            </div>
            <div class="info-row">
                <span><strong>Motor:</strong></span>
                <span>200CV</span>
            </div>
            <div class="info-row light">
                <span><strong>Equipamiento:</strong></span>
                <span>Solarium, toldo retráctil, música, nevera</span>
            </div>
        </div>
    </section>

    <!-- Especificaciones -->
    <section class="right-boxes">
        <h3>Especificaciones</h3>
        <div class="row">
            <div class="box">Ícono 1</div>
            <div class="box">Ícono 2</div>
            <div class="box">Ícono 3</div>
        </div>
        <div class="row">
            <div class="box">Ícono 4</div>
            <div class="box">Ícono 5</div>
            <div class="box">Ícono 6</div>
        </div>
        <div class="row large">
            <div class="box">Ícono 7</div>
            <div class="box">Ícono 8</div>
        </div>
    </section>
</main>

<!-- Detalles de precios -->
<section class="pricing-details-columns">
    <div class="characteristics2">
        <h3>Incluido en el Precio</h3>
        <div class="info-list2">
            <div class="info-row2"><span>Seguro a todo riesgo</span><span>✔</span></div>
            <div class="info-row2"><span>Bebidas</span><span>✔</span></div>
            <div class="info-row2"><span>Equipo snorkel</span><span>✔</span></div>
            <div class="info-row2"><span>Paddle surf</span><span>✔</span></div>
            <div class="info-row2"><span>Toallas</span><span>✔</span></div>
        </div>
    </div>
    <div class="characteristics3">
        <h3>No Incluido en el Precio</h3>
        <div class="info-list3">
            <div class="info-row3"><span>Combustible</span><span>✘</span></div>
            <div class="info-row3"><span>Bebidas premium</span><span>✘</span></div>
            <div class="info-row3"><span>Equipos Especiales</span><span>✘</span></div>
        </div>
    </div>
</section>

<!-- Formulario de reserva -->
<div class="container">
    <h1>Reserva de Barco - Nadine</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form id="reservation-form" action="{{ route('reserve.nadine') }}" method="POST">
        @csrf
        <input type="hidden" name="boat_id" value="{{ $boatId }}">

        <!-- Selección de puerto -->
        <div class="mb-3">
            <label for="port_id" class="form-label">Puerto:</label>
            <select id="port_id" name="port_id" class="form-control" required>
                <option value="">Seleccione un puerto</option>
                @foreach($ports as $port)
                    <option value="{{ $port->id }}">{{ $port->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Información del cliente -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" id="name" name="name" class="form-control" placeholder="Ingrese su nombre" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico:</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="tel" id="phone" name="phone" class="form-control" placeholder="Ingrese su teléfono" required>
        </div>

        <!-- Calendario de disponibilidad -->
        <div id="availability-calendar" style="min-height: 400px; border: 1px solid #ccc; display: none;"></div>

        <!-- Fechas seleccionadas -->
        <div class="row">
            <div class="col">
                <label for="pickup_date" class="form-label">Fecha de Recogida:</label>
                <input type="text" id="pickup_date" name="pickup_date" class="form-control" readonly required>
            </div>
            <div class="col">
                <label for="return_date" class="form-label">Fecha de Entrega:</label>
                <input type="text" id="return_date" name="return_date" class="form-control" readonly required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Reservar</button>
    </form>
</div>



<!-- Footer -->
<footer>
    <div class="footer-container">
        <div class="footer-left">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="footer-logo">
            <div class="social-icons">
                <a href="https://instagram.com" target="_blank"><img src="{{ asset('img/instagram.png') }}" alt="Instagram"></a>
                <a href="https://facebook.com" target="_blank"><img src="{{ asset('img/facebook.png') }}" alt="Facebook"></a>
            </div>
            <p class="contact-email">contacto@empresa.com</p>
            <p class="location">Marina Naviera Balear, Av. de Gabriel Roca, 07013 Palma, Balearic Islands</p>
        </div>
        <div class="footer-right"></div>
    </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('availability-calendar');
        const portSelect = document.getElementById('port_id');
        const boatId = @json($boatId); // Este será el ID específico para Nadine.

        let selectedPickupDate = null;
        let selectedReturnDate = null;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            locale: 'es',
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: async function (fetchInfo, successCallback, failureCallback) {
                try {
                    const portId = portSelect.value; // Obtener el puerto seleccionado
                    if (!portId) {
                        successCallback([]);
                        return;
                    }

                    const response = await axios.get(`/reservations/calendar/${boatId}/${portId}`, {
                        params: {
                            startDate: fetchInfo.startStr,
                            endDate: fetchInfo.endStr
                        }
                    });

                    const reservations = response.data;

                    const events = reservations.map(reservation => ({
                        title: reservation.available ? 'Disponible' : 'Reservado',
                        start: reservation.start,
                        end: reservation.end,
                        color: reservation.available ? 'green' : 'red', // Verde para disponibles, rojo para reservados
                        extendedProps: { available: reservation.available }, // Marcar días disponibles
                    }));

                    successCallback(events);
                } catch (error) {
                    console.error('Error al cargar las reservas:', error);
                    failureCallback(error);
                }
            },
            dateClick: function (info) {
                // Comprobar si el día está reservado dentro de un rango
                const clickedEvent = calendar.getEvents().find(event =>
                    !event.extendedProps.available &&
                    info.date >= new Date(event.start) &&
                    info.date < new Date(event.end) // Comprueba el rango completo
                );

                if (clickedEvent) {
                    alert('Este rango de fechas ya está reservado. Por favor selecciona otro.');
                    return;
                }

                // Actualizar fechas seleccionadas
                if (!selectedPickupDate) {
                    selectedPickupDate = info.dateStr;
                    document.getElementById('pickup_date').value = selectedPickupDate;
                } else if (!selectedReturnDate) {
                    selectedReturnDate = info.dateStr;
                    document.getElementById('return_date').value = selectedReturnDate;
                } else {
                    selectedPickupDate = info.dateStr;
                    selectedReturnDate = null;
                    document.getElementById('pickup_date').value = selectedPickupDate;
                    document.getElementById('return_date').value = '';
                }

                highlightSelectedDates();
            }
        });

        function highlightSelectedDates() {
            calendar.getEvents().forEach(function (event) {
                event.setProp('backgroundColor', '');
                event.setProp('borderColor', '');
            });

            if (selectedPickupDate) {
                calendar.getEvents().forEach(function (event) {
                    if (event.startStr === selectedPickupDate) {
                        event.setProp('backgroundColor', '#9b59b6');
                        event.setProp('borderColor', '#9b59b6');
                    }
                });
            }

            if (selectedReturnDate) {
                calendar.getEvents().forEach(function (event) {
                    if (event.startStr === selectedReturnDate) {
                        event.setProp('backgroundColor', '#9b59b6');
                        event.setProp('borderColor', '#9b59b6');
                    }
                });
            }

            if (selectedPickupDate && selectedReturnDate) {
                let currentDate = new Date(selectedPickupDate);
                let returnDate = new Date(selectedReturnDate);
                while (currentDate <= returnDate) {
                    let currentDateStr = currentDate.toISOString().split('T')[0];
                    calendar.getEvents().forEach(function (event) {
                        if (event.startStr === currentDateStr && event.extendedProps.available) {
                            event.setProp('backgroundColor', '#9b59b6');
                            event.setProp('borderColor', '#9b59b6');
                        }
                    });
                    currentDate.setDate(currentDate.getDate() + 1);
                }
            }
        }

        // Evento para actualizar el calendario al cambiar el puerto
        portSelect.addEventListener('change', function () {
            if (portSelect.value) {
                calendarEl.style.display = 'block'; // Mostrar el calendario
                calendar.gotoDate(new Date()); // Ir al mes actual
                calendar.refetchEvents(); // Recargar eventos según el nuevo puerto
            } else {
                calendarEl.style.display = 'none'; // Ocultar el calendario si no hay puerto seleccionado
                calendar.removeAllEvents(); // Limpiar los eventos
            }
        });

        // Renderizar el calendario
        calendar.gotoDate(new Date()); // Ir al mes actual
        calendar.render();
    });
</script>
