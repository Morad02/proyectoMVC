<?php
    class Incidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciaModelo = $this->cargarModelo('Incidencias');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->valoracionesModelo = $this->cargarModelo('Valoraciones');
            $this->logModelo = $this->cargarModelo('Logs');
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->request = new Request();
            $this->datos = [];
            
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
                $this->datos['sesion']['email'] = $_SESSION['email'];
            }

            $topv = $this->incidenciaModelo->top();

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

        public function getIncidencia()
        {
            if (isset($_POST['idIncidencia'])){
                $this->datos['incidencia'] = $this->incidenciaModelo->obtenerIncidencia($_POST['idIncidencia']);
                $this->datos['incidencia']['comentarios'] = $this->comentariosModelo->getComentarios($_POST['idIncidencia']);
                $this->datos['incidencia']['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($_POST['idIncidencia']);
                $this->datos['incidencia']['valoracionesPos'] = $this->valoracionesModelo->obtenerVotos($_POST['idIncidencia'],1);
                $this->datos['incidencia']['valoracionesNeg'] = $this->valoracionesModelo->obtenerVotos($_POST['idIncidencia'],-1);
                $this->cargarVista('incidencia/index', $this->datos);
            }
        }

        public function votar()
        {
            if (isset($_POST['idIncidencia']) && isset($_POST['voto'])) {
                if (!isset($this->datos['sesion']['email'])) {

                    $idIncidenciasVotadas = isset($_COOKIE['idIncidencias']) ? unserialize($_COOKIE['idIncidencias']) : array();

                    if (!in_array($_POST['idIncidencia'], $idIncidenciasVotadas)) {                
                        $idUsuario = "visitante@visitante.com";
                        $idIncidenciasVotadas[] = $_POST['idIncidencia'];
                        setcookie('idIncidencias', serialize($idIncidenciasVotadas), time() + (3600 * 24 * 365));

                        $this->valoracionesModelo->votar($idUsuario, $_POST['idIncidencia'], $_POST['voto']);
                        $descripcion = "El usuario $idUsuario ha añadido una valoración";
                        $this->logModelo->nuevoLog($descripcion);
                        $this->datos['exito'] = "Valoración realizada con éxito";

                    } else {
                        $this->datos['error'] = "Valoración ya realizada";
                    }
                } else {
                    $idUsuario = $this->datos['sesion']['email'];

                    if (!$this->valoracionesModelo->haVotado($idUsuario, $_POST['idIncidencia'])) {
                        $this->valoracionesModelo->votar($idUsuario, $_POST['idIncidencia'], $_POST['voto']);
                        $descripcion = "El usuario $idUsuario ha añadido una valoración";
                        $this->logModelo->nuevoLog($descripcion);
                        $this->datos['exito'] = "Valoración realizada con éxito";
                    } else {
                        $this->datos['error'] = "Valoración ya realizada";
                    }
                }
                $this->getIncidencia();
            }
        }


        public function comentar()
        {
            if (isset($_POST['idIncidencia']) && isset($_POST['comentario'])) {
                if (!isset($this->datos['sesion']['email'])) {
                    $idUsuario = "visitante@visitante.com";
                } else {
                    $idUsuario = $this->datos['sesion']['email'];
                }
                $comentario = $this->request->get_Dato('comentario');
                $this->comentariosModelo->comentar($idUsuario, $_POST['idIncidencia'], $comentario);
                $descripcion = "El usuario $idUsuario ha comentado";
                $this->logModelo->nuevoLog($descripcion);
                $this->datos['exito'] = "Comentario realizado con éxito";
                $this->getIncidencia();
            }
            else {
                $this->datos['error'] = "No se ha podido realizar el comentario";
                $this->getIncidencia();
            }
        }

        public function eliminarComentario()
        {
            if (isset($_POST['idIncidencia']) && isset($_POST['idComentario'])) {
                $this->comentariosModelo->eliminarComentarios($_POST['idIncidencia'], $_POST['idComentario']);
                $descripcion = "El usuario {$this->datos['sesion']['email']} ha eliminado un comentario";
                $this->logModelo->nuevoLog($descripcion);
                $this->datos['exito'] = "Comentario eliminado con éxito";
                $this->getIncidencia();
            }
            else {
                $this->datos['error'] = "No se ha podido eliminar el comentario";
                $this->getIncidencia();
            }
        }
    
    }

?>