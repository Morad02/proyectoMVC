<?php
    
    class Controlador
    {
        public $usuarioModelo;
        public $fotosModelo;
        public $incidenciasModelo;
        public $comentariosModelo;
        public $valoracionesModelo;

        public function cargarModelo($md)
        {
            require_once '../proyecto/modelos/'.$md.'.php';
            
            return new $md(); 

        }

        public function cargarVista($vs, $datos = [])
        {
            if(file_exists('../proyecto/vistas/'.$vs.'.php'))
            {
                require_once '../proyecto/vistas/'.$vs.'.php';
            }
            else
            {
                die("No existe la vista $vs");
            }
            

        }
    }

?>