<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-6 mt-4 mx-auto">
        <form id="nuevaIncidencia" action="<?php echo RUTA_URL?>/nuevaIncidencia/agregar" method="POST"  enctype="multipart/formdata">
          <div class="form-group">
            <label for="inputTitulo">Título</label>
            <input type="text" class="form-control" id="inputTitulo" name="titulo" placeholder="Ingrese el título">
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripción</label>
            <textarea class="form-control" id="inputDescripcion" name="descripcion" rows="3" placeholder="Ingrese la descripción"></textarea>
          </div>
          <div class="form-group">
            <label for="inputLugar">Lugar</label>
            <input type="text" class="form-control" id="inputLugar" name="lugar" placeholder="Ingrese el lugar">
          </div>
          <div class="form-group">
            <label for="inputPalabrasClave">Palabras clave</label>
            <input type="text" class="form-control" id="inputPalabrasClave" name="keywords" placeholder="Ingrese las palabras clave">
          </div>
          <div class="form-group">
            <label for="inputImagenes">Imágenes</label>
            <input type="file" class="form-control" id="inputImagenes" name="imagenes" multiple accept="image/*">
          </div>
          <div class="form-group border">
            <label class="m-2">Imágenes seleccionadas:</label>
            <div id="previewImagenes" class="d-flex flex-wrap"></div>
          </div>
          <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
  </div>
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que quiere crear la incidencia?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" id="confirmSubmit">Enviar</button>
        </div>
      </div>
    </div>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<script src="<?php echo RUTA_URL?>/js/nIncidencia.js"></script>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>
