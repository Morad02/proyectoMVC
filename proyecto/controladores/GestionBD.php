<?php
class GestionBD extends Controlador
{
    public function __construct() 
    {
        $this->incidenciasModelo = $this->cargarModelo('Incidencias');
        $this->usuarioModelo = $this->cargarModelo('Usuario');
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
        
        $this->cargarVista('bd/index', $this->datos);

    }

    public function backup()
    {
        $archivo_backup = $this->logModelo->DB_backup();

        if(file_exists($archivo_backup))
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($archivo_backup).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($archivo_backup));

            ob_clean();
            flush();

            readfile($archivo_backup);

            unlink($archivo_backup);

        }
        
        $this->cargarVista('bd/index', $this->datos);
    }
}
?>