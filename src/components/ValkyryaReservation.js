import React, { useState } from 'react';

const ValkyryaReservation = () => {
  // Estados para los campos del formulario
  const [persons, setPersons] = useState('');
  const [pickupDate, setPickupDate] = useState('');
  const [returnDate, setReturnDate] = useState('');
  const [formData, setFormData] = useState({
    fname: '',
    lname: '',
    email: '',
    phone: '',
    nif: '',
  });
  const [termsAccepted, setTermsAccepted] = useState(false);

  // Función para manejar cambios en los campos del formulario
  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // Función para manejar el envío del formulario
  const handleReservation = (e) => {
    e.preventDefault();

    if (!pickupDate || !returnDate || !persons || !termsAccepted) {
      alert('Por favor, completa todos los campos y acepta los términos.');
      return;
    }

    // Aquí enviarías los datos al backend
    console.log({
      ...formData,
      persons,
      pickupDate,
      returnDate,
    });

    alert(`Reserva confirmada para ${formData.fname} ${formData.lname}`);
  };

  return (
    <section className="reservation-section">
      <div className="reservation-box">
        <h3>¡Reserva tu experiencia en Valkyrya!</h3>
        
        {/* Campos superiores */}
        <div className="reservation-inputs">
          <div className="input-group">
            <label htmlFor="persons">Número de Personas:</label>
            <input
              type="number"
              id="persons"
              name="persons"
              value={persons}
              onChange={(e) => setPersons(e.target.value)}
              placeholder="Ejemplo: 4"
              min="1"
              max="12"
            />
          </div>
          <div className="input-group">
            <label htmlFor="pickup-date">Fecha de Recogida:</label>
            <input
              type="date"
              id="pickup-date"
              name="pickup-date"
              value={pickupDate}
              onChange={(e) => setPickupDate(e.target.value)}
            />
          </div>
          <div className="input-group">
            <label htmlFor="return-date">Fecha de Entrega:</label>
            <input
              type="date"
              id="return-date"
              name="return-date"
              value={returnDate}
              onChange={(e) => setReturnDate(e.target.value)}
            />
          </div>
        </div>
        
        {/* Formulario */}
        <div className="form-container">
          <form onSubmit={handleReservation}>
            <label htmlFor="fname">Nombre:</label>
            <input
              type="text"
              id="fname"
              name="fname"
              value={formData.fname}
              onChange={handleInputChange}
              placeholder="Nombre"
            />
            <label htmlFor="lname">Apellido:</label>
            <input
              type="text"
              id="lname"
              name="lname"
              value={formData.lname}
              onChange={handleInputChange}
              placeholder="Apellido"
            />
            <label htmlFor="email">Correo Electrónico:</label>
            <input
              type="email"
              id="email"
              name="email"
              value={formData.email}
              onChange={handleInputChange}
              placeholder="Correo"
            />
            <label htmlFor="phone">Teléfono:</label>
            <input
              type="tel"
              id="phone"
              name="phone"
              value={formData.phone}
              onChange={handleInputChange}
              placeholder="Teléfono"
            />
            <label htmlFor="nif">NIF/CIF:</label>
            <input
              type="text"
              id="nif"
              name="nif"
              value={formData.nif}
              onChange={handleInputChange}
              placeholder="NIF/CIF"
            />
            <div className="terms">
              <input
                type="checkbox"
                id="terms"
                checked={termsAccepted}
                onChange={(e) => setTermsAccepted(e.target.checked)}
              />
              <label htmlFor="terms">
                He leído y acepto las{' '}
                <a href="condiciones.html" target="_blank">
                  condiciones de alquiler
                </a>.
              </label>
            </div>
            <button type="submit" className="reservation-btn">Reservar</button>
          </form>
        </div>
      </div>
    </section>
  );
};

export default ValkyryaReservation;
