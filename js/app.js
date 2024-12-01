window.addEventListener('scroll', function() {
    const images = document.querySelectorAll('.slider img');
    images.forEach(function(image) {
      if (image.getBoundingClientRect().top < window.innerHeight) {
        image.classList.add('visible');
      }
    });
  });
  
  // JavaScript para funcionalidad del slider
document.querySelectorAll('.slider-with-arrows').forEach((container) => {
  const slides = container.querySelector('.slides');
  const images = slides.querySelectorAll('img');
  const totalImages = images.length;
  let index = 0;

  container.querySelector('.prev').addEventListener('click', () => {
    index = (index - 1 + totalImages) % totalImages;
    slides.style.transform = `translateX(-${index * 100}%)`;
  });

  container.querySelector('.next').addEventListener('click', () => {
    index = (index + 1) % totalImages;
    slides.style.transform = `translateX(-${index * 100}%)`;
  });
});


// Habilitar el botón cuando todos los campos estén completos
document.getElementById("reservation-date").addEventListener("change", checkFormCompletion);
document.getElementById("reservation-time").addEventListener("change", checkFormCompletion);
document.getElementById("boat-select").addEventListener("change", checkFormCompletion);

function checkFormCompletion() {
  const boat = document.getElementById("boat-select").value;
  const date = document.getElementById("reservation-date").value;
  const time = document.getElementById("reservation-time").value;
  
  // Habilitar el botón solo si todos los campos tienen valores
  const button = document.getElementById("reservation-btn");
  if (boat && date && time) {
    button.disabled = false;
  } else {
    button.disabled = true;
  }
}

// Función para enviar la reserva
function submitReservation() {
  const boat = document.getElementById("boat-select").value;
  const date = document.getElementById("reservation-date").value;
  const time = document.getElementById("reservation-time").value;

  // Crear un objeto con los datos de la reserva
  const reservationData = {
    boat: boat,
    date: date,
    time: time
  };

  // Llamada AJAX para enviar los datos de la reserva al backend
  fetch("/submit_reservation", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify(reservationData)
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert("¡Reserva exitosa! Te hemos enviado un correo de confirmación.");
    } else {
      alert("Hubo un problema al hacer la reserva. Intenta nuevamente.");
    }
  })
  .catch(error => {
    console.error("Error:", error);
    alert("Ocurrió un error al procesar tu reserva.");
  });
}