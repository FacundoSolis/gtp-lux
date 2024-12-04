<form action="{{ route('saveStep2') }}" method="POST">
    @csrf
    <label for="boat">Barco:</label>
    <select id="boat" name="boat_id" required>
        <option value="">Seleccione un barco</option>
        @foreach($boats as $boat)
            <option value="{{ $boat->id }}">{{ $boat->name }}</option>
        @endforeach
    </select>

    <label for="pickup_date">Fecha de Recogida:</label>
    <input type="date" id="pickup_date" name="pickup_date" required>

    <label for="return_date">Fecha de Entrega:</label>
    <input type="date" id="return_date" name="return_date" required>

    <button type="submit">Siguiente</button>
</form>