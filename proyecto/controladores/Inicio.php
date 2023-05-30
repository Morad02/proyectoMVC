<?php

    class Inicio extends Controlador
    {

        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->valoracionesModelo = $this->cargarModelo('Valoraciones');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            
        }

        public function index()
        {
            
            $datos = [];
            $datos['incidencias'] = $this->incidenciasModelo->obtenerIncidencias();
            foreach ($datos['incidencias'] as $incidencia){
                $datos['imagenes'][] = $this->fotosModelo->obtenerFotosIncidencia($incidencia['idincidencia']);
            }
            $this->cargarVista('inicio/inicio', $datos);

        }

        public function login()
        {
            $datos = [];
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['email']) && isset($_POST['password']) && $this->usuarioModelo->validarUsuario($_POST['email'],$_POST['password']))
                {
                    session_start();
                    $_SESSION['nombre'] = "Admin";
                    $_SESSION['rol'] = "Administrador";

                }

            }
            
            
            $this->cargarVista('inicio/inicio', $datos);
        }

        public function logout()
        {
            $datos = [];
            if((session_status() === PHP_SESSION_ACTIVE))
            {
                $_SESSION = array();
                session_destroy();
            }

            $this->cargarVista('inicio/inicio', $datos);
        }

        public function misIncidencias()
        {
            $datos = [];
            $this->cargarVista('inicio/inicio', $datos);
        }





    }
    

?>