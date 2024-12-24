import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import 'bootstrap';


const App = () => {
    const baseUrl = window.location.origin; // Define la URL base dinámicamente
    const [images, setImages] = useState([
        `${baseUrl}/img/val2.jpg`,
        `${baseUrl}/img/val3.jpg`,
        `${baseUrl}/img/val4.jpg`,
        `${baseUrl}/img/val5.jpg`,
    ]);

    const [moreImages, setMoreImages] = useState([
        `${baseUrl}/img/val6.jpg`,
        `${baseUrl}/img/val7.jpg`,
        `${baseUrl}/img/val8.jpg`,
        `${baseUrl}/img/val9.jpg`,
    ]);

    useEffect(() => {
        // Inicializar el calendario después de que el componente se haya montado
        const calendarEl = document.getElementById('availability-calendar');

        if (calendarEl) {
            const calendar = new Calendar(calendarEl, {
                plugins: [dayGridPlugin],
                initialView: 'dayGridMonth',
                locale: 'es',
                events: [
                    { title: 'Reservado', start: '2024-12-24', end: '2024-12-25', color: 'red' },
                    { title: 'Disponible', start: '2024-12-26', end: '2024-12-27', color: 'green' },
                ],
            });
            calendar.render();
        }
    }, []); // Este efecto solo se ejecuta una vez, cuando el componente se monta

    const loadMoreImages = () => {
        setImages((prevImages) => [...prevImages, ...moreImages]);
        setMoreImages([]); // Eliminar las imágenes adicionales después de cargarlas
    };

    return (
        <div className="container">
            <h2>Sunseeker Portofino 53</h2>

            {/* Galería de imágenes */}
            <div className="productCover__imagesContainer">
                <div className="productCover__sideImgs">
                    {images.map((imgUrl, index) => (
                        <div
                            key={index}
                            className="productCover__img--small js-openGallery"
                            style={{ backgroundImage: `url(${imgUrl})` }}
                        ></div>
                    ))}
                </div>
            </div>

            {moreImages.length > 0 && (
                <div className="productCover__ctaContainer">
                    <button className="productCover__cta" onClick={loadMoreImages}>
                        Ver más fotos
                    </button>
                </div>
            )}

            {/* Contenedor para FullCalendar */}
            <div id="availability-calendar" className="availability-calendar"></div>
        </div>
    );
};

// Montar el componente en el DOM
const rootElement = document.getElementById('app');
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<App />);
}
