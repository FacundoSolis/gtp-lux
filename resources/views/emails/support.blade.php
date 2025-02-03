<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('email.confirmation_title') }}</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2 style="color: #003366;">{{ __('email.confirmation_heading') }}</h2>
    <p>{{ __('email.hello') }} <strong>{{ $customer_name }}</strong>,</p>
    <p>{{ __('email.confirmation_body') }}</p>
    <ul>
        <li><strong>{{ __('email.boat') }}:</strong> {{ $boat_name }}</li>
        <li><strong>{{ __('email.date') }}:</strong> {{ $reservation_date }}</li>
        <li><strong>{{ __('email.time') }}:</strong> {{ $departure_time }}</li>
        <li><strong>{{ __('email.location') }}:</strong> {{ $port_address }}</li>
    </ul>
    <p>{{ __('email.contact_us') }} <a href="mailto:support@gtplux.com">support@gtplux.com</a>.</p>
    <p style="color: #003366;"><strong>{{ __('email.see_you_soon') }}</strong></p>
</body>
</html>
