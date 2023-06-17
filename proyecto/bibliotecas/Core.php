<?php
    /*Seguimiento de la URL
     /Controlador/Método/Parámetro
    */


    class Core {
        protected $controladorDefecto = 'Inicio';
        protected $metodoDefecto = 'index';
        protected $parametrosDefecto = [];


        public function __construct ()
        {
            $url = $this->getURL();
            
            if((session_status() !== PHP_SESSION_ACTIVE)){
                session_start();
            }
            if( isset($url[0])&& file_exists('../proyecto/controladores/' . ucfirst($url[0]) . '.php'))
            {
                //para gestionar el acceso a funcionalidades de la página dependiendo del rol del usuario
                if($url[0] != 'Incidencia' && isset($_SESSION['rol']))
                {
                    if($_SESSION['rol'] == 'admin')
                        $this->controladorDefecto = ucwords($url[0]);
                    else if($_SESSION['rol'] == 'user' && $url[0] != 'log' && $url[0] != 'gestionUsuario' && $url[0] != 'gestionBD')
                        $this->controladorDefecto = ucwords($url[0]);
                    else if($_SESSION['rol'] == 'user' && $url[0] == 'gestionUsuario' && $url[1] == 'editar' &&  //para permitir que el usuario pueda acceder 
                            isset($_POST['email']) && $_POST['email'] == $_SESSION['email'])                     // al controlador gestionUsuario en caso de editar su perfil
                        $this->controladorDefecto = ucwords($url[0]);
                    else if($_SESSION['rol'] == 'user' && $url[0] == 'gestionUsuario' && $url[1] == 'agregar' && //para permitir que el usuario pueda acceder
                            isset($_POST['nuevoEmail']) && $_POST['nuevoEmail'] == $_SESSION['email'])           // al controlador gestionUsuario para guardar los cambios de su perfil
                        $this->controladorDefecto = ucwords($url[0]);
                } 
                else if($url[0] == 'Incidencia')
                    $this->controladorDefecto = ucwords($url[0]);
                
                unset($url[0]);
            }

            require_once '../proyecto/controladores/'.$this->controladorDefecto.'.php';
            $this->controladorDefecto = new $this->controladorDefecto;

            //comprobar que las funciones existen

            if(isset($url[1]) && method_exists($this->controladorDefecto, $url[1]))
            {
                $this->metodoDefecto = $url[1];
                unset($url[1]);
            }

            //echo $this->metodoDefecto;

            //obtener parámetros

            $this->parametrosDefecto = $url ? array_values($url) : [];

            call_user_func_array([$this->controladorDefecto,$this->metodoDefecto], $this->parametrosDefecto);
        }

        public function getURL()
        {
            if(isset($_GET['url']))
            {
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);
                return $url;
            }
        }
        
    }
?>
