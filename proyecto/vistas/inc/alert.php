<div id="successDanger" class="alert alert-danger fixed-bottom mb-0 text-center" role="alert" style="display: none;">
    <?php echo $datos['error']?>    
</div> 
<div id="successAlert" class="alert alert-success fixed-bottom mb-0 text-center" role="alert" style="display: none;">
    <?php echo $datos['exito']?>    
</div>
  <?php
    if(isset($datos['error']))
    {

  ?>
  <script>
    // Mostrar el alerta de éxito
    document.getElementById('successDanger').style.display = 'block';

    // Desaparecer después de 5 segundos
    setTimeout(function() {
      document.getElementById('successDanger').style.display = 'none';
    }, 5000);
  </script>
    <?php
        }
        else if (isset($datos['exito']))
        {

    ?>
    <script>
    // Mostrar el alerta de éxito
    document.getElementById('successAlert').style.display = 'block';

    // Desaparecer después de 5 segundos
    setTimeout(function() {
      document.getElementById('successAlert').style.display = 'none';
    }, 5000);
  </script>
    <?php
        }
    ?>