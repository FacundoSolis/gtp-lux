document.addEventListener('DOMContentLoaded', function () {
    const reviewForm = document.getElementById('review-form');
    const reviewText = document.getElementById('review-text');
    const reviewStars = document.getElementsByName('rating');
    const reviewsList = document.getElementById('reviews-list');
    const reviewCount = document.getElementById('review-count');
  
    let reviews = [];
  
    // Añadir nueva opinión
    reviewForm.addEventListener('submit', function (e) {
      e.preventDefault();
  
      const text = reviewText.value.trim();
      const rating = Array.from(reviewStars).find(star => star.checked)?.value;
  
      if (!text || !rating) {
        alert('Por favor, completa todos los campos.');
        return;
      }
  
      const newReview = {
        text,
        rating: parseInt(rating),
        date: new Date().toISOString(),
      };
  
      reviews.push(newReview);
      reviewText.value = '';
      Array.from(reviewStars).forEach(star => (star.checked = false));
  
      renderReviews();
    });
  
    // Renderizar opiniones
    function renderReviews() {
      reviewsList.innerHTML = '';
  
      reviews.sort((a, b) => new Date(b.date) - new Date(a.date));
  
      reviews.forEach(review => {
        const li = document.createElement('li');
        li.innerHTML = `
          <p>${review.text}</p>
          <div class="review-stars-display">
            ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}
          </div>
          <small>${new Date(review.date).toLocaleDateString()}</small>
        `;
        reviewsList.appendChild(li);
      });
  
      reviewCount.textContent = reviews.length;
    }
  });
  