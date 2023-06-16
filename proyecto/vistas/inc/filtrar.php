<div class="row mt-3">
    <div class="col">
        <div class="collapse" id="opcionesFiltro">
            <div class="card card-body">
                <form action="<?php echo RUTA_URL; ?>/inicio/filtrar" method="POST">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title titulosubfiltro">Ordenar por:</h4>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="ordenar" id="antiguedad" value="antiguedad" 
                                <?php echo isset($datos['filtrar']['ordenar']) && $datos['filtrar']['ordenar'] == 'antiguedad' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="antiguedad">Antigüedad (primero las más recientes)</label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="ordenar" id="positivos" value="positivos"
                                <?php echo isset($datos['filtrar']['ordenar']) && $datos['filtrar']['ordenar'] == 'positivos' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="positivos">Número de positivos (de más a menos)</label>
                            </div>
                            <div class="form-group">
                                <input class="form-check-input" type="radio" name="ordenar" id="netos" value="netos"
                                <?php echo isset($datos['filtrar']['ordenar']) && $datos['filtrar']['ordenar'] == 'netos' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="positivosnetos">Número de positivos netos (de más a menos)</label>
                            </div>
                        </div>
                        <div class="col-md-4 align-items-center g-2">
                            <h4 class="card-title titulosubfiltro">Incidencias que contengan:</h4>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="texto" placeholder="Buscar..." 
                                value="<?php echo isset($datos['filtrar']['texto']) ? $datos['filtrar']['texto'] : '' ?>">
                            </div>
                            <label for="lugar">Lugar:</label>
                             <div class="col-md-8">
                                <input type="text" class="form-control" id="lugar" name="lugar"
                                value="<?php echo isset($datos['filtrar']['lugar']) ? $datos['filtrar']['lugar'] : '' ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 pt-3">
                            <h4 class="card-title titulosubfiltro">Estado:</h4>
                            <div class="col pt-1">
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="estado[]" id="pendiente" value="pendiente"
                                    <?php echo isset($datos['filtrar']['estado']) && in_array('pendiente', $datos['filtrar']['estado']) ? 'checked' : ''?>>
                                    <label class="form-check-label" for="pendiente">Pendiente</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="estado[]" id="comprobada" value="comprobada"
                                    <?php echo isset($datos['filtrar']['estado']) && in_array('comprobada', $datos['filtrar']['estado']) ? 'checked' : ''?>>
                                    <label class="form-check-label" for="comprobada">Comprobada</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="estado[]" id="tramitada" value="tramitada"
                                    <?php echo isset($datos['filtrar']['estado']) && in_array('tramitada', $datos['filtrar']['estado']) ? 'checked' : ''?>>
                                    <label class="form-check-label" for="tramitada">Tramitada</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="estado[]" id="irresoluble" value="irresoluble"
                                    <?php echo isset($datos['filtrar']['estado']) && in_array('irresoluble', $datos['filtrar']['estado']) ? 'checked' : ''?>>
                                    <label class="form-check-label" for="irresoluble">Irresoluble</label>
                                </div>
                                <div class="form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="estado[]" id="resuelta" value="resuelta"
                                    <?php echo isset($datos['filtrar']['estado']) && in_array('resuelta', $datos['filtrar']['estado']) ? 'checked' : ''?>>
                                    <label class="form-check-label" for="resuelta">Resuelta</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(isset($datos['misIncidencias'])){
                    ?>
                            <input type="hidden" name="misIncidencias" value="true">
                    <?php    
                        }
                    ?>
                    <div class="d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary">Aplicar filtros</button>
                    </div>
                </form>
                <div class="d-flex justify-content-end">
                    <form action="<?php echo RUTA_URL; ?>/inicio/borrarFiltro" method="POST">
                        <?php
                            if(isset($datos['misIncidencias'])){
                        ?>
                                <input type="hidden" name="misIncidencias" value="true">
                        <?php    
                            }
                        ?>
                        <button class="btn btn-round" type="submit">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>