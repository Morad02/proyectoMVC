<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-8 mt-5 mx-auto pl-5">
        <form id="estadoIncidencia" action="<?php echo RUTA_URL.'/gestionIncidencia/editar'?>" method="POST">
            <h5>Estado de la incidencia:</h5>
            <div class="form-group m-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="pendiente" value="Pendiente" 
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Pendiente') ? 'checked ' : ''; ?>
                 <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="pendiente">
                  Pendiente
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="comprobada" value="Comprobada"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Comprobada') ? 'checked ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="comprobada">
                  Comprobada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="tramitada" value="Tramitada"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Tramitada') ? 'checked ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="tramitada">
                  Tramitada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="irresoluble" value="Irresoluble"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Irresoluble') ? 'checked ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="irresoluble">
                  Irresoluble
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="resuelta" value="Resuelta"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Resuelta') ? 'checked ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="resuelta">
                  Resuelta
                </label>
              </div>
              <input type="hidden" name="estado2" value="<?php echo $datos['edicion']['estado']?>">
            </div>
            <div class="form-group m-3">
                <h5>Datos principales:</h5>
                <div class="m-3">
                    <div class="form-group">
                      <label for="inputTitulo">Título</label>
                      <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['titulo'])) ? 'is-invalid' : ''; ?>" id="inputTitulo" name="titulo"
                        value="<?php echo isset($datos['edicion']['titulo']) ? $datos['edicion']['titulo'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['titulo']?></div>
                    </div>
                    <div class="form-group">
                      <label for="inputDescripcion">Descripción</label>
                      <textarea class="form-control <?php echo (isset($datos['edicion']['errores']['descripcion'])) ? 'is-invalid' : ''; ?>" id="inputDescripcion" rows="3" name="descripcion" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>><?php echo isset($datos['edicion']['descripcion']) ? $datos['edicion']['descripcion'] : ''; ?></textarea>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['descripcion']?></div>
                    </div>
                    <div class="form-group">
                      <label for="inputLugar">Lugar</label>
                      <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['lugar'])) ? 'is-invalid' : ''; ?>" id="inputLugar" name="lugar"
                        value="<?php echo isset($datos['edicion']['lugar']) ? $datos['edicion']['lugar'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['lugar']?></div>  
                    </div>
                    <div class="form-group">
                      <label for="inputPalabrasClave">Palabras clave</label>
                      <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['keywords'])) ? 'is-invalid' : ''; ?>" id="inputPalabrasClave" name="keywords"
                        value="<?php echo isset($datos['edicion']['keywords']) ? $datos['edicion']['keywords'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['keywords']?></div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="editando" value="<?php echo $datos['edicion']['idIncidencia']?>">
            <?php
            if(isset($datos['edicion']['valido'] ) && $datos['edicion']['valido'] )
            {
            ?>
            <input type="hidden" name="confirmado" value="<?php echo $datos['edicion']['idIncidencia']?>">
            <?php
              }
            ?>
        </form>
        <form action="<?php echo RUTA_URL.'/gestionIncidencia/subirFotos'?>" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="subir" value="<?php echo $datos['edicion']['idIncidencia']?>">
          <div class="form-group">
            <label for="inputImagenes">Subir imágenes</label>
            <input type="file" class="form-control" id="inputImagenes" name="imagenes[]" multiple accept="image/*">
            <button class="btn btn-round" type="submit"><i class="fas fa-upload"></i></button>
          </div>
        </form>
        <div class="form-group">
            <label class="m-2">Imágenes:</label>
            <div id="previewImagenes" class="d-flex flex-wrap border">
              <?php
                if(isset($datos['edicion']['imagenes']))
                {
                  foreach ($datos['edicion']['imagenes'] as $imagen)
                  {
              ?>
                <div>
                    <img src="<?php echo 'data:image/jpeg;base64,' . $imagen['fotografia'] ?>" alt="Imagen incidencia" class="img-thumbnail">
                    <form action="<?php echo RUTA_URL.'/gestionIncidencia/eliminarFoto'?>" method="POST">
                        <input type="hidden" name="borrarImagen" value="<?php echo $imagen['id']?>">
                        <input type="hidden" name="idIncidencia" value="<?php echo $datos['edicion']['idIncidencia']?>">
                        <button class="btn btn-round" type="submit"><i class="fas fa-trash"></i></button>
                    </form>    
                </div>
              <?php
                  }
                }
              ?>
            </div>
        </div>
        <?php
          if(isset($datos['edicion']['valido'] ) && $datos['edicion']['valido'] )
          {
          ?>
          <button type="submit" class="btn btn-primary" id="confirmSubmit" form="estadoIncidencia">Confirmar</button>
          <?php
            }
            else
            {
          ?>
          <button type="submit" class="btn btn-primary" form="estadoIncidencia">Enviar</button>
          <?php
            }
          ?>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<script src="<?php echo RUTA_URL?>/js/nIncidencia.js"></script>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>