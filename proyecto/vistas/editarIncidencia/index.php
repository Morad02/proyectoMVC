<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-8 mt-5 mx-auto pl-5">
        <form id="estadoIncidencia">
            <h5>Estado de la incidencia:</h5>
            <div class="form-group m-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="pendiente" value="pendiente" checked>
                <label class="form-check-label" for="pendiente">
                  Pendiente
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="comprobada" value="comprobada">
                <label class="form-check-label" for="comprobada">
                  Comprobada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="tramitada" value="tramitada">
                <label class="form-check-label" for="tramitada">
                  Tramitada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="irresoluble" value="irresoluble">
                <label class="form-check-label" for="irresoluble">
                  Irresoluble
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="resuelta" value="resuelta">
                <label class="form-check-label" for="resuelta">
                  Resuelta
                </label>
              </div>
            </div>
            <div class="form-group m-3">
                <h5>Datos principales:</h5>
                <div class="m-3">
                    <div class="form-group">
                      <label for="inputTitulo">Título</label>
                      <input type="text" class="form-control" id="inputTitulo" name="titulo" value="">
                    </div>
                    <div class="form-group">
                      <label for="inputDescripcion">Descripción</label>
                      <textarea class="form-control" id="inputDescripcion" rows="3" name="descripcion"></textarea>
                    </div>
                    <div class="form-group">
                      <label for="inputLugar">Lugar</label>
                      <input type="text" class="form-control" id="inputLugar" name="lugar" value="">
                    </div>
                    <div class="form-group">
                      <label for="inputPalabrasClave">Palabras clave</label>
                      <input type="text" class="form-control" id="inputPalabrasClave" name="palabras" value="">
                    </div>
                    <div class="form-group">
                        <label class="m-2">Imágenes:</label>
                        <div id="previewImagenes" class="d-flex flex-wrap border">
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
                </div>
            </div>
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
            <input type="hidden" name="editando" value="">
            <button type="submit" class="btn btn-primary">Enviar</button>
            <?php
              }
            ?>
        </form>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>