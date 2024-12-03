<h1>Página de Pago</h1>
<form action="{{ route('processPayment') }}" method="POST">
    @csrf
    <button type="submit">Pagar</button>
</form>
