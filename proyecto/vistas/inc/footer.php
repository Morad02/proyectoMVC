        <div class="card-footer text-muted">
                2 days ago
        </div>
        <!--scripts-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="<?php echo RUTA_URL?>/bootstrap/bootstrap.bundle.min.js"></script>
        <script src="<?php echo RUTA_URL?>/js/nuevoUsuario.js"></script>
        <script src="<?php echo RUTA_URL?>/js/scripts.js"></script>
        <script src="<?php echo RUTA_URL?>/js/nuevoUsuario.js"></script>
        <?php
                if (isset($datos['agregar']['valido']) && !$datos['agregar']['valido']) {
                    echo "<script>
                            $(document).ready(function() {
                              $('#nuevoModal').modal('show');
                            });
                          </script>";
                }
        ?>
        <?php
                if (isset($datos['agregar']['editar']) && $datos['agregar']['editar']) {
                    echo "<script>
                            $(document).ready(function() {
                              $('#nuevoModal').modal('show');
                            });
                          </script>";
                }
        ?>
    </body>
</html>