<?php


    class GestionUsuario extends Controlador
    {
        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->request = new Request();
        }

        public function index()
        {
            $datos = [];
            $datos['usuarios'] = $this->usuarioModelo->obtenerUsuarios();
            $this->cargarVista('gestionUsuario/index', $datos);
        }

        public function agregar()
        {
            echo "Estoy en agregar";
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                echo "Estoy en el post";
                $nombre = $this->request->get_Dato('nuevoNombre');
                $apellidos= $this->request->get_Dato('nuevoApellidos');
                $email = $this->request->get_Email('nuevoEmail');
                $direccion = $this->request->get_Dato('nuevoDireccion');
                $telefono = $this->request->get_Telefono('nuevoTelefono');
                $rol = $this->request->get_Dato('nuevoRol');
                $estado = $this->request->get_Dato('nuevoEstado');
                $img = $this->request->get_Imagen($_FILES,'nuevoFoto');

                $password = $this->request->get_Password('nuevoClave1');
                
                //echo $_POST['nuevoTelefono'];
                echo $telefono;
                $this->usuarioModelo->nuevoUsuario($email,$nombre,$apellidos,$password,$telefono,$direccion,$img,$estado,$rol);
                
                $this->
            }
        }

        


    }
    

?>