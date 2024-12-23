@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">Listado de Pagos</h1>

    <div class="card">
        <div class="card-header bg-success text-white">
            <i class="fas fa-credit-card"></i> Pagos Registrados
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Reserva</th>
                        <th>Monto</th>
                        <th>Método de Pago</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Suponiendo que tienes un array $payments -->
                    @foreach ($payments as $payment)
                        <tr>
                            <td>{{ $payment->id }}</td>
                            <td>{{ $payment->reservation->name ?? 'N/A' }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->method }}</td>
                            <td>{{ $payment->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="#" class="btn btn-info btn-sm" title="Detalles"><i class="fas fa-info-circle"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
