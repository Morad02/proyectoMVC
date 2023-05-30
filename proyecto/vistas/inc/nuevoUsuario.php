<div class="modal" id="nuevoModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Nuevo usuario</h5>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <form id="nuevoUsuarioForm" class="needs-validation" novalidate>
              <div class="form-group foto">
                <label for="foto">Foto</label>
                <div class="row">
                  <div class="col-md-4">
                    <img id="imagenPrevia" src="<?php echo RUTA_URL?>/img/usuario.svg" alt="Foto de usuario" class="img-fluid w-50 h-50">
                  </div>
                  <div class="col-md-8">
                    <input type="file" class="form-control-file" id="nuevoFoto">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="nombre">Nombre:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nuevoNombre" required>
                    <div class="invalid-feedback">Campo obligatorio</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="apellidos">Apellidos:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nuevoApellidos" required>
                    <div class="invalid-feedback">Por favor, ingresa los apellidos.</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="email">Email:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="email" class="form-control" id="nuevoEmail" required>
                    <div class="invalid-feedback">Email inválido</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="clave1">Clave:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="nuevoClave1" required>
                    <div class="invalid-feedback">La clave debe tener al menos 6 caracteres</div>
                  </div>
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="nuevoClave2" required>
                    <div class="invalid-feedback">Las claves no coinciden</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="direccion">Dirección:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nuevoDireccion" required>
                    <div class="invalid-feedback">Por favor, ingresa una dirección.</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="telefono">Teléfono:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="tel" class="form-control" id="nuevoTelefono" pattern="[0-9]{9}" required>
                    <div class="invalid-feedback">Por favor, ingresa un número de teléfono válido (10 dígitos numéricos).</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="rol">Rol:</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" id="nuevoRol" required>
                      <option value="">Seleccione un rol</option>
                      <option value="admin">Administrador</option>
                      <option value="user">Colaborador</option>
                    </select>
                    <div class="invalid-feedback">Seleccione un rol</div>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="estado">Estado:</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" id="nuevoEstado" required>
                      <option value="">Seleccione un estado</option>
                      <option value="activo">Activo</option>
                      <option value="inactivo">Inactivo</option>
                    </select>
                    <div class="invalid-feedback">Seleccione un estado</div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit" form="nuevoUsuarioForm" id="submitForm">
            <i class="fas fa-save"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>
 
    