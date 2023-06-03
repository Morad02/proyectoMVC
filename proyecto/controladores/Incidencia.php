<?php
    class Incidencia extends Controlador
    {
        public function __construct() 
        {
            $this->IncidenciaModelo = $this->cargarModelo('Incidencias');
            $this->ComentariosModelo = $this->cargarModelo('Comentarios');
            $this->FotosModelo = $this->cargarModelo('Fotos');
            $this->request = new Request();
            $this->datos = [];
        }

        public function getIncidencia()
        {
            if (isset($_POST['idIncidencia'])){
                $this->datos['incidencia'] = $this->IncidenciaModelo->obtenerIncidencia($_POST['idIncidencia']);
                $this->datos['incidencia']['comentarios'] = $this->ComentariosModelo->getComentarios($_POST['idIncidencia']);
                //$this->datos['fotos'] = $this->FotosModelo->getFotos($_POST['idIncidencia']);
                $this->cargarVista('incidencia/index', $this->datos);
            }
        }
    
    }

?>