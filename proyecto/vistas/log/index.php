<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-9 p-5">
      <h5>Eventos del sistema</h5>
      <table class="table table-borderless">
        <colgroup>
          <col style="width:200px;">
          <col>
        </colgroup>
        <tbody>
          <?php
            if(isset($datos['log']))
            {
              foreach($datos['log'] as $log)
              {
          ?>
        <tr>
          <td><?php echo $log['fecha']?></td>
          <td><?php echo $log['descripcion']?></td>
        </tr>
          <?php
              }
            }
          ?>
        </tbody>
      </table>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>