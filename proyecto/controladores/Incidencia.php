<?php
    class Incidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciaModelo = $this->cargarModelo('Incidencias');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->valoracionesModelo = $this->cargarModelo('Valoraciones');
            $this->request = new Request();
            $this->datos = [];
        }

        public function getIncidencia()
        {
            if (isset($_POST['idIncidencia'])){
                $this->datos['incidencia'] = $this->incidenciaModelo->obtenerIncidencia($_POST['idIncidencia']);
                $this->datos['incidencia']['idIncidencia'] = $_POST['idIncidencia'];
                $this->datos['incidencia']['comentarios'] = $this->comentariosModelo->getComentarios($_POST['idIncidencia']);
                $this->datos['incidencia']['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($_POST['idIncidencia']);
                $this->datos['incidencia']['valoracionesPos'] = $this->valoracionesModelo->obtenerVotos($_POST['idIncidencia'],1);
                $this->datos['incidencia']['valoracionesNeg'] = $this->valoracionesModelo->obtenerVotos($_POST['idIncidencia'],-1);
                $this->cargarVista('incidencia/index', $this->datos);
            }
        }
    
    }

?>