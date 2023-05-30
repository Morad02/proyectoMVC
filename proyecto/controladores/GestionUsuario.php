<?php

    class GestionUsuario extends Controlador
    {
        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
        }

        public function index()
        {
            $datos = [];
            $datos['usuarios'] = $this->usuarioModelo->obtenerUsuarios();
            $this->cargarVista('gestionUsuario/index', $datos);
        }

        


    }
    

?>