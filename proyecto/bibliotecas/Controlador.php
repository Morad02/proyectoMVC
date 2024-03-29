<?php
    
    class Controlador
    {
        public $usuarioModelo;
        public $fotosModelo;
        public $incidenciasModelo;
        public $comentariosModelo;
        public $valoracionesModelo;
        public $logModelo;
        public $request;
        public $datos;

        
        public function cargarModelo($md)
        {
            require_once '../proyecto/modelos/'.$md.'.php';
            
            return new $md(); 

        }

        public function cargarControladorInicio()
        {
            require_once '../proyecto/controladores/Inicio.php';
            return new Inicio();
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