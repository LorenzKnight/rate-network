document.addEventListener('DOMContentLoaded', () => {
    const inputImage = document.querySelector('#file1');
    const editor = document.querySelector('#editor');
    const miCanvas = document.querySelector('#preview');
    const contexto = miCanvas.getContext('2d');
    let urlImage;
  
    inputImage.addEventListener('change', abrirEditor, false);
  
    function abrirEditor(e) {
      urlImage = URL.createObjectURL(e.target.files[0]);
  
      editor.innerHTML = '';
      const cropprImg = document.createElement('img');
      cropprImg.setAttribute('id', 'croppr');
      cropprImg.setAttribute('width', 500);
      cropprImg.setAttribute('src', urlImage);
      editor.appendChild(cropprImg);
  
      contexto.clearRect(0, 0, miCanvas.width, miCanvas.height);
  
      cropprImg.addEventListener('load', () => {
        new Croppr(cropprImg, {
          startCoords: [0, 0],
          aspectRatio: 1,
          startSize: [70, 70],
          minSize: [10, 10],
          onCropEnd: recortarImagen
        })
      });
    }
  
    function recortarImagen(data) {
      const inicioX = data.x;
      const inicioY = data.y;
      const nuevoAncho = data.width;
      const nuevaAltura = data.height;
      const zoom = 1;
      let imagenEn64 = '';
  
      miCanvas.width = nuevoAncho;
      miCanvas.height = nuevaAltura;
      let miNuevaImagenTemp = new Image();
  
      miNuevaImagenTemp.onload = function() {
        contexto.drawImage(miNuevaImagenTemp, inicioX, inicioY, nuevoAncho * zoom, nuevaAltura * zoom, 0, 0, nuevoAncho, nuevaAltura);
        imagenEn64 = miCanvas.toDataURL("image/jpeg");
  
        const uploadButton = document.getElementById('uploadButton');
        uploadButton.onclick = null;
        uploadButton.onclick = function(){
          const file1 = document.getElementById('file1');
          const fileName = file1.value.split("\\").pop();
          upload_cropp_pic(imagenEn64, fileName);
        }
      }
      miNuevaImagenTemp.src = urlImage;
    }
  
    function upload_cropp_pic(imgBase64, fileName){
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var fotoField = document.querySelector('.post_foto_prev').getAttribute('data-pic-names');
          var fotoNameArray = [];
  
          if(fotoField == null)
          {
            fotoNameArray = [this.responseText];
          }
          else
          {
            fotoNameArray = JSON.parse(fotoField);
            fotoNameArray.push(this.responseText);
          }
          document.querySelector('.post_foto_prev').setAttribute('data-pic-names', JSON.stringify(fotoNameArray));
          let fotos = document.createElement('img');
          fotos.src = 'tmp_images/'+this.responseText;
          fotos.style.height = '150px';
  
          document.querySelector('.post_foto_prev').appendChild(fotos);   
        }
      };
  
      var formData = new FormData(); 
      formData.append('MM_insert', 'uploadImg');
      formData.append('imgBase64', imgBase64);
      formData.append('fileName', fileName);
  
      xmlhttp.open("POST", "logic/start_be.php", true);
      xmlhttp.send(formData);
    }
  });