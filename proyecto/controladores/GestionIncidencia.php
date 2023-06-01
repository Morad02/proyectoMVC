<?php

    class GestionIncidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->request = new Request();
            $this->datos = [];
            
            $this->incidenciasModelo->nuevaIncidencia('Incidencia1', '13/10/2023', 'Granada', 'Descripcion', 'keywords', 'admin@admin.com', 'Activa');
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