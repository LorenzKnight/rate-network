<!DOCTYPE html>
<html>
  <head>
    <title>Aplicación de cámara</title>
  </head>
  <body>
    <video id="video-element"></video>
    <canvas id="canvas-element" width="640" height="480"></canvas>
    <button id="capture-button">Tomar foto</button>
    <button id="save-button">Guardar foto</button>
    <button id="clear-button">Tomar otra foto</button>
    <button id="close-camera-button">Cerrar cámara</button>

    <script>
      const videoElement = document.getElementById('video-element');
      const canvasElement = document.getElementById('canvas-element');
      const captureButton = document.getElementById('capture-button');
      const saveButton = document.getElementById('save-button');
      const clearButton = document.getElementById('clear-button');
      const closeCameraButton = document.getElementById('close-camera-button');

      let currentFacingMode = 'environment'; // La cámara trasera es la predeterminada
      let isIphone = /iPhone/.test(navigator.userAgent);

      let stream = null;

      captureButton.addEventListener('click', () => {
        const context = canvasElement.getContext('2d');
        context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);
        captureButton.style.display = 'none';
        clearButton.style.display = 'block';
      });

      clearButton.addEventListener('click', () => {
        const context = canvasElement.getContext('2d');
        context.clearRect(0, 0, canvasElement.width, canvasElement.height);
        captureButton.style.display = 'block';
        clearButton.style.display = 'none';
      });

      saveButton.addEventListener('click', () => {
        const image = canvasElement.toDataURL('image/png');
        if (isIphone) {
          window.location.href = image;
        } else {
          const link = document.createElement('a');
          link.download = 'foto.png';
          link.href = image;
          link.click();
        }
      });

      closeCameraButton.addEventListener('click', () => {
        if (stream) {
          const tracks = stream.getTracks();
          tracks.forEach((track) => {
            track.stop();
          });
        }
        closeCameraButton.style.display = 'none';
        captureButton.style.display = 'block';
      });

      async function initCamera() {
        try {
          if (isIphone) {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: currentFacingMode } });
          } else {
            stream = await navigator.mediaDevices.getUserMedia({ video: true });
          }
          videoElement.srcObject = stream;
          videoElement.play();
          closeCameraButton.style.display = 'block';
        } catch (error) {
          console.error('Error al acceder a la cámara:', error);
        }
      }

      initCamera();
    </script>
  </body>
</html>