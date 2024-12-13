// resources/js/componentes/app.jsx
import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import '../css/style.css';  // Ruta correcta desde resources/js/app.jsx a resources/css/style.css
import '../css/admin.css';
import '../css/available-boats.css';
import '../css/menu.css';
import '../css/portofino.css';
import '../css/princess.css';

// Componente React
function App() {
  const [images, setImages] = useState([
    'http://127.0.0.1:8000/img/val2.jpg',
    'http://127.0.0.1:8000/img/val3.jpg',
    'http://127.0.0.1:8000/img/val4.jpg',
    'http://127.0.0.1:8000/img/val5.jpg',
  ]);
  const [moreImages, setMoreImages] = useState([
    'http://127.0.0.1:8000/img/val6.jpg',
    'http://127.0.0.1:8000/img/val7.jpg',
    'http://127.0.0.1:8000/img/val8.jpg',
    'http://127.0.0.1:8000/img/val9.jpg',
  ]);

  const loadMoreImages = () => {
    setImages((prevImages) => [...prevImages, ...moreImages]);
    setMoreImages([]);  // Eliminar las imágenes adicionales después de cargarlas
  };

  return (
    <div className="container">
      <h2>Sunseeker Portofino 53</h2>
      
      <div className="productCover__imagesContainer">
        <div className="productCover__sideImgs">
          {images.map((imgUrl, index) => (
            <div 
              key={index}
              className="productCover__img--small js-openGallery"
              style={{ backgroundImage: `url(${imgUrl})` }} // Establecer la imagen de fondo
            ></div>
          ))}
        </div>
      </div>

      {moreImages.length > 0 && (
        <div className="productCover__ctaContainer">
          <button className="productCover__cta" onClick={loadMoreImages}>Ver más fotos</button>
        </div>
      )}
    </div>
  );
}

// Montar el componente en el DOM
const root = document.getElementById('app');
if (root) {
  ReactDOM.render(<App />, root);
}
