<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-8 mt-5 mx-auto pl-5">
        <form id="estadoIncidencia">
            <h5>Estado de la incidencia:</h5>
            <div class="form-group m-3">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="pendiente" value="Pendiente" 
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Pendiente') ? 'selected ' : ''; ?>
                 <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="pendiente">
                  Pendiente
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="comprobada" value="Comprobada"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Comprobada') ? 'selected ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="comprobada">
                  Comprobada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="tramitada" value="Tramitada"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Tramitada') ? 'selected ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="tramitada">
                  Tramitada
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="irresoluble" value="Irresoluble"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Irresoluble') ? 'selected ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
                <label class="form-check-label" for="irresoluble">
                  Irresoluble
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="estado" id="resuelta" value="Resuelta"
                <?php echo (isset($datos['edicion']['estado']) && $datos['edicion']['estado'] == 'Resuelta') ? 'selected ' : ''; ?>
                <?php echo (isset($datos['edicion']['valido']) && $datos['edicion']['valido']) || (isset($datos['sesion']['rol']) && $datos['sesion']['rol'] == 'user') ? "disabled" : ''?>>
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
                      <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['titulo'])) ? 'is-invalid' : ''; ?>" id="inputTitulo" name="titulo"
                        value="<?php echo isset($datos['edicion']['titulo']) ? $datos['edicion']['titulo'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['titulo']?></div>
                    </div>
                    <div class="form-group">
                      <label for="inputDescripcion">Descripción</label>
                      <textarea class="form-control <?php echo (isset($datos['edicion']['errores']['descripcion'])) ? 'is-invalid' : ''; ?>" id="inputDescripcion" rows="3" name="descripcion"><?php echo isset($datos['edicion']['descripcion']) ? $datos['edicion']['descripcion'] : ''; ?></textarea>
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
                      <input type="text" class="form-control <?php echo (isset($datos['edicion']['errores']['palabras'])) ? 'is-invalid' : ''; ?>" id="inputPalabrasClave" name="palabras"
                        value="<?php echo isset($datos['edicion']['palabras']) ? $datos['edicion']['palabras'] : ''; ?>" <?php echo isset($datos['edicion']['valido']) && $datos['edicion']['valido'] ? "readonly" : ''?>>
                      <div class="invalid-feedback"><?php echo $datos['edicion']['errores']['palabras']?></div>
                    </div>
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
            if(isset($datos['edicion']['valido'] ) && $datos['edicion']['valido'] )
            {
            ?>
            <input type="hidden" name="confirmado" value="<?php echo $datos['edicion']['idIncidencia']?>">
            <button type="submit" class="btn btn-primary" id="confirmSubmit">Confirmar</button>
            <?php
              }
              else
              {
            ?>
            <input type="hidden" name="editando" value="<?php echo $datos['edicion']['idIncidencia']?>">
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