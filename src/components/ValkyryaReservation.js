import React, { useEffect } from 'react';

const ValkyryaReservation = () => {
  useEffect(() => {
    // Lógica adicional si necesitas agregar eventos directamente al DOM
  }, []);

  // Función para manejar la reserva
  const handleReservation = () => {
    const startDate = document.getElementById('reservation-date').value;

    if (!startDate) {
      alert('Por favor, selecciona una fecha.');
      return;
    }

    alert(`Reserva confirmada para Valkyrya en la fecha: ${startDate}`);
  };

  const handleCalculatePrice = () => {
    alert('Calculando precio...');
  };

  return (
    <div className="reservation-container">
      <h3>Reserva Ahora</h3>
      <input 
        type="date" 
        id="reservation-date" 
        className="calendar-input" 
      />
      <div className="button-group">
        <button 
          id="calculate-price" 
          className="reservation-btn" 
          onClick={handleCalculatePrice}
        >
          Calcular Precio
        </button>
        <button 
          id="confirm-reservation" 
          className="reservation-btn" 
          onClick={handleReservation}
        >
          Reservar
        </button>
      </div>
    </div>
  );
};

export default ValkyryaReservation;
