<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'], // Asegúrate de que las rutas API o cualquier otra ruta de tu app esté configurada
    'allowed_methods' => ['*'], // Permitir todos los métodos
    'allowed_origins' => ['*'], // Permitir todas las orígenes
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // Permitir todos los encabezados
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
