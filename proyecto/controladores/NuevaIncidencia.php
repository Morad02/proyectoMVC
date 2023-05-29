<?php

    class NuevaIncidencia extends Controlador
    {
        public function __construct() 
        {
            
        }

        public function index()
        {
            $datos = [];
            $this->cargarVista('nuevaIncidencia/index', $datos);

        }
    }
    

?>