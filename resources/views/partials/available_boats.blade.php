@foreach ($boats as $boat)
    <div class="boat-card {{ $boat->isReserved($pickupDate, $returnDate) ? 'reserved' : 'available' }}">
        <!-- Asignar la imagen de cada barco manualmente -->
        @if ($boat->name == 'Sunseeker Portofino')
            <img src="{{ asset('img/yates.png') }}" alt="Sunseeker Portofino" class="boat-card__image">
        @elseif ($boat->name == 'Princess V65')
            <img src="{{ asset('img/yates2.png') }}" alt="Princess V65" class="boat-card__image">
        @else
            <img src="{{ asset('img/default-boat.png') }}" alt="Imagen por defecto" class="boat-card__image">
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

            <!-- Botón "Seleccionar" -->
            <a href="{{ route('boat.page', ['boat_id' => $boat->id, 'port_id' => $portId, 'pickup_date' => $pickupDate, 'return_date' => $returnDate]) }}" 
               class="btn-form {{ $boat->isReserved($pickupDate, $returnDate) ? 'disabled' : '' }}">
                Seleccionar {{ $boat->name }}
            </a>
        </div>
    </div>
@endforeach
