
<?php 
    if($datos['sesion'] = NULL)
    {

?>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Iniciar sesión</h5>
                <form>
                    <div class="form-group">
                        <label for="inputEmail">Correo electrónico</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Contraseña</label>
                        <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña">
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
                        <p class="mb-0">Pepitp Pérez</p>
                        <p class="text-muted small">Administrador</p>
                    </div>
                    <img src="./imagenes/usuario.svg" alt="Foto de perfil" class="img-fluid mb-3">
                    <div>
                        <button class="btn btn-primary">Editar usuario</button>
                        <button class="btn btn-danger">Cerrar sesión</button>
                    </div>
                </div>
            </div>
<?php
    }
?>