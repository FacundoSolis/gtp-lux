@foreach ($boats as $boat)
<div class="boat-card {{ $boat->isReserved($pickupDate, $returnDate) ? 'reserved' : 'available' }}" data-boat-id="{{ $boat->id }}">
    <img src="{{ $boat->name == 'Sunseeker Portofino' ? asset('img/yates.png') : asset('img/yates2.png') }}" 
         alt="{{ $boat->name }}" class="boat-card__image">

    <div class="boat-card__details">
        <h3 class="boat-card__name">{{ $boat->name }}</h3>
        <p class="boat-card__description">{{ $boat->description }}</p>

        @if ($boat->isReserved($pickupDate, $returnDate))
        <div class="reserved-overlay"><span>Reservado</span></div>
        @endif

        <div class="boat-card__price">
            <p>Precio total: <span id="daily-price-{{ $boat->id }}">Calculando...</span></p>
        </div>

        <a href="{{ route('boat.page', ['boat_id' => $boat->id, 'port_id' => $portId, 'pickup_date' => $pickupDate, 'return_date' => $returnDate]) }}" 
           class="btn-form {{ $boat->isReserved($pickupDate, $returnDate) ? 'disabled' : '' }}">
            Seleccionar {{ $boat->name }}
        </a>
    </div>
</div>
@endforeach
