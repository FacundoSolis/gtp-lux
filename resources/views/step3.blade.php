<form action="{{ route('saveDetails') }}" method="POST">
    @csrf
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>

    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="phone" required>

    <button type="submit">Ir al Pago</button>
</form>