import React, { useState } from 'react';

const ReservationForm = () => {
  const [boat, setBoat] = useState('');
  const [startDate, setStartDate] = useState('');
  const [endDate, setEndDate] = useState('');
  const [price, setPrice] = useState(0);

  const seasons = [
    { name: 'Baja', start: '2024-01-01', end: '2024-05-31', price: 100 },
    { name: 'Media', start: '2024-06-01', end: '2024-06-30', price: 150 },
    { name: 'Alta', start: '2024-07-01', end: '2024-08-31', price: 200 },
  ];

  const calculatePrice = () => {
    // Lógica para calcular el precio según las fechas
    let total = 0;
    const start = new Date(startDate);
    const end = new Date(endDate);

    seasons.forEach((season) => {
      const seasonStart = new Date(season.start);
      const seasonEnd = new Date(season.end);

      if (start <= seasonEnd && end >= seasonStart) {
        const overlapStart = start > seasonStart ? start : seasonStart;
        const overlapEnd = end < seasonEnd ? end : seasonEnd;
        const days = (overlapEnd - overlapStart) / (1000 * 60 * 60 * 24) + 1;
        total += days * season.price;
      }
    });

    setPrice(total);
  };

  const handleSubmit = () => {
    alert(`Reserva confirmada para el barco ${boat}. Total: ${price}€`);
  };

  return (
    <div>
      <h2>Reserva tu barco</h2>
      <select value={boat} onChange={(e) => setBoat(e.target.value)}>
        <option value="">Selecciona un barco</option>
        <option value="Valkyrya">Valkyrya</option>
        <option value="Nadine">Nadine</option>
      </select>
      <input
        type="date"
        value={startDate}
        onChange={(e) => setStartDate(e.target.value)}
      />
      <input
        type="date"
        value={endDate}
        onChange={(e) => setEndDate(e.target.value)}
      />
      <button onClick={calculatePrice}>Calcular Precio</button>
      {price > 0 && <p>Total: {price}€</p>}
      <button onClick={handleSubmit} disabled={!boat || !startDate || !endDate}>
        Confirmar Reserva
      </button>
    </div>
  );
};

export default ReservationForm;
