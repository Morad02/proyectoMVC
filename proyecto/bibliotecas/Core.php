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
            
            session_start();

            
            if( isset($url[0])&& file_exists('../proyecto/controladores/' . ucfirst($url[0]) . '.php'))
            {
                if($url[0] != 'Incidencia' && isset($_SESSION['rol']))
                {
                    if($_SESSION['rol'] == 'admin')
                        $this->controladorDefecto = ucwords($url[0]);
                    else if($_SESSION['rol'] == 'user' && $url[0] == 'gestionIncidencia')
                        $this->controladorDefecto = ucwords($url[0]);
                } 
                else if($url[0] == 'Incidencia')
                    $this->controladorDefecto = ucwords($url[0]);
                
                unset($url[0]);
            }

            //var_dump($url);
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

            //llamar al método

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
