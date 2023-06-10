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
                $this->datos['sesion']['email'] = $_SESSION['email'];
            }

            $topv = $this->incidenciasModelo->top();

            if(isset($topv))
            {
                foreach($topv as $indice)
                {
                    $user = $this->usuarioModelo->obtenerUsuario($indice['idusuario']);
                    $this->datos['aniaden'][$indice['idusuario']]['nombre'] = $user['nombre'];
                    $this->datos['aniaden'][$indice['idusuario']]['apellidos'] = $user['apellidos'];
                    $this->datos['aniaden'][$indice['idusuario']]['total_incidentes'] = $indice['total_incidentes'];
                }
            }

            $topc = $this->comentariosModelo->top();

            if(isset($topc))
            {
                foreach($topc as $indice)
                {
                    $user = $this->usuarioModelo->obtenerUsuario($indice['idusuario']);
                    $this->datos['opinan'][$indice['idusuario']]['nombre'] = $user['nombre'];
                    $this->datos['opinan'][$indice['idusuario']]['apellidos'] = $user['apellidos'];
                    $this->datos['opinan'][$indice['idusuario']]['total_comentarios'] = $indice['total_comentarios'];
                }
            }
        }

        public function index()
        {
            if(isset($_SESSION['filtro']))
            {
                $ordenar = $_SESSION['filtro']['ordenar'];
                $texto = $_SESSION['filtro']['texto'];
                $lugar = $_SESSION['filtro']['lugar'];
                $estado = $_SESSION['filtro']['estado'];
                $this->datos['incidencias'] = $this->incidenciasModelo->filtrar($ordenar, $texto, $lugar, null,$estado);
                $this->datos['filtrar'] = [
                    'ordenar' => $ordenar,
                    'texto' => $texto,
                    'lugar' => $lugar,
                    'estado' => $estado
                ];
            }
            else
            {
                $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidencias();
            }

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
                if(isset($_SESSION['mfiltro']))
                {
                    $ordenar = $_SESSION['mfiltro']['ordenar'];
                    $texto = $_SESSION['mfiltro']['texto'];
                    $lugar = $_SESSION['mfiltro']['lugar'];
                    $estado = $_SESSION['mfiltro']['estado'];
                    $this->datos['incidencias'] = $this->incidenciasModelo->filtrar($ordenar, $texto, $lugar, $this->datos['sesion']['email'],$estado);
                    $this->datos['filtrar'] = [
                        'ordenar' => $ordenar,
                        'texto' => $texto,
                        'lugar' => $lugar,
                        'estado' => $estado
                    ];

                }
                else
                {
                    $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidenciasUsuario($_SESSION['email']);
                }
                if (empty($this->datos['incidencias'])) {
                    echo "No se encontraron incidencias";
                }
                foreach ($this->datos['incidencias'] as $indice => $incidencia) {
                    $this->datos['incidencias'][$indice]['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($incidencia['id']);
                }
                $this->datos['misIncidencias']=True;
            }
            $this->datos['misIncidencias'] = True;
            $this->cargarVista('inicio/inicio', $this->datos);
        }

        

        public function filtrar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $ordenar = $this->request->get_Dato('ordenar');
                $texto = $this->request->get_Dato('texto');
                $lugar = $this->request->get_Dato('lugar');
                $estado = isset($_POST['estado']) ? $_POST['estado'] : null;
                $iUsuario = isset($_POST['misIncidencias']) ? $this->datos['sesion']['email'] : null;
                if(!isset($_SESSION['filtro']) && $iUsuario == null)
                {
                    $_SESSION['filtro'] = [];
                    $_SESSION['filtro']['ordenar'] = $ordenar;
                    $_SESSION['filtro']['texto'] = $texto;
                    $_SESSION['filtro']['lugar'] = $lugar;
                    $_SESSION['filtro']['estado'] = $estado;
                }
                else if ($iUsuario == null)
                {
                    $_SESSION['filtro']['ordenar'] = $ordenar;
                    $_SESSION['filtro']['texto'] = $texto;
                    $_SESSION['filtro']['lugar'] = $lugar;
                    $_SESSION['filtro']['estado'] = $estado;
                }

                if($iUsuario != null && !isset($_SESSION['mfiltro']))
                {
                    $_SESSION['mfiltro'] = [];
                    $_SESSION['mfiltro']['ordenar'] = $ordenar;
                    $_SESSION['mfiltro']['texto'] = $texto;
                    $_SESSION['mfiltro']['lugar'] = $lugar;
                    $_SESSION['mfiltro']['estado'] = $estado;
                }
                else if($iUsuario != null)
                {
                    $_SESSION['mfiltro']['ordenar'] = $ordenar;
                    $_SESSION['mfiltro']['texto'] = $texto;
                    $_SESSION['mfiltro']['lugar'] = $lugar;
                    $_SESSION['mfiltro']['estado'] = $estado;
                }

                $this->datos['incidencias'] = $this->incidenciasModelo->filtrar($ordenar,$texto,$lugar,$iUsuario,$estado);
                
                if (empty($this->datos['incidencias'])) {
                    echo "No se encontraron incidencias";
                }
                foreach ($this->datos['incidencias'] as $indice => $incidencia) {
                    $this->datos['incidencias'][$indice]['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($incidencia['id']);
                }

                $this->datos['filtrar'] = [
                    'ordenar' => $ordenar,
                    'texto' => $texto,
                    'lugar' => $lugar,
                    'estado' => $estado
                ];
                $this->cargarVista('inicio/inicio', $this->datos);

            }
            


        }




    }
    

?>