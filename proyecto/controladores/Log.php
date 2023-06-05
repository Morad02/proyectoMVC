<?php

    class Log extends Controlador
    {

        public function __construct() 
        {
            $this->logModelo = $this->cargarModelo('Logs');
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
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
            $this->datos['log'] = $this->logModelo->obtenerLogs();
            
            $this->cargarVista('log/index', $this->datos);

        }
    }
?>