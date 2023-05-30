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

$(document).ready(function() {
    $('#submitForm').click(function() {
      // Validar los campos del formulario
      if (!validateForm()) {
        return;
      }
  
      // Realizar la solicitud AJAX para enviar el formulario
      $.ajax({
        url: 'ruta_al_servidor',
        method: 'POST',
        data: $('#nuevoUsuarioForm').serialize(),
        success: function(response) {
          // Mostrar el modal de confirmación
          $('#confirmModal').modal('show');
        },
        error: function(xhr, status, error) {
          // Manejar el error en caso de que la solicitud falle
          console.error(error);
        }
      });
    });

    function validateForm() {
        var form = document.getElementById('nuevoUsuarioForm');
        var nombre = document.getElementById('nuevoNombre');
        var apellidos = document.getElementById('nuevoApellidos');
        var email = document.getElementById('nuevoEmail');
        var clave1 = document.getElementById('nuevoClave1');
        var clave2 = document.getElementById('nuevoClave2');
        var direccion = document.getElementById('nuevoDireccion');
        var telefono = document.getElementById('nuevoTelefono');
    
        form.classList.add('was-validated');
    
        if (form.checkValidity() === false) {
          return false;
        }
    
        if (clave1.value !== clave2.value) {
          clave1.classList.add('is-invalid');
          clave2.classList.add('is-invalid');
          return false;
        }
    
        return true;
      }
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