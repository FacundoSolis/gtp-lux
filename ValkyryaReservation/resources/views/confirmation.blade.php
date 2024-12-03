<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Reserva</title>
</head>
<body>
    <h1>¡Reserva Confirmada!</h1>
    <p>Gracias por tu reserva. Los detalles de tu reserva son los siguientes:</p>
    
    <h3>Detalles de la Reserva:</h3>
    <ul>
        <li><strong>Puerto:</strong> {{ $reservationDetails['port_id'] }}</li>
        <li><strong>Barco:</strong> {{ $reservationDetails['boat_id'] }}</li>
        <li><strong>Fecha de Recogida:</strong> {{ $reservationDetails['pickup_date'] }}</li>
        <li><strong>Fecha de Entrega:</strong> {{ $reservationDetails['return_date'] }}</li>
        <li><strong>Nombre:</strong> {{ $reservationDetails['name'] }}</li>
        <li><strong>Correo Electrónico:</strong> {{ $reservationDetails['email'] }}</li>
        <li><strong>Teléfono:</strong> {{ $reservationDetails['phone'] }}</li>
    </ul>

    <p>¡Esperamos que disfrutes tu experiencia a bordo del Valkyrya!</p>
</body>
</html>
