<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-9 mt-4 mx-auto">
        <div class="row">
            <div class="d-flex justify-content-end mt-4 pb-2">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoModal">Añadir usuario</button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex flex-wrap">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title">Usuario: Federico</h5>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-2 mb-2 pt-4">
                                    <img src="/imagenes/usuario.svg" alt="Imagen Usuario" class="img-fluid">
                                    </div>
                                    <div class="col-md-10 mb-10">
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <p class="card-text">Email: federico@gmail.com</p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <p class="card-text">Direccion: C/Francisco Nº15</p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <p class="card-text">Telefono: 111222333</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 mb-4">
                                            <p class="card-text">Rol: Administrador</p>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <p class="card-text">Estado: Activo</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Modificar</button>
                            <button class="btn btn-secondary ms-2">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div> 
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/edicionUsuario.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/nuevoUsuario.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>