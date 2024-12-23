<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;


class PayPalController extends Controller
{
    private $client;

    public function __construct()
    {
        $clientId = env('PAYPAL_CLIENT_ID');
        $clientSecret = env('PAYPAL_SECRET');

        // Configuración del entorno de PayPal
        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $this->client = new PayPalHttpClient($environment);
    }

    public function createPayment()
    {
        try {
            // Crear el cuerpo de la solicitud
            $body = [
                'intent' => 'CAPTURE',
                'purchase_units' => [
                    [
                        'amount' => [
                            'currency_code' => 'EUR',
                            'value' => '10.00',
                        ],
                    ],
                ],
                'application_context' => [
                    'cancel_url' => 'https://bec5-2-154-112-178.ngrok-free.app/paypal/cancel',
                    'return_url' => 'https://bec5-2-154-112-178.ngrok-free.app/paypal/success',
                ],
            ];

            Log::info('PayPal Request Body:', $body);

            // Crear y enviar la solicitud
            $request = new OrdersCreateRequest();
            $request->prefer('return=representation');
            $request->body = $body;

            $response = $this->client->execute($request);

            Log::info('PayPal Response:', (array) $response);

            // Procesar el enlace de aprobación
            foreach ($response->result->links as $link) {
                if ($link->rel === 'approve') {
                    return redirect($link->href);
                }
            }

            return response()->json(['error' => 'No se pudo obtener el enlace de aprobación.'], 500);
        } catch (\Exception $e) {
            Log::error('PayPal Error:', ['message' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
