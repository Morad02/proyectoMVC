<div class="row justify-content-center">
    <div class="col-md-6">
        <form class="form-inline d-flex justify-content-center align-items-center">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                    <button class="btn btn-primary ml-2" type="button" data-toggle="collapse" data-target="#opcionesFiltro">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
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
                    <div class="col-md-4">
                        <h4 class="card-title titulosubfiltro">Incidencias que contengan:</h4>
                        <div class="form-group form-item-filtro">
                            <div class="row align-items-center g-2">
                                <div class="col-md-2">
                                    <label for="lugar">Lugar:</label>
                                </div>
                                <div class="col-md-8 offset-md-1">
                                    <input type="text" class="form-control" id="lugar">
                                </div>
                            </div>
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
                    <div class="col-md-4 pt-3 align-items-center g-2">
                        <label for="n_incidencias" class="negrita">Incidencias por página:</label>
                        <div class="col-md-8">
                            <select class="form-control" id="n_incidencias">
                                <option value="tres">3 ítems</option>
                                <option value="seis">6 ítems</option>
                                <option value="nueve">9 ítems</option>
                                <option value="doce">12 ítems</option>
                                <option value="quince">15 ítems</option>
                                <option value="dieciocho">18 ítems</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">Aplicar filtros</button>
                </div>
            </div>
        </div>
    </div>
</div>