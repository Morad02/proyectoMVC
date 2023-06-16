<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-10">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/filtrar.php'?>
        <div class="row">
            <?php
            if(isset($datos['incidencias']))
            {
                foreach($datos['incidencias'] as $incidencia)
                { 
            ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="height: 460px;">
                    <?php
                    if(isset($incidencia['imagenes'][0]))
                    {
                    ?>
                    <img src="<?php echo 'data:image/jpeg;base64,'.$incidencia['imagenes'][0]['fotografia']?>" class="card-img-top" style="height: 300px;" alt="Imagen Incidencia">
                    <?php
                    }else{
                    ?>
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                    <?php
                    }
                    ?>
                    <div class="card-body">
                        <div style="height: 70px;">
                            <h5 class="card-title"><?php echo $incidencia['titulo']?></h5>
                            <p class="card-text pb-2" style="max-height: 30px;"><?php echo $incidencia['keywords']?></p>
                        </div>
                        <form action="<?php echo RUTA_URL.'/Incidencia/getIncidencia'?>" method="POST">
                            <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']?>">
                            <div class="d-flex justify-content-center pb-2 pt-8">
                                <button class="btn btn-primary">Ver más detalle</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?> 
        </div>
    </div>
    <div class="col-md-2 pt-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>