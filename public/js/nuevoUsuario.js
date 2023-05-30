document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos el input y la imagen previa
    var input = document.getElementById('nuevoFoto');
    var imagenPrevia = document.getElementById('imagenPrevia');

    // Esta función se activa cada vez que se selecciona un nuevo archivo
    input.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                // Cuando el FileReader haya leído el archivo, mostramos la vista previa
                imagenPrevia.src = e.target.result;
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});


document.addEventListener('DOMContentLoaded', function() {
    var nuevoUsuarioForm = document.getElementById('nuevoUsuarioForm');
    var nuevoClave1 = document.getElementById('nuevoClave1');
    var nuevoClave2 = document.getElementById('nuevoClave2');
  
    nuevoUsuarioForm.addEventListener('submit', function(event) {
      if (!nuevoUsuarioForm.checkValidity() || nuevoClave1.value !== nuevoClave2.value) {
        event.preventDefault();
        event.stopPropagation();
        nuevoUsuarioForm.classList.add('was-validated');
      } else {
        $('#confirmModal').modal('show');
      }
    });
  });
  
document.getElementById('confirmSubmit').addEventListener('click', function() {
    document.getElementById('nuevoUsuarioForm').submit();
});

/*document.addEventListener('DOMContentLoaded', function() {
    var nuevoUsuarioForm = document.getElementById('nuevoUsuarioForm');
    var nuevoClave1 = document.getElementById('nuevoClave1');
    var nuevoClave2 = document.getElementById('nuevoClave2');
  
    nuevoUsuarioForm.addEventListener('submit', function(event) {
      if (!nuevoUsuarioForm.checkValidity() || nuevoClave1.value !== nuevoClave2.value) {
        event.preventDefault();
        event.stopPropagation();
        nuevoClave1.classList.add('is-invalid');
        nuevoClave2.classList.add('is-invalid');
      } else {
        nuevoClave1.classList.remove('is-invalid');
        nuevoClave2.classList.remove('is-invalid');
      }
  
      nuevoUsuarioForm.classList.add('was-validated');
    });
  });*/