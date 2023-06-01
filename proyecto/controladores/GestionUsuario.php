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
            $errores = []; 
            $edicion = [];
            $this->datos['action'] = RUTA_URL.'/gestionUsuario/agregar';
            if (isset($_POST['nuevo']))
            {
                $this->cargarVista('gestionUsuario/edicion', $this->datos);
            }
            else if($_SERVER['REQUEST_METHOD'] === 'POST')
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
                else if(isset($_SESSION['usuarioEditar']) && $email != $_SESSION['usuarioEditar'])
                {
                    
                    if($this->usuarioModelo->existeUsuario($email) != 0)
                    {
                        $errores['email'] = 'El email ya existe1';
                        $valido = false;
                    }

                }
                else if($this->usuarioModelo->existeUsuario($email) != 0 && !isset($_SESSION['usuarioEditar']))
                {
                    $errores['email'] = 'El email ya existe2';
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
                
                if($rol == null && isset($_POST['rolConfirm']))
                {
                    $rol = $_POST['rolConfirm'];
                }
                else if ($rol == null)
                {
                    $errores['rol'] = 'Campo obligatorio';
                    $valido = false;

                }
                
                $estado = $this->request->get_Dato('nuevoEstado');
                if($estado == null && isset($_POST['estadoConfirm']))
                {
                    $estado = $_POST['estadoConfirm'];
                }
                else if ($estado == null)
                {
                    $errores['estado'] = 'Campo obligatorio';
                    $valido = false;

                }
                
                                
                $nuevoClave1 = isset($_POST['nuevoClave1']) ? $_POST['nuevoClave1'] : null;
                $password = isset($_POST['nuevoClave2']) ? $_POST['nuevoClave2'] : null;
                
                if ($nuevoClave1 == null)
                {
                    $errores['clave1'] = 'Campo obligatorio';
                    $errores['clave2'] = 'Campo obligatorio';
                    $valido = false;

                }
                else if($password == null)
                {
                    $errores['clave1'] = 'Campo obligatorio';
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
                    $edicion['password'] = $password;
                    $password = $this->request->get_Password('nuevoClave1');
                }
                
                $img = $this->request->get_Imagen('nuevoFoto');
                
                if($img != null)
                {
                    setcookie('imgEdicion', $img);

                }
                else if($img == null && isset($_COOKIE['imgEdicion']))
                {
                    $img = $_COOKIE['imgEdicion'];
                }
                

                if($valido && isset($_POST['confirmado']))
                {
                    $edicion['valido'] = $valido;
                    $this->datos['edicion'] = $edicion;

                    if(isset($_SESSION['usuarioEditar']))
                    {
                        $columns  = [
                            'nombre' => $nombre,
                            'email' => $email, 
                            'apellidos' => $apellidos,
                            'password' => $password,
                            'telefono' => $telefono,
                            'direccion' => $direccion,
                            'foto' => $img,
                            'estado' => $estado,
                            'rol' => $rol
                        ];
                        $this->usuarioModelo->actualizarUsuario($_SESSION['usuarioEditar'],$columns);
                        unset($_SESSION['usuarioEditar']);
                        setcookie('imgEdicion', '', time() - 3600);
                    }
                    else
                    {
                        $this->usuarioModelo->nuevoUsuario($email,$nombre,$apellidos,$password,$telefono,$direccion,$img,$estado,$rol);
                    }
                     
                    $this->index();

                }
                else
                {
                    
                    $imgCod = $this->request->imagen_Codificada($img);

                    $edicion['nombre'] = $nombre;
                    $edicion['apellidos'] = $apellidos;
                    $edicion['email'] = $email;
                    $edicion['direccion'] = $direccion;
                    $edicion['telefono'] = $telefono;
                    $edicion['rol'] = $rol;
                    $edicion['estado'] = $estado;
                    $edicion['img'] = $imgCod;
                    $edicion['errores'] = $errores;
                    $edicion['valido'] = $valido;
                    $this->datos['edicion'] = $edicion;

                    $this->cargarVista('gestionUsuario/edicion', $this->datos);
                }
                
                
            }

            
        }


        public function editar()
        {
            $errores = []; 
            $editar = [];
            $this->datos['action'] = RUTA_URL . '/gestionUsuario/agregar';
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                if(isset($_POST['email']))
                {
                    $id = $this->request->get_Email('email');
                    $usuario = $this->usuarioModelo->obtenerUsuario($id);
                    
                    $_SESSION['usuarioEditar'] = $usuario['email'];
                    
                    $editar['nombre'] = $usuario['nombre'];
                    $editar['apellidos'] = $usuario['apellidos'];
                    $editar['email'] = $usuario['email'];
                    $editar['direccion'] = $usuario['direccion'];
                    $editar['telefono'] = $usuario['telefono'];
                    $editar['rol'] = $usuario['rol'];
                    $editar['estado'] = $usuario['estado'];
                    $editar['img'] = $usuario['foto'];
                    $editar['errores'] = $errores;
                    $editar['valido'] = false;
                    
                    $this->datos['edicion'] = $editar;

                    $this->cargarVista('gestionUsuario/edicion', $this->datos);

                }
                
            }
            
        }

        


    }
    

?>