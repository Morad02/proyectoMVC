<?php

    class Log extends Controlador
    {

        public function __construct() 
        {
            $this->logModelo = $this->cargarModelo('Logs');
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            $this->request = new Request();
            $this->datos = [];
            
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
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
            $this->datos['log'] = $this->logModelo->obtenerLogs();
            
            $this->cargarVista('log/index', $this->datos);

        }
    }
?>