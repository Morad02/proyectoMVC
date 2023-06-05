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
        <tr>
          <td>2023-05-24 12:34:56</td>
          <td>Usuario registrado exitosamente</td>
        </tr>
        <tr>
          <td>2023-05-24 12:37:22</td>
          <td>Error al iniciar la aplicación</td>
        </tr>
        <tr>
          <td>2023-05-24 12:40:45</td>
          <td>Actualización del sistema completada</td>
        </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div>
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>