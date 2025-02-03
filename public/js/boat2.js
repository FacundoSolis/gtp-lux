document.addEventListener('DOMContentLoaded', () => {
  const modelViewer = document.getElementById('boatModel');

  // Habilitar zoom (por defecto ya está habilitado si no usas "disable-zoom")
  modelViewer.disableZoom = false;

  // Activar rotación automática
  modelViewer.setAttribute('auto-rotate', '');
  modelViewer.setAttribute('rotation-per-second', '30deg'); // Ajusta la velocidad de rotación

  // Cambiar dinámicamente la vista inicial
  modelViewer.cameraOrbit = '160deg 80deg 2m'; // Vista inicial personalizada
  modelViewer.fieldOfView = '45deg'; // Campo de visión ajustado para zoom inicial

  // Escuchar eventos de interacción del usuario
  modelViewer.addEventListener('camera-change', () => {
      console.log('Vista de la cámara actual:', modelViewer.getCameraOrbit());
  });

  // Mensaje al cargar el modelo
  modelViewer.addEventListener('load', () => {
      console.log('Modelo cargado correctamente y listo para interactuar.');
  });

  // Restaurar la rotación automática después de la interacción del usuario
  modelViewer.addEventListener('interaction-end', () => {
      modelViewer.setAttribute('auto-rotate', '');
  });
});
