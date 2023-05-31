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
            $usuarios = $this->usuarioModelo->obtenerUsuarios();
            
            //var_dump($usuarios);
            $datos = ['usuarios' => $usuarios];

            $this->cargarVista('gestionUsuario/index', $datos);
        }

        public function agregar()
        {
            $valido = true;
            $existe = false;
            $errores = []; 
            $datos = [];
            
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
                else if($this->usuarioModelo->existeUsuario($email) != 0)
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
                    
                        $this->usuarioModelo->nuevoUsuario($email,$nombre,$apellidos,$password,$telefono,$direccion,$img,$estado,$rol);
                }
                else
                {
                    $imgCod = $this->request->imagen_Codificada($img);
                    $datos = [
                        'nombre' => $nombre,   
                        'apellidos' => $apellidos,
                        'email' => $email,
                        'direccion' => $direccion,
                        'telefono' => $telefono,
                        'rol' => $rol,
                        'estado' => $estado,
                        'img' => $imgCod,
                        'errores' => $errores,
                        'valido' => $valido
                    ];

                }

                
                
                $this->cargarVista('gestionUsuario/index', $datos);
                
            }
        }

        


    }
    

?>