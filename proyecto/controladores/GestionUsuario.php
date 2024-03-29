<?php


    class GestionUsuario extends Controlador
    {
        public function __construct() 
        {
            $this->usuarioModelo = $this->cargarModelo('Usuario');
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            $this->request = new Request();
            $this->datos = [];
            $this->logModelo = $this->cargarModelo('Logs');
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
                $this->datos['sesion']['email'] = $_SESSION['email'];
                $this->datos['sesion']['foto'] = $_SESSION['foto'];
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
                else if ($rol == null && $this->datos['sesion']['rol'] == 'admin')
                {
                    $errores['rol'] = 'Campo obligatorio';
                    $valido = false;

                }
                else if($rol == null)
                {
                    $rol = 'user';
                }
                
                $estado = $this->request->get_Dato('nuevoEstado');
                if($estado == null && isset($_POST['estadoConfirm']))
                {
                    $estado = $_POST['estadoConfirm'];
                }
                else if ($estado == null && $this->datos['sesion']['rol'] == 'admin')
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
                
                $foto = $this->request->get_Imagen('nuevoFoto');
                
                if($foto != null)
                {
                    $_SESSION['imgEdicion'] = $foto;

                }
                else if($foto == null && isset($_SESSION['imgEdicion']))
                {
                    $foto = $_SESSION['imgEdicion'];
                }
                

                if($valido && isset($_POST['confirmado']))
                {
                    $edicion['valido'] = $valido;
                    $this->datos['edicion'] = $edicion;
                    $editarUsuario;

                    if(isset($_SESSION['usuarioEditar']))
                    {
                        $columns  = [
                            'nombre' => $nombre,
                            'email' => $email, 
                            'apellidos' => $apellidos,
                            'password' => $password,
                            'telefono' => $telefono,
                            'direccion' => $direccion,
                            'foto' => $foto,
                        ];

                        if($this->datos['sesion']['rol'] == 'admin')
                        {
                            $columns['rol'] = $rol;
                            $columns['estado'] = $estado;

                        }


                        $this->usuarioModelo->actualizarUsuario($_SESSION['usuarioEditar'],$columns);
                        $descripcion = "El usuario ".$_SESSION['usuarioEditar']." ha sido editado por el administrador {$this->datos['sesion']['email']}";
                        $this->logModelo->nuevoLog($descripcion);
                        $this->datos['exito'] = "Usuario modificado con éxito";

                        if($this->datos['sesion']['email'] == $_SESSION['usuarioEditar'] && $email != $this->datos['sesion']['email'])
                        {
                            $this->datos['sesion']['email'] = $email;
                            $_SESSION['email'] = $email;
                        }

                        if($this->datos['sesion']['email'] == $_SESSION['usuarioEditar'] && $nombre != $this->datos['sesion']['nombre'])
                        {
                            $this->datos['sesion']['nombre'] = $nombre;
                            $_SESSION['nombre'] = $nombre;
                        }

                        if($this->datos['sesion']['email'] == $_SESSION['usuarioEditar'] && $rol != $this->datos['sesion']['rol'])
                        {
                            $this->datos['sesion']['rol'] = $rol;
                            $_SESSION['rol'] = $rol;
                        }
                        unset($_SESSION['usuarioEditar']);
                        
                    }
                    else
                    {
                        
                        $this->usuarioModelo->nuevoUsuario($email,$nombre,$apellidos,$password,$telefono,$direccion,$foto,$estado,$rol);
                        $descripcion = "El administrador {$this->datos['sesion']['email']} ha creado un nuevo usuario llamado $email";
                        $this->logModelo->nuevoLog($descripcion);
                        $this->datos['exito'] = "Usuario creado con éxito";
                    }
                    
                    if(isset($_SESSION['imgEdicion']))
                        unset($_SESSION['imgEdicion']);
                    
                    $this->index();



                }
                else
                {
                    

                    $edicion['nombre'] = $nombre;
                    $edicion['apellidos'] = $apellidos;
                    $edicion['email'] = $email;
                    $edicion['direccion'] = $direccion;
                    $edicion['telefono'] = $telefono;
                    $edicion['rol'] = $rol;
                    $edicion['estado'] = $estado;
                    $edicion['img'] = $foto;
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
                    $_SESSION['imgEdicion'] = $usuario['foto'];
                    $this->datos['edicion'] = $editar;

                    $this->cargarVista('gestionUsuario/edicion', $this->datos);

                }
                
            }
            
        }

        public function eliminar()
        {
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $id = $this->request->get_Email('email');
                
                if($this->usuarioModelo->existeUsuario($id) && $id != $this->datos['sesion']['email'])
                {
                    $this->usuarioModelo->eliminarUsuario($id);
                    $descripcion = "El administrador {$this->datos['sesion']['email']} ha eliminado al usuario $id";
                    $this->logModelo->nuevoLog($descripcion);
                    $this->datos['exito'] = "Usuario eliminado con éxito";
                }
                else
                {
                    $this->datos['error'] = "No se ha podido eliminar el usuario";
                }
                
                $this->index();
            }
        }
    
    }

?>