<div class="modal" id="nuevoModal">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Nuevo usuario </h5>
        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <form id="nuevoUsuarioForm" class="needs-validation" novalidate enctype="multipart/form-data" action="<?php echo RUTA_URL?>/gestionUsuario/agregar" method="POST">
            <div class="form-group foto">
              <label for="foto">Foto</label>
              <div class="row">
                <div class="col-md-4">
                  <img id="imagenPrevia" src="<?php echo isset($datos['agregar']['valido']) && !$datos['agregar']['valido'] && isset($datos['agregar']['img']) ? $datos['agregar']['img'] : RUTA_URL.'/img/usuario.svg'; ?>" alt="Foto de usuario" class="img-fluid w-50 h-50">
                </div>
                <div class="col-md-8">
                  <input type="file" class="form-control-file" id="nuevoFoto" name="nuevoFoto">
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="nombre">Nombre:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['nombre'])) ? 'is-invalid' : ''; ?>" id="nuevoNombre" name="nuevoNombre" required value="<?php echo isset($datos['agregar']['nombre']) ? $datos['agregar']['nombre'] : ''; ?>">
                  <div class="invalid-feedback"><?php echo$datos['errores']['nombre'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="apellidos">Apellidos:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['apellidos'])) ? 'is-invalid' : ''; ?>" id="nuevoApellidos" name="nuevoApellidos" required value="<?php echo isset($datos['agregar']['apellidos']) ? $datos['agregar']['apellidos'] : ''; ?>">
                  <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['apellidos'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="email">Email:</label>
                </div>
                <div class="col-md-4">
                  <input type="email" class="form-control <?php echo (isset($datos['agregar']['errores']['email'])) ? 'is-invalid' : ''; ?>" id="nuevoEmail" name="nuevoEmail" required value="<?php echo isset($datos['agregar']['email']) ? $datos['agregar']['email'] : ''; ?>">
                  <div class="invalid-feedback"><?php echo $datos['errores']['email'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="clave1">Clave:</label>
                </div>
                <div class="col-md-4">
                  <input type="password" class="form-control <?php echo (isset($datos['agregar']['errores']['clave1'])) ? 'is-invalid' : ''; ?>" id="nuevoClave1" name="nuevoClave1" required>
                  <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['clave1'] ?? 'La clave debe tener al menos 6 caracteres'; ?></div>
                </div>
                <div class="col-md-4">
                  <input type="password" class="form-control <?php echo (isset($datos['errores']['clave2'])) ? 'is-invalid' : ''; ?>" id="nuevoClave2" name="nuevoClave2" required>
                  <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['clave2'] ?? 'Las claves no coinciden'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="direccion">Dirección:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['direccion'])) ? 'is-invalid' : ''; ?>" id="nuevoDireccion" name="nuevoDireccion" required value="<?php echo isset($datos['agregar']['direccion']) ? $datos['agregar']['direccion'] : ''; ?>">
                  <div class="invalid-feedback"><?php echo$datos['agregar']['errores']['direccion'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="telefono">Teléfono:</label>
                </div>
                <div class="col-md-4">
                  <input type="tel" class="form-control <?php echo isset($datos['agregar']['errores']['telefono']) ? 'is-invalid' : ''; ?>" id="nuevoTelefono" pattern="[0-9]{9}" name="nuevoTelefono" required value="<?php echo isset($datos['agregar']['telefono']) ? $datos['agregar']['telefono'] : ''; ?>">
                  <div class="invalid-feedback"><?php echo $datos['errores']['telefono'] ?? 'Por favor, ingresa un número de teléfono válido (9 dígitos numéricos)'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="rol">Rol:</label>
                </div>
                <div class="col-md-4">
                  <select class="form-control <?php echo (isset($datos['agregar']['errores']['rol'])) ? 'is-invalid' : ''; ?>" id="nuevoRol" name="nuevoRol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="admin" <?php echo (isset($datos['agregar']['rol']) && $datos['agregar']['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="user" <?php echo (isset($datos['agregar']['rol']) && $datos['agregar']['rol'] == 'user') ? 'selected' : ''; ?>>Colaborador</option>
                  </select>
                  <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['rol'] ?? 'Seleccione un rol'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="estado">Estado:</label>
                </div>
                <div class="col-md-4">
                  <select class="form-control <?php echo (isset($datos['agregar']['errores']['estado'])) ? 'is-invalid' : ''; ?>" id="nuevoEstado" name="nuevoEstado" required>
                    <option value="">Seleccione un estado</option>
                    <option value="activo" <?php echo (isset($datos['agregar']['estado']) && $datos['agregar']['estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo (isset($datos['agregar']['estado']) && $datos['agregar']['estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                  </select>
                  <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['estado'] ?? 'Seleccione un estado'; ?></div>
                </div>
              </div>
            </div>
              <?php if(isset($datos['agregar']['editar']) && $datos['agregar']['editar'])
                      echo "<input type='hidden' name='guardar' value='guardar'>";
              ?>
            </form>
          </div>
        </div>
        <div class="modal-footer">
           <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#confirmModal">
            <i class="fas fa-save"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="confirmModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>¿Estás seguro de enviar el formulario?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="confirmSubmit">Confirmar</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal" id="successModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Éxito</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>El formulario se ha enviado correctamente.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>


    