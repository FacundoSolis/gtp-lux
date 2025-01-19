@foreach ($boats as $boat)
<div class="boat-card {{ $boat->isReserved($pickupDate, $returnDate) ? 'reserved' : 'available' }}" data-boat-id="{{ $boat->id }}">
    <img src="{{ $boat->name == 'Sunseeker Portofino' 
                ? asset('img/protofino/Portofino.png') 
                : asset('img/princess/princes7.jpg') }}" 
        alt="{{ $boat->name }}" class="boat-card__image">


    <div class="boat-card__details">
        <h3 class="boat-card__name">{{ $boat->name }}</h3>
        <p class="boat-card__description">{{ $boat->description }}</p>
        @if ($pickupDate && $returnDate)
            @if ($boat->isReserved($pickupDate, $returnDate))
                <div class="reserved-overlay"><span>Reservado</span></div>
            @endif

            <div class="boat-card__price">
                <p>Precio total: <span id="daily-price-{{ $boat->id }}">{{ $prices[$boat->id] ?? 'Calculando...' }}</span></p>
            </div>
        @else
            <div class="boat-card__availability">
                <span>Ver disponibilidad</span>
            </div>
        @endif

        <!-- Generar enlace con todos los parámetros -->
        @if (isset($fromWelcome) && $fromWelcome)
            <a href="#"
               class="btn-form disabled-link"
               onclick="alert('Por favor selecciona una fecha para ver disponibilidad.'); return false;">
                Seleccionar {{ $boat->name }}
            </a>
        @else
            <a href="{{ route('boat.page', [
                'boat_id' => $boat->id,
                'port_id' => $portId,
                'pickup_date' => $pickupDate,
                'return_date' => $returnDate,
                'price' => $prices[$boat->id] ?? 0
            ]) }}" 
               class="btn-form {{ $boat->isReserved($pickupDate, $returnDate) ? 'disabled' : '' }}">
                Seleccionar {{ $boat->name }}
            </a>
        @endif
    </div>
</div>
@endforeach
