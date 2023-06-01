<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-9">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/filtrar.php'?>
        <div class="row">
        <?php
            if(isset($datos['incidencias']))
            {
                foreach($datos['incidencias'] as $incidencia)
                { 
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $datos['incidencia']['imagenes'][0]?>" class="card-img-top" alt="Imagen Incidencia">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $datos['incidencia']['titulo']?></h5>
                        <p class="card-text"><?php echo $datos['incidencia']['valoracion']?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mi-modal">Ver más detalle</button>
                    </div>
                </div>
            </div>
        <?php
                }
            }
        ?>    
        </div>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div> 
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/incidencia.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>