<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<?php $incidencia = $datos['incidencia'];?>
<div class="row">
    <div class="col-md-8 mt-5 mx-auto pl-5">
        <div id="Incidencia">
            <h2 class="titulousuario"><?php echo $incidencia['titulo']?></h2>
            <ul class="list-unstyled">
                <li class="pt-2">Lugar: <?php echo $incidencia['lugar']?></li>
                <li class="pt-2">Fecha: <?php echo $incidencia['fecha']?></li>
                <li class="pt-2">Creado por: <?php echo $incidencia['idusuario']?></li>
                <li class="pt-2">Descripción: <?php echo $incidencia['descripcion']?></li>
            </ul>
            <div class="container mt-5">
                <div class="row">
                    <?php
                        if(isset($incidencia['imagenes']))
                        {
                            foreach($incidencia['imagenes'] as $imagen)
                            {
                    ?>
                    <div class="col-md-4">
                        <img src="<?php echo 'data:image/jpeg;base64,' . $imagen['fotografia'] ?>" alt="Imagen incidencia" class="img-fluid">
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
            </div>
            <?php
                if(isset($incidencia['comentarios']))
                {
            ?>
            <div class="row">
                <div class="container ml-5 mt-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre y fecha</th>
                            <th>Comentario</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php   
                            foreach($incidencia['comentarios'] as $comentario)
                            {
                        ?>
                        <tr>
                            <td><?php echo $comentario['idusuario']?><br><?php echo $comentario['fecha']?></td>
                            <td><?php echo $comentario['comentario']?></td>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
                }   
            ?>
            <div id="nuevo-comentario-container">
                <div id="nuevo-comentario" class="collapse">
                    <textarea class="form-control" placeholder="Escribe tu comentario..."></textarea>
                    <button class="btn btn-primary mt-2" type="button">Enviar</button>
                </div>
            </div>
        </div>
        <div class="btn-container d-flex align-items-center justify-content-end">
            <div class="d-flex align-items-center">
                <button class="btn btn-round" type="button">
                    <i class="fas fa-thumbs-up"></i>
                </button>
                <p><?php echo $incidencia['valoracionesPos']?></p>
            </div>
            <div class="d-flex align-items-center">
                <button class="btn btn-round" type="button">
                    <i class="fas fa-thumbs-down"></i>
                </button>
                <p><?php echo $incidencia['valoracionesNeg']?></p>
            </div>
            <button class="btn btn-round" type="button" data-toggle="collapse" data-target="#nuevo-comentario">
                <i class="fas fa-comment"></i>
            </button>
            <form method="POST" action="<?php echo RUTA_URL.'/gestionIncidencia/editar'?>">
                <input type="hidden" name="editar" value="<?php echo $incidencia['idIncidencia']?>">
                <button class="btn btn-round" type="submit" id="edit-button">
                    <i class="fas fa-edit"></i>
                </button>
            </form>
            <button class="btn btn-round" type="button">
                <i class="fas fa-trash"></i>
            </button>
        </div>       
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>