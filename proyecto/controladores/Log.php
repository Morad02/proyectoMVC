<?php

    class Log extends Controlador
    {

        public function __construct() 
        {
            $this->logModelo = $this->cargarModelo('Logs');
            $this->request = new Request();
            $this->datos = [];
            
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
            }
        }

        public function index()
        {
            $this->datos['log'] = $this->logModelo->obtenerLogs();
            
            $this->cargarVista('log/index', $this->datos);

        }
    }
?>