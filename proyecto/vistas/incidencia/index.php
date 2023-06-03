<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-9 mt-4 mx-auto">
        <h5>>Incidencia</h5>
        <div class="col-12 col-md-9">
            <div id="incidencia">
                <h2><?php echo $datos['incidencia']['titulo']?></h2>
                <ul class="list-unstyled">
                    <li class="d-inline">Lugar:<?php echo $datos['incidencia']['lugar']?></li>
                    <li class="d-inline">Fecha:<?php echo $datos['incidencia']['fecha']?></li>
                    <li class="d-inline">Creado por:<?php echo $datos['incidencia']['usuario']?></li>
                </ul>
                <ul class="list-unstyled">
                    <li class="d-inline">Palabras clave:<?php echo $datos['incidencia']['titulo']?></li>
                    <li class="d-inline">Estado:<?php echo $datos['incidencia']['estado']?></li>
                    <li class="d-inline">Valoraciones:</li>
                </ul>
                <p class="w-100"><?php echo $datos['incidencia']['descripcion']?></p>
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Bhikh1PD4-vSH8nE4ScdnuBCw3DRyOpg90hU98rPFgue2BzgYcJvoIAbwveioIDIws0&usqp=CAU" alt="Imagen 1" class="img-fluid">
                        </div>
                        <div class="col-md-4">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjMk4aZQSEMidEG9Ymq1GScdG762GVFdc6pw&usqp=CAU" alt="Imagen 2" class="img-fluid">
                        </div>
                        <div class="col-md-4">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7EqB2Kp6EX4N_Q6knJLt3u_NjWRR2JHxXxA&usqp=CAU" alt="Imagen 3" class="img-fluid">
                        </div>
                    </div>
                </div>
                <?php
                    if(isset($datos['incidencia']['comentarios']))
                    {
                ?>
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nombre y fecha</th>
                            <th>Comentario</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php    
                            foreach($datos['incidencia']['comentarios'] as $comentario)
                            { 
                        ?>
                        <tr>
                            <td><?php echo $comentario['nombre']?><br><?php echo $comentario['fecha']?></td>
                            <td><?php echo $comentario['texto']?></td>
                        </tr>
                        <?php
                            }
                        ?>
                        </tbody>
                    </table>
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
        </div> 
        <div class="btn-container">
            <button class="btn btn-round" type="button">
                <i class="fas fa-plus"></i>
            </button>
            <button class="btn btn-round" type="button">
                <i class="fas fa-minus"></i>
            </button>
            <button class="btn btn-round" type="button" data-toggle="collapse" data-target="#nuevo-comentario">
                <i class="fas fa-comment"></i>
            </button>
            <button class="btn btn-round" type="button" id="edit-button">
                <i class="fas fa-edit"></i>
            </button>
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