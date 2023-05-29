<?php require_once RUTA_PROYECTO.'/vistas/inc/header.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/navBar.php'?>
<div class="row">
    <div class="col-md-9">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/filtrar.php'?>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Producto 1</h5>
                        <p class="card-text">Descripción del producto 1.</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mi-modal">Ver más detalle</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Producto 1</h5>
                        <p class="card-text">Descripción del producto 1.</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mi-modal">Ver más detalle</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Producto 1</h5>
                        <p class="card-text">Descripción del producto 1.</p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mi-modal">Ver más detalle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <?php require_once RUTA_PROYECTO.'/vistas/inc/sesion.php'?>
        <?php require_once RUTA_PROYECTO.'/vistas/inc/adicional.php'?>
    </div> 
</div>
<?php require_once RUTA_PROYECTO.'/vistas/inc/incidencia.php'?>
<?php require_once RUTA_PROYECTO.'/vistas/inc/footer.php'?>