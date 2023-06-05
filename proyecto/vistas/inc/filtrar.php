<div class="row mt-3">
    <div class="col">
        <div class="collapse" id="opcionesFiltro">
            <div class="card card-body">
                <div class="row">
                    <div class="col-md-8">
                        <h4 class="card-title titulosubfiltro">Ordenar por:</h4>
                        <div class="form-group">
                            <input class="form-check-input" type="radio" name="ordenar" id="antiguedad" value="antiguedad" checked>
                            <label class="form-check-label" for="antiguedad">Antigüedad (primero las más recientes)</label>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="radio" name="ordenar" id="positivos" value="positivos">
                            <label class="form-check-label" for="positivos">Número de positivos (de más a menos)</label>
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="radio" name="ordenar" id="positivosnetos" value="positivosnetos">
                            <label class="form-check-label" for="positivosnetos">Número de positivos netos (de más a menos)</label>
                        </div>
                    </div>
                    <div class="col-md-4 align-items-center g-2">
                        <h4 class="card-title titulosubfiltro">Incidencias que contengan:</h4>
                        <label for="lugar">Lugar:</label>
                         <div class="col-md-8">
                            <input type="text" class="form-control" id="lugar">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 pt-3">
                        <h4 class="card-title titulosubfiltro">Estado:</h4>
                        <div class="col pt-1">
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="pendiente" id="pendiente" value="pendiente">
                                <label class="form-check-label" for="pendiente">Pendiente</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="comprobada" id="comprobada" value="comprobada">
                                <label class="form-check-label" for="comprobada">Comprobada</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tramitada" id="tramitada" value="tramitada">
                                <label class="form-check-label" for="tramitada">Tramitada</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="irresoluble" id="irresoluble" value="irresoluble">
                                <label class="form-check-label" for="irresoluble">Irresoluble</label>
                            </div>
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="resuelta" id="resuelta" value="resuelta">
                                <label class="form-check-label" for="resuelta">Resuelta</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pt-5">
                        <input type="text" class="form-control" name="buscar" placeholder="Buscar...">
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
            </div>
        </div>
    </div>
</div>