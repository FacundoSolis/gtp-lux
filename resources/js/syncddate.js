document.addEventListener('DOMContentLoaded', function () {
  const pickupInput = document.getElementById('pickup_date');
  const returnInput = document.getElementById('return_date');
  const calendarEl = document.getElementById('availability-calendar');
  const priceSummary = document.getElementById('price-summary');
  const totalPriceElement = document.getElementById('total-price');
  const boatId = document.querySelector('input[name="boat_id"]').value;
  const portSelect = document.getElementById('port_id'); // Referencia al campo de selección de puerto

  const urlParams = new URLSearchParams(window.location.search);
  const pickupDate = urlParams.get('pickup_date');
  const returnDate = urlParams.get('return_date');
  const price = urlParams.get('price');
  const portId = urlParams.get('port_id');

  if (pickupDate) pickupInput.value = pickupDate;
  if (returnDate) returnInput.value = returnDate;
  if (price && totalPriceElement) {
      totalPriceElement.textContent = `${price}€`;
      priceSummary.style.display = 'block';
  }

  if (portId && portSelect) {
      portSelect.value = portId;
  }

  const calendar = new FullCalendar.Calendar(calendarEl, {
      themeSystem: 'bootstrap',
      locale: 'es',
      initialView: 'dayGridMonth',
      events: `/reservations/calendar/${boatId}/${portId || portSelect.value}`,
      dateClick: function (info) {
          if (!pickupInput.value) {
              pickupInput.value = info.dateStr;
          } else if (!returnInput.value) {
              if (info.dateStr <= pickupInput.value) {
                  alert('La fecha de entrega debe ser posterior a la de recogida.');
              } else {
                  returnInput.value = info.dateStr;
                  if (checkRangeOverlap(pickupInput.value, returnInput.value)) {
                      alert('El rango seleccionado incluye días ya reservados. Por favor, selecciona otras fechas.');
                      resetSelection();
                  }
              }
          } else {
              pickupInput.value = info.dateStr;
              returnInput.value = '';
          }

          calculatePrice();
          highlightDates(pickupInput.value, returnInput.value);
      }
  });

  calendar.render();

  function calculatePrice() {
      if (!pickupInput.value || !returnInput.value || !portSelect.value) return;

      axios.get(`/boats/${boatId}/daily-price`, {
          params: {
              start_date: pickupInput.value,
              end_date: returnInput.value,
              port_id: portSelect.value
          }
      }).then(response => {
          const totalPrice = response.data.total_price;
          totalPriceElement.textContent = `${totalPrice}€`;
          priceSummary.style.display = 'block';
      }).catch(error => {
          console.error('Error al calcular el precio:', error);
          totalPriceElement.textContent = 'Error';
          priceSummary.style.display = 'none';
      });
  }

  function highlightDates(startDate, endDate) {
      document.querySelectorAll('.fc-day').forEach(day => day.style.backgroundColor = '');

      if (startDate && endDate) {
          let date = new Date(startDate);
          const end = new Date(endDate);

          while (date <= end) {
              const formattedDate = date.toISOString().split('T')[0];
              const dayEl = document.querySelector(`.fc-day[data-date="${formattedDate}"]`);
              if (dayEl) dayEl.style.backgroundColor = '#007BFF';
              date.setDate(date.getDate() + 1);
          }
      }
  }

  function checkRangeOverlap(startDate, endDate) {
      const start = new Date(startDate);
      const end = new Date(endDate);

      return calendar.getEvents().some(event => {
          if (!event.extendedProps.available) {
              const eventStart = new Date(event.startStr);
              const eventEnd = new Date(event.endStr);

              return (
                  (start >= eventStart && start < eventEnd) ||
                  (end > eventStart && end <= eventEnd) ||
                  (start <= eventStart && end >= eventEnd)
              );
          }
          return false;
      });
  }

  function resetSelection() {
      pickupInput.value = '';
      returnInput.value = '';
      priceSummary.style.display = 'none';
      highlightDates();
  }

  if (pickupDate && returnDate) {
      calculatePrice();
      highlightDates(pickupDate, returnDate);
  }
});
