document.addEventListener('DOMContentLoaded', () => {
  const modelViewer = document.getElementById('boatModel');

  // Habilitar zoom (por defecto ya está habilitado si no usas "disable-zoom")
  modelViewer.disableZoom = false;

  // Cambiar dinámicamente la vista inicial
  modelViewer.cameraOrbit = '70deg 80deg 3m'        
  modelViewer.fieldOfView = '60deg'; // Campo de visión ajustado para zoom inicial
    // Habilitar zoom (ya está habilitado por defecto)
    modelViewer.disableZoom = false;

  // Escuchar eventos de interacción del usuario
  modelViewer.addEventListener('camera-change', () => {
      console.log('Vista de la cámara actual:', modelViewer.getCameraOrbit());
  });

  // Mensaje al cargar el modelo
  modelViewer.addEventListener('load', () => {
      console.log('Modelo cargado correctamente y listo para interactuar.');
  });
});