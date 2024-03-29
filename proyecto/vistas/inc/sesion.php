
<?php 
    if(!isset($datos['sesion']))
    {

?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Iniciar sesión</h5>
                <form action="<?php echo RUTA_URL?>/inicio/login" method="POST">
                    <div class="form-group pt-2">
                        <label for="inputEmail">Correo electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Correo electrónico" name="email">
                    </div>
                    <div class="form-group pt-2 pb-3">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </form>
            </div>
        </div>

<?php
    }
    else
    {
?>
            <div class="card">
                <div class="card-body text-center">
                    <div class="mb-2">
                        <p class="mb-0"><?php echo $datos['sesion']['nombre']?></p>
                        <p class="text-muted small"><?php echo $datos['sesion']['rol']?></p>
                    </div>
                    <img src="<?php echo 'data:image/jpeg;base64,'.$datos['sesion']['foto']?>" alt="Foto de perfil" class="img-fluid rounded-circle pb-5">
                    <div class="button-container">
                        <form action="<?php echo RUTA_URL.'/gestionUsuario/editar'?>" method="POST">
                            <input type="hidden" name="email" value="<?php echo $datos['sesion']['email']?>">
                            <button class="btn btn-primary" type="submit">Editar usuario</button>
                            <a href="<?php echo RUTA_URL?>/inico/logout" class="btn btn-danger" role="button">Cerrar sesión</a>
                        </form>
                    </div>
                </div>
            </div>
<?php
    }
?>