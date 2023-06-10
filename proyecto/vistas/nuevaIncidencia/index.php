<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-6 mt-4 mx-auto">
        <form id="nuevaIncidencia" action="<?php echo RUTA_URL?>/GestionIncidencia/agregar" method="POST"  enctype="multipart/form-data">
          <div class="form-group pb-2">
            <label for="inputTitulo">Título</label>
            <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['titulo'])) ? 'is-invalid' : ''; ?>" id="inputTitulo" name="titulo" placeholder="Ingrese el título" value="<?php echo isset($datos['agregar']['titulo']) ? $datos['agregar']['titulo'] : ''; ?>" <?php echo isset($datos['agregar']['valido']) && $datos['agregar']['valido'] ? "readonly" : ''?>>
            <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['titulo']?></div>
          </div>
          <div class="form-group pb-2">
            <label for="inputDescripcion">Descripción</label>
            <textarea class="form-control <?php echo (isset($datos['agregar']['errores']['descripcion'])) ? 'is-invalid' : ''; ?>" id="inputDescripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción"  <?php echo isset($datos['agregar']['valido']) && $datos['agregar']['valido'] ? "readonly" : ''?>><?php echo isset($datos['agregar']['descripcion']) ? $datos['agregar']['descripcion'] : ''; ?></textarea>
            <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['descripcion']?></div>
          </div>
          <div class="form-group pb-2">
            <label for="inputLugar">Lugar</label>
            <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['lugar'])) ? 'is-invalid' : ''; ?>" id="inputLugar" name="lugar" placeholder="Ingrese el lugar" value="<?php echo isset($datos['agregar']['lugar']) ? $datos['agregar']['lugar'] : ''; ?>" <?php echo isset($datos['agregar']['valido']) && $datos['agregar']['valido'] ? "readonly" : ''?>>
            <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['lugar']?></div>
          </div>
          <div class="form-group pb-2">
            <label for="inputPalabrasClave">Palabras clave</label>
            <input type="text" class="form-control <?php echo (isset($datos['agregar']['errores']['palabras'])) ? 'is-invalid' : ''; ?>" id="inputPalabrasClave" name="keywords" placeholder="Ingrese las palabras clave" value="<?php echo isset($datos['agregar']['palabras']) ? $datos['agregar']['palabras'] : ''; ?>" <?php echo isset($datos['agregar']['valido']) && $datos['agregar']['valido'] ? "readonly" : ''?>>
            <div class="invalid-feedback"><?php echo $datos['agregar']['errores']['palabras']?></div>
          </div>
          <div class="form-group">
            <label for="inputImagenes">Imágenes</label>
            <input type="file" class="form-control" id="inputImagenes" name="imagenes[]" multiple accept="image/*">
          </div>
          <div class="form-group border">
            <label class="m-2">Imágenes seleccionadas:</label>
            <div id="previewImagenes" class="d-flex flex-wrap">
              <?php
                if(isset($datos['agregar']['imagenes']))
                {
                  foreach ($datos['agregar']['imagenes'] as $imagen)
                  {
              ?>
              <div>
                <img src="<?php echo 'data:image/jpeg;base64,' . $imagen ?>" alt="Imagen incidencia" class="img-thumbnail">
              </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>
          <div class="pt-3">
            <?php
              if(isset($datos['agregar']['valido'] ) && $datos['agregar']['valido'] )
              {
            ?>
            <input type="hidden" name="confirmado" value="confirmado">
            <button type="submit" class="btn btn-primary" id="confirmSubmit">Confirmar</button>
            <?php
              }
              else
              {
            ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <?php
              }
            ?>
          </div>
        </form>
  </div>
  <div class="col-md-3">
      <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
      <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
  </div>
</div>
<script src="<?php echo RUTA_URL?>/js/nIncidencia.js"></script>
<?php require_once RUTA_PROYECTO.'/vistas/inc/alert.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>
