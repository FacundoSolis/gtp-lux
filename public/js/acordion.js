
    function toggleAccordion(header) {
      
        const body = header.nextElementSibling;

        // Cierra cualquier otro acordeón en el mismo contenedor
        const allItems = header.parentElement.parentElement.querySelectorAll('.accordion-body');
        allItems.forEach(item => {
            if (item !== body) {
                item.style.display = 'none';
            }
        });

        // Alterna el estado del acordeón actual
        if (body.style.display === 'block') {
            body.style.display = 'none';
        } else {
            body.style.display = 'block';
        }
        const allAccordionBodies = document.querySelectorAll('.accordion-body');
    allAccordionBodies.forEach(body => {
        body.style.maxHeight = null; // Asegura que estén cerrados
    });
    }
