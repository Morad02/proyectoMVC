<?php

    class Inicio extends Controlador
    {

        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->valoracionesModelo = $this->cargarModelo('Valoraciones');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            
        }

        public function index()
        {
            
            $datos = [];
            $this->cargarVista('inicio/inicio', $datos);

        }

        public function misIncidencias()
        {
            $datos = [];
            $this->cargarVista('inicio/inicio', $datos);

        }





    }
    

?>