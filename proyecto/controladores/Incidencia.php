<?php
    class Incidencia extends Controlador
    {
        public function __construct() 
        {
            $this->IncidenciaModelo = $this->cargarModelo('Incidencias');
            $this->request = new Request();
            $this->datos = [];
        }

        public function getIncidencia()
        {
            if (isset($_POST['idIncidencia'])){
                $this->datos['incidencia'] = $this->IncidenciaModelo->obtenerIncidencia($_POST['idIncidencia']);
                $this->cargarVista('incidencia/index', $this->datos);
            }
        }
    
    }

?>