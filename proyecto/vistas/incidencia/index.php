<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<?php $incidencia = $datos['incidencia'];?>
<div class="row container-fluid">
    <div class="col-md-8 mt-5 mx-auto pl-5">
        <div id="Incidencia">
            <div class="row w-100">
                <h2 class="w-100 text-center h2 py-5" style="background-color: #f5f6f7;"><?php echo $incidencia['titulo']?></h2>
            </div>
            <div class="row">
                <ul class="list-unstyled">
                    <li class="pt-2">Lugar: <?php echo $incidencia['lugar']?></li>
                    <li class="pt-2">Fecha: <?php echo $incidencia['fecha']?></li>
                    <li class="pt-2">Creado por: <?php echo $incidencia['idusuario']?></li>
                    <li class="pt-2">Descripción: <?php echo $incidencia['descripcion']?></li>
                </ul>
            </div>
            <div class="container mt-5">
                <div class="row">
                    <?php
                        if(isset($incidencia['imagenes']))
                        {
                            foreach($incidencia['imagenes'] as $imagen)
                            {
                    ?>
                    <div class="col-md-4">
                        <img src="<?php echo 'data:image/jpeg;base64,' . $imagen['fotografia'] ?>"
                            alt="Imagen incidencia" class="img-fluid">
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
                                <th>Eliminar</th>
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
                                <?php if(isset($datos['sesion'])){
                                        if($comentario['idusuario'] == $datos['sesion']['email'] || $datos['sesion']['email'] == "admin@admin.com"){?>
                                            <td>
                                                <form action="<?php echo RUTA_URL.'/Incidencia/eliminarComentario'?>" method="POST">
                                                    <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']; ?>">
                                                    <input type="hidden" name="idComentario" value="<?php echo $comentario['id']; ?>">
                                                    <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                <?php   }
                                    } ?>
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
                    <form action="<?php echo RUTA_URL.'/Incidencia/comentar'?>" method="POST">
                        <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']; ?>">
                        <textarea class="form-control" name="comentario" placeholder="Escribe tu comentario..."></textarea>
                        <button class="btn btn-primary mt-2" type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="btn-container d-flex align-items-center justify-content-end">
            <div class="d-flex align-items-center">
                <form action="<?php echo RUTA_URL.'/Incidencia/votar'?>" method="POST">
                    <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']; ?>">
                    <input type="hidden" name="voto" value="1">
                    <button class="btn btn-round" type="submit">
                        <i class="fas fa-thumbs-up"></i>
                    </button>
                </form>
                <p><?php echo $incidencia['valoracionesPos']?></p>
            </div>
            <div class="d-flex align-items-center">
                <form action="<?php echo RUTA_URL.'/Incidencia/votar'?>" method="POST">
                    <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']; ?>">
                    <input type="hidden" name="voto" value="-1">
                    <button class="btn btn-round" type="submit">
                        <i class="fas fa-thumbs-down"></i>
                    </button>
                </form>
                <p><?php echo $incidencia['valoracionesNeg']?></p>
            </div>
            <button class="btn btn-round" type="button" data-toggle="collapse" data-target="#nuevo-comentario">
                <i class="fas fa-comment"></i>
            </button>
            <?php if(isset($datos['sesion'])){
                    if($incidencia['idusuario'] == $datos['sesion']['email'] || $datos['sesion']['email'] == "admin@admin.com"){?>
                        <form method="POST" action="<?php echo RUTA_URL.'/gestionIncidencia/editar'?>">
                            <input type="hidden" name="editar" value="<?php echo $incidencia['id']?>">
                            <button class="btn btn-round" type="submit" id="edit-button">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        <form method="POST" action="<?php echo RUTA_URL.'/gestionIncidencia/eliminarIncidencia'?>">
                            <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']?>">
                            <button class="btn btn-round" type="submit">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
            <?php   }
                } ?>
        </div>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>