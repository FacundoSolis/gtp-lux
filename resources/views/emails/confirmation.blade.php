<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('email.confirmation_title') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/confirmationEmail.css') }}">
</head>
<body>
    <div class="container">
        <!-- Logo: Enlace a la página principal -->
        <div class="header">
            <a href="https://www.gtplux.com/">
                <img src="{{ asset('img/logo.png') }}">
            </a>
            <h2>{{ __('email.confirmation_heading') }}</h2>
            <p>{{ __('email.hello') }} <strong>{{ $reservation->name }}</strong>,</p>
            <p>{{ __('email.confirmation_body') }}</p>
        </div>

        <!-- Detalles de la Reserva -->
        <div class="details">
            <ul>
                <li><strong>{{ __('port') }}:</strong> {{ $reservation->port->name }}</li>
                <li><strong>{{ __('boat') }}:</strong> {{ $reservation->boat->name }}</li>
                <li><strong>{{ __('pickup_date') }}:</strong> {{ $reservation->pickup_date }}</li>
                <li><strong>{{ __('drop_off_date') }}:</strong> {{ $reservation->return_date }}</li>
                <li><strong>{{ __('name') }}:</strong> {{ $reservation->name }}</li>
                <li><strong>{{ __('surname') }}:</strong> {{ $reservation->surname }}</li>
                <li><strong>{{ __('email') }}:</strong> {{ $reservation->email }}</li>
                <li><strong>{{ __('phone') }}:</strong> {{ $reservation->phone }}</li>
                <li><strong>{{ __('price_total_summary') }}:</strong> €{{ number_format($reservation->total_price, 2) }}</li>
            </ul>
        </div>

        <!-- Información de Contacto y Despedida -->
        <div class="footer">
            <p>{{ __('email.contact_us') }} <a href="mailto:support@gtplux.com">support@gtplux.com</a></p>
            <p style="color: #003366; font-weight: bold;">{{ __('email.see_you_soon') }}</p>
        </div>

        <!-- Redes Sociales -->
        <div class="social-icons">
            <p>{{ __('social_media') }}</p>
            <ul>
                <li><a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://www.instagram.com/?hl=es" target="_blank"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
    </div>
</body>
</html>
