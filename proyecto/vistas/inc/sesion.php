
<?php 
    if(!isset($datos['email']))
    {

?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Iniciar sesión</h5>
                <form action="<?php echo RUTA_URL?>/inicio/login" method="POST">
                    <div class="form-group">
                        <label for="inputEmail">Correo electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Correo electrónico" name="email">
                    </div>
                    <div class="form-group">
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
            <div class="card mt-4">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <p class="mb-0"><?php echo $datos['nombre']?></p>
                        <p class="text-muted small"><?php echo $datos['rol']?></p>
                    </div>
                    <img src="<?php echo RUTA_URL?>/img/fperfil.png" alt="Foto de perfil" class="img-fluid mb-3">
                    <div>
                        <button class="btn btn-primary">Editar usuario</button>
                        <a href="<?php echo RUTA_URL?>/inico/logout" class="btn btn-danger" role="button">Cerrar sesión</a>
                    </div>
                </div>
            </div>
<?php
    }
?>