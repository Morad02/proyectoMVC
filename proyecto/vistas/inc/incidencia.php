<div class="modal" id="mi-modal">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Incidencia</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-9">
                            <div id="incidencia">
                                <h2><?php echo $datos['incidencia']['titulo']?></h2>
                                <ul class="list-unstyled">
                                    <li class="d-inline">Lugar:<?php echo $datos['incidencia']['lugar']?></li>
                                    <li class="d-inline">Fecha:<?php echo $datos['incidencia']['fecha']?></li>
                                    <li class="d-inline">Creado por:<?php echo $datos['incidencia']['usuario']?></li>
                                </ul>
                                <ul class="list-unstyled">
                                    <li class="d-inline">Palabras clave:<?php echo $datos['incidencia']['titulo']?></li>
                                    <li class="d-inline">Estado:<?php echo $datos['incidencia']['estado']?></li>
                                    <li class="d-inline">Valoraciones:</li>
                                </ul>
                                <p class="w-100">"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and
                                    I will give you a complete account of the system, and expound the actual teachings of the great explorer of
                                    the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself,
                                    because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter
                                    consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain
                                    pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can
                                    procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical
                                    exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses
                                    to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant
                                    pleasure?</p>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9Bhikh1PD4-vSH8nE4ScdnuBCw3DRyOpg90hU98rPFgue2BzgYcJvoIAbwveioIDIws0&usqp=CAU" alt="Imagen 1" class="img-fluid">
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSjMk4aZQSEMidEG9Ymq1GScdG762GVFdc6pw&usqp=CAU" alt="Imagen 2" class="img-fluid">
                                        </div>
                                        <div class="col-md-4">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7EqB2Kp6EX4N_Q6knJLt3u_NjWRR2JHxXxA&usqp=CAU" alt="Imagen 3" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Nombre y fecha</th>
                                            <th>Comentario</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>John Doe<br>Mayo 17, 2023</td>
                                            <td>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
                                        </tr>
                                        <tr>
                                            <td>Jane Smith<br>Mayo 16, 2023</td>
                                            <td>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div id="nuevo-comentario-container">
                                    <div id="nuevo-comentario" class="collapse">
                                        <textarea class="form-control" placeholder="Escribe tu comentario..."></textarea>
                                        <button class="btn btn-primary mt-2" type="button">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-container">
                    <button class="btn btn-round" type="button">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button class="btn btn-round" type="button">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="btn btn-round" type="button" data-toggle="collapse" data-target="#nuevo-comentario">
                        <i class="fas fa-comment"></i>
                    </button>
                    <button class="btn btn-round" type="button" id="edit-button">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-round" type="button">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>