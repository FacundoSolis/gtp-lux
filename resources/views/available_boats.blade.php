@extends('layouts.public')

@push('styles')
<link rel="stylesheet" href="{{ asset('build/assets/menu-BnIop0I-.css') }}">
<link rel="stylesheet" href="{{ asset('build/assets/available-boats-BIl8H1si.css') }}">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endpush

@section('content')

<header class="topbar">
    <div class="topbar__logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">
        </a>
    </div>
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
                        <a href="#" class="language" data-lang-code="fr">
                            <img src="http://127.0.0.1:8000/img/flags/france.svg" alt="Français" class="flag-icon"> Français
                        </a>
                    </li>
                    <li>
                        <a href="#" class="language" data-lang-code="en">
                            <img src="http://127.0.0.1:8000/img/flags/usa.svg" alt="English" class="flag-icon"> English
                        </a>
                    </li>
                    <li>
                        <a href="#" class="language" data-lang-code="it">
                            <img src="http://127.0.0.1:8000/img/flags/italy.svg" alt="Italiano" class="flag-icon"> Italiano
                        </a>
                    </li>
                    <li>
                        <a href="#" class="language" data-lang-code="de">
                            <img src="http://127.0.0.1:8000/img/flags/germany.svg" alt="Deutsch" class="flag-icon"> Deutsch
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

<!-- Contenedor principal -->
<main class="container">
    <h2>Barcos Disponibles</h2>

    <div class="main-layout">
        <!-- Barra lateral con fechas -->
        <div class="sidebar">
            <h4>Elige una fecha</h4>
            <form action="{{ route('available.boats') }}" method="GET">
                @csrf
                <div class="form-group">
                    <label for="port_id"><strong>Puerto:</strong></label>
                    <select id="port_id" name="port_id" class="form-control" required>
                        <option value="1" {{ $portId == 1 ? 'selected' : '' }}>Marina De Denia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="pickup_date"><strong>Fecha de Recogida:</strong></label>
                    <input type="text" id="pickup_date" name="pickup_date" value="{{ old('pickup_date', $pickupDate) }}" class="form-control date-picker" readonly>
                </div>

                <div class="form-group">
                    <label for="return_date"><strong>Fecha de Entrega:</strong></label>
                    <input type="text" id="return_date" name="return_date" value="{{ old('return_date', $returnDate) }}" class="form-control date-picker" readonly>
                </div>

                <button type="submit" class="btn-form">Actualizar búsqueda</button>
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
<script src="{{ asset('build/assets/menu-Cd3QX7BG.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {
    const pickupDateInput = $("#pickup_date");
    const returnDateInput = $("#return_date");
    const reservationForm = document.getElementById('reservation-form');
    const hiddenPriceInput = document.getElementById('hidden-price');
    const totalPriceElement = document.getElementById('total-price');

    

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





