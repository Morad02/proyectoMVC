$(document).ready(function() {
    var initialModalBodyContent = $('.modal-body').html();
    var initialModalFooterContent = $('.modal-footer').html();

    $(document).on('click', '#edit-button', function(){
        $('.modal-body').html(`
                                <div class="container mt-4">
                                    <div>
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
                                          <button type="submit" class="btn btn-primary ml-3">Modificar Estado</button>
                                        </form>
                                    </div>
                                    <div class="mt-4">
                                    <form id="datosIncidencia">
                                      <h5>Datos principales:</h5>
                                     <div class="m-3">
                                      <div class="form-group">
                                        <label for="inputTitulo">Título</label>
                                        <input type="text" class="form-control" id="inputTitulo" name="titulo" value="">
                                      </div>
                                      <div class="form-group">
                                        <label for="inputDescripcion">Descripción</label>
                                        <textarea class="form-control" id="inputDescripcion" rows="3" name="descripcion" value=""></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="inputLugar">Lugar</label>
                                        <input type="text" class="form-control" id="inputLugar" name="lugar" value="">
                                      </div>
                                      <div class="form-group">
                                        <label for="inputPalabrasClave">Palabras clave</label>
                                        <input type="text" class="form-control" id="inputPalabrasClave" name="pClaves" value="">
                                      </div>
                                      <button type="submit" class="btn btn-primary">Modificar datos</button>
                                     </div>
                                    </form>
                                  </div>
                                    <div class="mt-4">
                                    <h5>Imágenes adjuntas</h5>
                                  </div>
                                </div>
                                `);
        $('.modal-footer').html(`
                        <button class="btn btn-round" type="button" id="save-button">
                                <i class="fas fa-save"></i>
                        </button`);
        attachFormEventHandlers();
        // Delegación de eventos para el botón "Guardar"
        $(document).on('click', '#save-button', function() {
            $('.modal-body').html(initialModalBodyContent);
            $('.modal-footer').html(initialModalFooterContent);
        });
    });

    function attachFormEventHandlers() {
        $('#estadoIncidencia').on('submit', function(e) {
            e.preventDefault();

            var data = {
                estado: $("input[name='estado']:checked").val()
            };

            $.ajax({
                type: 'POST',
                url: '',
                data: data,
                success: function(response) {
                    alert('El estado ha sido actualizado');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        $('#datosIncidencia').on('submit', function(e) {
            e.preventDefault();

            var data = {
                titulo: $("#inputTitulo").val(),
                descripcion: $("#inputDescripcion").val(),
                lugar: $("#inputLugar").val(),
                palabrasClave: $("#inputPalabrasClave").val()
            };

            $.ajax({
                type: 'POST',
                url: '',
                data: data,
                success: function(response) {
                    alert('Los datos de la incidencia han sido actualizados');
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    }
    $('#mi-modal').on('hidden.bs.modal', function (e) {
        $('.modal-body').html(initialModalBodyContent);
        $('.modal-footer').html(initialModalFooterContent);
    });
});
