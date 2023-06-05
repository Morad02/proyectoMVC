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
            $this->logModelo = $this->cargarModelo('Logs');
            $this->request = new Request();
            $this->datos = [];
            
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
            }

            $top = $this->incidenciasModelo->top();

            if(isset($top))
            {
                foreach($top as $indice)
                {
                    $user = $this->usuarioModelo->obtenerUsuario($indice['idusuario']);
                    $this->datos['aniaden'][$indice['idusuario']]['nombre'] = $user['nombre'];
                    $this->datos['aniaden'][$indice['idusuario']]['apellidos'] = $user['apellidos'];
                    $this->datos['aniaden'][$indice['idusuario']]['total_incidentes'] = $indice['total_incidentes'];
                }
            }
        }

        public function index()
        {
            $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidencias();
            if (empty($this->datos['incidencias'])) {
                echo "No se encontraron incidencias";
            }
            foreach ($this->datos['incidencias'] as $indice => $incidencia) {
                $this->datos['incidencias'][$indice]['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($incidencia['id']);
            }
            $this->cargarVista('inicio/inicio', $this->datos);

        }

        public function login()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password']))
            {
                $email = $this->request->get_Email('email');
                $password = $_POST['password'];
                if($this->usuarioModelo->validarUsuario($email,$password))
                {
                    $query = $this->usuarioModelo->obtenerUsuario($email);
                    $_SESSION['nombre'] = $query['nombre'];
                    $_SESSION['rol'] = $query['rol'];
                    $_SESSION['email'] = $query['email'];
                    $this->datos['sesion']['nombre'] = $query['nombre'];
                    $this->datos['sesion']['rol'] = $query['rol'];
                    $this->datos['sesion']['email'] = $query['email'];
                    $descripcion = "El usuario {$_SESSION['email']} ha iniciado sesión";
                    $this->logModelo->nuevoLog($descripcion);
                    $this->datos['exito'] = "Inicio de sesión exitoso";
                }
                else
                {
                    $descripcion = "Un usuario anónimo ha intentado iniciar sesión";
                    $this->logModelo->nuevoLog($descripcion);
                    $this->datos['error'] = "Usuario o contraseña incorrectos";
                }
            }
            
            $this->index();
        }

        public function logout()
        {
            
            if((session_status() === PHP_SESSION_ACTIVE))
            {
                $descripcion = "El usuario {$_SESSION['email']} ha cerrado sesión";
                $this->logModelo->nuevoLog($descripcion);
                $_SESSION = array();
                unset($this->datos['sesion']);
                session_destroy();
                $this->datos['exito'] = "Cierre de sesión exitoso";
            }

            $this->index();
        }

        public function misIncidencias()
        {
            if(isset($_SESSION['email'])){
                $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidenciasUsuario($_SESSION['email']);
                if (empty($this->datos['incidencias'])) {
                    echo "No se encontraron incidencias";
                }
                foreach ($this->datos['incidencias'] as $indice => $incidencia) {
                    $this->datos['incidencias'][$indice]['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($incidencia['id']);
                }
            }
            $this->cargarVista('inicio/inicio', $this->datos);
        }





    }
    

?>