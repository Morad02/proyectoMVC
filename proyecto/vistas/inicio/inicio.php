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
                    <?php
                    if(isset($incidencia['imagenes'][0]))
                    {
                ?>
                    <img src="<?php echo 'data:image/jpeg;base64,'.$incidencia['imagenes'][0]['fotografia']?>" class="card-img-top" alt="Imagen Incidencia">
                    <?php
                    }else{
                ?>
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                    <?php
                    }
                ?>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $incidencia['titulo']?></h5>
                        <p class="card-text"><?php echo $incidencia['descripcion']?></p>
                        <form action="<?php echo RUTA_URL.'/Incidencia/getIncidencia'?>" method="POST">
                            <input type="hidden" name="idIncidencia" value="<?php echo $incidencia['id']?>">
                            <div class="d-flex justify-content-center">
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
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<div id="successDanger" class="alert alert-danger fixed-bottom mb-0 text-center" role="alert" style="display: none;">
        Inicio de sesión fallido
</div> 
<div id="successAlert" class="alert alert-success fixed-bottom mb-0 text-center" role="alert" style="display: none;">
        Inicio de sesión correcto
</div>
  <?php
    if(isset($datos['error']))
    {

  ?>
  <script>
    // Mostrar el alerta de éxito
    document.getElementById('successDanger').style.display = 'block';

    // Desaparecer después de 5 segundos
    setTimeout(function() {
      document.getElementById('successDanger').style.display = 'none';
    }, 5000);
  </script>
    <?php
        }
        else if (isset($datos['exito']))
        {

    ?>
    <script>
    // Mostrar el alerta de éxito
    document.getElementById('successAlert').style.display = 'block';

    // Desaparecer después de 5 segundos
    setTimeout(function() {
      document.getElementById('successAlert').style.display = 'none';
    }, 5000);
  </script>
    <?php
        }
    ?>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>