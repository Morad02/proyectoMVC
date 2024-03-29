<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-10 mt-4 mx-auto">
        <div class="row">
            <div class="d-flex justify-content-end mt-4 pb-2">
                <form action="<?php echo RUTA_URL.'/gestionUsuario/agregar'?>" method="POST">
                    <input type="hidden" name="nuevo" value="nuevo">
                    <button class="btn btn-primary" type="submit">Añadir usuario</button>
                </form>
            </div>
        </div>
        <?php
            if(isset($datos['usuarios']))
            {
                foreach($datos['usuarios'] as $usuario)
                { 
                    if(isset($usuario['email']) && $usuario['email'] != 'visitante@visitante.com')
                    {
        ?>
        <div class="row pt-2">
            <div class="col">
                <div class="d-flex flex-wrap">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title">Usuario: <?php echo isset($usuario['nombre']) ? $usuario['nombre'] : "";?></h5>
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-2 mb-2 pt-4">
                                        <img src="<?php echo isset($usuario['foto']) && $usuario['foto'] != null ? 'data:image/jpeg;base64,'. $usuario['foto']: RUTA_URL.'/img/usuario.svg';?>" alt="Imagen Usuario" class="img-fluid w-50 h-55">
                                    </div>
                                    <div class="col-md-10 mb-10">
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <p class="card-text">Email: <?php echo $usuario['email']?></p>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <p class="card-text">Direccion: <?php echo isset($usuario['direccion']) ? $usuario['direccion'] : "";?></p>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <p class="card-text">Telefono: <?php echo isset($usuario['telefono']) ? $usuario['telefono'] : "";?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-4">
                                                <p class="card-text">Rol: <?php echo isset($usuario['rol']) ? $usuario['rol'] : "";?></p>
                                            </div>
                                            <div class="col-md-4 mb-4">
                                                <p class="card-text">Estado: <?php echo isset($usuario['estado']) ? $usuario['estado'] : "";?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <form method="POST" action="<?php echo RUTA_URL.'/gestionUsuario/editar'?>">
                                    <input type="hidden" name="email" value="<?php echo $usuario['email']?>">
                                    <button class="btn btn-primary" type="submit">Modificar</button>
                                </form>
                                <form method="POST" action="<?php echo RUTA_URL.'/gestionUsuario/eliminar'?>">
                                    <input type="hidden" name="email" value="<?php echo $usuario['email']?>">
                                    <button class="btn btn-secondary ms-2">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
                    }
                }
            }   
        ?>
    </div>
    <div class="col-md-2">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>  
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>