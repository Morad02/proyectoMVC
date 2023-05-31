<?php

    class NuevaIncidencia extends Controlador
    {
        public function __construct() 
        {
            $this->datos = [];
            
            session_start();
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
            }
            
        }

        public function index()
        {
            $this->cargarVista('nuevaIncidencia/index', $this->datos);

        }
    }
    

?>