import React, { useEffect } from 'react';

const ValkyryaReservation = () => {
  useEffect(() => {
    // Obtén referencias a los elementos del DOM
    const startDateInput = document.getElementById('reservation-date');
    const confirmButton = document.getElementById('confirm-reservation');

    // Función para manejar la reserva
    const handleReservation = () => {
      const startDate = startDateInput.value;

      if (!startDate) {
        alert('Por favor, selecciona una fecha.');
        return;
      }

      // Lógica de reserva (puedes enviar datos al backend aquí)
      alert(`Reserva confirmada para Valkyrya en la fecha: ${startDate}`);
    };

    // Agregar el evento al botón
    confirmButton.addEventListener('click', handleReservation);

    return () => {
      // Eliminar el evento cuando el componente se desmonte
      confirmButton.removeEventListener('click', handleReservation);
    };
  }, []);

  return null; // React no renderiza nada visualmente
};

export default ValkyryaReservation;
