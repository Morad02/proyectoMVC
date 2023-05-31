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
            $this->request = new Request();
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
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password']))
            {
                $email = $this->request->getEmail('email');
                $password = $this->request->getPassword('password');
                if($this->usuarioModelo->validarUsuario($email,$password))
                {
                    $query = $this->usuarioModelo->obtenerUsuario($email);
                    session_start();
                    $_SESSION['nombre'] = $query['nombre'];
                    $_SESSION['rol'] = $query['rol'];
                    $datos['sesion']['nombre'] = $query['nombre'];
                    $datos['sesion']['rol'] = $query['rol'];
                }
                else
                {
                    echo "El usuario no existe";
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