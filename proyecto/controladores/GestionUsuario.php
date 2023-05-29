<?php

    class GestionUsuario extends Controlador
    {
        public function __construct() 
        {
            
        }

        public function index()
        {
            $datos = [];
            $this->cargarVista('gestionUsuario/index', $datos);

        }

        


    }
    

?>