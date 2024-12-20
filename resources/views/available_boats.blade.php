@extends('layouts.public')

@push('styles')
@vite('resources/css/menu.css')
@vite('resources/css/available-boats.css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
        <!-- Barra lateral con fechas -->
        <div class="sidebar">
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
                    <input type="text" id="pickup_date" name="pickup_date" value="{{ old('pickup_date', $pickupDate) }}" class="form-control date-picker" readonly required>
                </div>

                <div class="form-group">
                    <label for="return_date"><strong>Fecha de Entrega:</strong></label>
                    <input type="text" id="return_date" name="return_date" value="{{ old('return_date', $returnDate) }}" class="form-control date-picker" readonly required>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
$(document).ready(function () {
    const pickupDateInput = $("#pickup_date");
    const returnDateInput = $("#return_date");

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
            setTimeout(() => {
                returnDateInput.datepicker("show");
            }, 200); // Retardo para evitar cierres inesperados
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
        onSelect: function (selectedDate) {
            // Cerrar automáticamente tras seleccionar una fecha
            setTimeout(() => {
                returnDateInput.datepicker("hide");
            }, 200);
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
});
</script>
@endsection



