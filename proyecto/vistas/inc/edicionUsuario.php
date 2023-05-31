<div class="modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edición de usuario</h5>
          <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"></span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col titulousuario">
                <h3>Edición de usuario</h3>
              </div>
            </div>
            <form id="edicionUsuarioForm" class="needs-validation" novalidate enctype="multipart/form-data" action="<?php echo RUTA_URL?>/gestionUsuario/modificar" method="POST">
              <div class="form-group foto">
                <label for="foto">Foto</label>
                <div class="row">
                  <div class="col-md-4">
                    <img src="<?php echo $datos['imagen']?>" alt="Foto de usuario" class="img-fluid">
                  </div>
                  <div class="col-md-8">
                    <input type="file" class="form-control-file" id="foto" name="foto">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="nombre">Nombre:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $datos['nombre']?>">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="apellidos">Apellidos:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="apellidos" name='apellidos' value="<?php echo $datos['apellidos']?>">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="email">Email:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $datos['email']?>">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="clave1">Clave:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="clave1" name="clave1">
                  </div>
                  <div class="col-md-4">
                    <input type="password" class="form-control" id="clave2" name="clave2">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="direccion">Dirección:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $datos['direccion']?>">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="telefono">Telefono:</label>
                  </div>
                  <div class="col-md-4">
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $datos['telefono']?>">
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="rol">Rol:</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" id="rol" name="rol" <?php echo $datos['rol']?>>
                      <option value="admin">Administrador</option>
                      <option value="user">Colaborador</option>
                      <option value="user">Visitante</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group form-item">
                <div class="row align-items-center g-2">
                  <div class="col-md-1">
                    <label for="estado">Estado:</label>
                  </div>
                  <div class="col-md-4">
                    <select class="form-control" id="estado" name="estado" <?php echo $datos['estado']?>>
                      <option value="activo">Activo</option>
                      <option value="inactivo">Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="button">
            <i class="fas fa-save"></i> Guardar
          </button>
        </div>
      </div>
    </div>
  </div>