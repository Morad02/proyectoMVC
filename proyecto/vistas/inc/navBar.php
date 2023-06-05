<nav class="navbar navbar-expand-md navbar-light">
    <a class="navbar-brand" href="#">
        <img src="<?php echo RUTA_URL?>/Imagenes/icono.png" width="30" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar-toggler">            
        <ul class="navbar-nav d-flex justify-content-center align-items-center">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTA_URL?>">Ver incidencias</a>
            </li>

            <?php if(isset($datos['sesion']))
                 {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTA_URL?>/nuevaIncidencia">Nueva incidencia</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTA_URL?>/inicio/misIncidencias">Mis incidencias</a>
            </li>
            <?php
                 }
            ?>
            <?php
                if(isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'admin')
                {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTA_URL?>/gestionUsuario">Gestión de usuarios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo RUTA_URL?>/log">Ver log</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Gestión de BBDD</a>
            </li>
            <?php
                }
            ?>
                
        </ul>
    </div>
</nav>