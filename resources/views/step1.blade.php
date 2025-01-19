

<form action="{{ route('step1.save') }}" method="POST">
    @csrf
    <label for="port">Puerto:</label>
    <select id="port" name="port_id" required>
        <option value="">Seleccione un puerto</option>
        @foreach($ports as $port)
            <option value="{{ $port->id }}">{{ $port->name }}</option>
        @endforeach
    </select>
    <button type="submit">Siguiente</button>
</form>