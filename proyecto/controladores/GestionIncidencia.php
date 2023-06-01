<?php

    class GestionIncidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
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
            $this->cargarVista('nuevaIncidencia/index', $this->datos);
        }

        public function agregar()
        {
            $valido = true;
            $errores = []; 
            $edicion = [];

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $titulo = $this->request->get_Dato('titulo');
                if ($titulo == null)
                {
                    $errores['titulo'] = 'Campo obligatorio';
                    $valido = false;
                }
                    
                
                $descripcion= $this->request->get_Dato('descripcion');
                if ($descripcion == null)
                {
                    $errores['descripcion'] = 'Campo obligatorio';
                    $valido = false;
                }
                    
                
                $lugar = $this->request->get_Dato('lugar');
                if ($lugar == null)
                {
                    $errores['lugar'] = 'Campo obligatorio';
                    $valido = false;

                }
                    
                
                $palabras = $this->request->get_Dato('keywords');
                
                $img = $this->request->imagen_Codificada('imagenes');
                                
                if($valido)
                {
                    $fecha = 'NULL';
                    if(isset($_SESSION['email'])){
                        $idusuario = $_SESSION['email'];
                    }else{
                        $idusuario = "admin@admin.com";
                    }
                    $estado = "Activo";
+                   $this->incidenciasModelo->nuevaIncidencia($titulo, $fecha, $lugar, $descripcion,$palabras, $idusuario, $estado); 
                    $this->index();
                }
            }
        }

        public function editar()
        {
            //Falta por implementar
            
        }
    }
?>