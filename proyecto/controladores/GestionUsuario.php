<?php


    class GestionUsuario extends Controlador
    {
        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->request = new Request();
            $this->datos = [];
            session_start();
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
            }
        }

        public function index()
        {
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            
            
            $this->datos['usuarios'] = $usuarios;
            $this->cargarVista('gestionUsuario/index', $this->datos);
        }

        public function agregar()
        {
            $valido = true;
            $existe = false;
            $errores = []; 
            $agregar = [];
            
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                

                $nombre = $this->request->get_Dato('nuevoNombre');
                if ($nombre == null)
                {
                    $errores['nombre'] = 'Campo obligatorio';
                    $valido = false;

                }
                    
                
                $apellidos= $this->request->get_Dato('nuevoApellidos');
                if ($apellidos == null)
                {
                    $errores['apellidos'] = 'Campo obligatorio';
                    $valido = false;

                }
                    
                
                $email = $this->request->get_Email('nuevoEmail');
                if ($email == null && !isset($_POST['nuevoEmail']))
                {
                    $errores['email'] = 'Campo obligatorio';
                    $valido = false;

                }
                else if($email == null && isset($_POST['nuevoEmail']))
                {
                    $errores['email'] = 'formato no válido';
                    $valido = false;

                }
                else if(!isset($_POST['guardar']) && $this->usuarioModelo->existeUsuario($email) != 0)
                {
                    $errores['email'] = 'El email ya existe';
                    $valido = false;

                }
                    
                
                $direccion = $this->request->get_Dato('nuevoDireccion');
                if ($direccion == null)
                {
                    $errores['direccion'] = 'Campo obligatorio';
                    $valido = false;

                }
                    
                $telefono = $this->request->get_Telefono('nuevoTelefono');
                if ($telefono == null && !isset($_POST['nuevoTelefono']))
                {
                    $errores['telefono'] = 'Campo obligatorio';
                    $valido = false;

                }
                    
                else if($telefono == null &&isset($_POST['nuevoTelefono']))
                {
                    $errores['telefono'] = 'Teléfono inválido';
                    $valido = false;

                }
                    
                
                $rol = $this->request->get_Dato('nuevoRol');
                if ($rol == null)
                {
                    $errores['rol'] = 'Campo obligatorio';
                    $valido = false;

                }
                
                $estado = $this->request->get_Dato('nuevoEstado');
                if ($estado == null)
                {
                    $errores['estado'] = 'Campo obligatorio';
                    $valido = false;

                }
                                
                $nuevoClave1 = $_POST['nuevoClave1'];
                $password = $_POST['nuevoClave2'];
                if ($nuevoClave1 == null)
                {
                    $errores['clave1'] = 'Campo obligatorio';
                    $valido = false;

                }
                else if($password == null)
                {
                    $errores['clave2'] = 'Campo obligatorio';
                    $valido = false;

                }
                else if($nuevoClave1 != $password)
                {
                    $errores['clave1'] = 'Las contraseñas no coinciden';
                    $errores['clave2'] = 'Las contraseñas no coinciden';
                    $valido = false;

                }
                 else
                {
                     $password = $this->request->get_Password('nuevoClave1');
                }
                
                $img = $this->request->get_Imagen('nuevoFoto');
                    
                if($valido)
                {
                    if(isset($_POST['guardar']))
                    {
                        $columns = [
                            'nombre' => $nombre,
                            'email' => $email,
                            'Apellidos' => $apellidos,
                            'password' => $password,
                            'direccion' => $direccion,
                            'telefono' => $telefono,
                            'rol' => $rol,
                            'estado' => $estado
                        ];
                        $this->usuarioModelo->actualizarUsuario($_SESSION['emailEditar'],$columns);

                    }
                    else
                    {
                        $this->usuarioModelo->nuevoUsuario($email,$nombre,$apellidos,$password,$telefono,$direccion,$img,$estado,$rol);

                    }
                     
                    //$this->index();
                }
                else
                {
                    if(isset($_POST['guardar']))
                    {
                        echo "Estoy para guardar el usuario y no todo ha ido bien";
                        $agregar['editar'] = true;

                    }
                    $imgCod = $this->request->imagen_Codificada($img);

                    $agregar['nombre'] = $nombre;
                    $agregar['apellidos'] = $apellidos;
                    $agregar['email'] = $email;
                    $agregar['direccion'] = $direccion;
                    $agregar['telefono'] = $telefono;
                    $agregar['rol'] = $rol;
                    $agregar['estado'] = $estado;
                    $agregar['img'] = $imgCod;
                    $agregar['errores'] = $errores;
                    $agregar['valido'] = $valido;
                    $this->datos['agregar'] = $agregar;
                
                }
                
                
                $this->index();
                
                
            }
        }


        public function editar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $errores = []; 
                $editar = [];
                $id = $this->request->get_Email('email');
                $_SESSION['emailEditar'] = $id;
                $usuario = $this->usuarioModelo->obtenerUsuario($id);
                
                var_dump($usuario);
                $editar['nombre'] = $usuario['nombre'];
                $editar['apellidos'] = $usuario['apellidos'];
                $editar['email'] = $usuario['email'];
                $editar['direccion'] = $usuario['direccion'];
                $editar['telefono'] = $usuario['telefono'];
                $editar['rol'] = $usuario['rol'];
                $editar['estado'] = $usuario['estado'];
                $editar['img'] = $usuario['foto'];
                $editar['errores'] = $errores;
                $editar['editar'] = true;
                $this->datos['agregar'] = $editar;
            }
            
            $this->index();
        }

        


    }
    

?>