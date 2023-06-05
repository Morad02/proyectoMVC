<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-6 mt-4 mx-auto">
        <form id="nuevoUsuarioForm" class="needs-validation" novalidate enctype="multipart/form-data" action="<?php echo $datos['action']?>" method="POST">
            <div class="form-group foto">
              <label for="foto">Foto</label>
              <div class="row">
                <div class="col-md-4">
                  <img id="imagenPrevia" src="<?php echo isset($datos['edicion']['img']) ? 'data:image/jpeg;base64,' . $datos['edicion']['img'] : RUTA_URL.'/img/usuario.svg'; ?>" alt="Foto de usuario" class="img-fluid w-50 h-50">
                </div>
                <div class="col-md-8">
                  <input type="file" class="form-control-file" id="nuevoFoto" name="nuevoFoto" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "disabled" : ''?>>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="nombre">Nombre:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['nombre'])) ? 'is-invalid' : ''; ?>" id="nuevoNombre" name="nuevoNombre" required value="<?php echo isset($datos['edicion']['nombre']) ? $datos['edicion']['nombre'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['nombre'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="apellidos">Apellidos:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['apellidos'])) ? 'is-invalid' : ''; ?>" id="nuevoApellidos" name="nuevoApellidos" required value="<?php echo isset($datos['edicion']['apellidos']) ? $datos['edicion']['apellidos'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['apellidos'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="email">Email:</label>
                </div>
                <div class="col-md-4">
                  <input type="email" class="form-control <?php echo (isset($datos['edicion']['errores']['email'])) ? 'is-invalid' : ''; ?>" id="nuevoEmail" name="nuevoEmail" required value="<?php echo isset($datos['edicion']['email']) ? $datos['edicion']['email'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['email'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="clave1">Clave:</label>
                </div>
                <div class="col-md-4">
                  <input type="password" class="form-control <?php echo (isset($datos['edicion']['errores']['clave1'])) ? 'is-invalid' : ''; ?>" id="nuevoClave1" name="nuevoClave1" required value="<?php echo isset($datos['edicion']['password']) ? $datos['edicion']['password'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['clave1']; ?></div>
                </div>
                <div class="col-md-4">
                  <input type="password" class="form-control <?php echo (isset($datos['edicion']['errores']['clave2'])) ? 'is-invalid' : ''; ?>" id="nuevoClave2" name="nuevoClave2" required value="<?php echo isset($datos['edicion']['password']) ? $datos['edicion']['password'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['clave2']; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="direccion">Dirección:</label>
                </div>
                <div class="col-md-4">
                  <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['direccion'])) ? 'is-invalid' : ''; ?>" id="nuevoDireccion" name="nuevoDireccion" required value="<?php echo isset($datos['edicion']['direccion']) ? $datos['edicion']['direccion'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo$datos['edicion']['errores']['direccion'] ?? 'Campo obligatorio'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="telefono">Teléfono:</label>
                </div>
                <div class="col-md-4">
                  <input type="tel" class="form-control <?php echo isset($datos['edicion']['errores']['telefono']) ? 'is-invalid' : ''; ?>" id="nuevoTelefono" pattern="[0-9]{9}" name="nuevoTelefono" required value="<?php echo isset($datos['edicion']['telefono']) ? $datos['edicion']['telefono'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['telefono'] ?? 'Por favor, ingresa un número de teléfono válido (9 dígitos numéricos)'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="rol">Rol:</label>
                </div>
                <div class="col-md-4">
                  <select class="form-control <?php echo (isset($datos['edicion']['errores']['rol']) && $datos['sesion']['rol'] != 'user') ? 'is-invalid' : ''; ?>" id="nuevoRol" name="nuevoRol" required <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                    <option value="">Seleccione un rol</option>
                    <option value="admin" <?php echo (isset($datos['edicion']['rol']) && $datos['edicion']['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="user" <?php echo (isset($datos['edicion']['rol']) && $datos['edicion']['rol'] == 'user') ? 'selected' : ''; ?>>Colaborador</option>
                  </select>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['rol'] ?? 'Seleccione un rol'; ?></div>
                </div>
              </div>
            </div>
            <div class="form-group form-item">
              <div class="row align-items-center g-2">
                <div class="col-md-1">
                  <label for="estado">Estado:</label>
                </div>
                <div class="col-md-4">
                  <select class="form-control <?php echo (isset($datos['edicion']['errores']['estado']) && $datos['sesion']['rol'] != 'user') ? 'is-invalid' : ''; ?>" id="nuevoEstado" name="nuevoEstado" required <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                    <option value="">Seleccione un estado</option>
                    <option value="activo" <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                  </select>
                  <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['estado'] ?? 'Seleccione un estado'; ?></div>
                </div>
              </div>
            </div>
            <?php if (isset($datos['edicion']['valido']) && $datos['edicion']['valido'])
                {

            ?>
            <div class="d-flex justify-content-end mt-4 pb-2">
                    <input type="hidden" name="confirmado" value="confirmado">
                    <input type="hidden" name="rolConfirm" value="<?php echo $datos['edicion']['rol']?>">
                    <input type="hidden" name="estadoConfirm" value="<?php echo $datos['edicion']['estado']?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-confirm"></i> Confirmar
                    </button>
            </div> 
            <?php
                }
                else 
                {
            ?>
            <div class="d-flex justify-content-end mt-4 pb-2">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
            <?php
                }
            ?>  
        </form>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div> 
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>