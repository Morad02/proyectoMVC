<?php

    class GestionIncidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->request = new Request();
            $this->datos = [];
            
            session_start();
            if((isset($_SESSION['nombre'])) && (isset($_SESSION['rol'])))
            {
                $this->datos['sesion']['nombre'] = $_SESSION['nombre'];
                $this->datos['sesion']['rol'] = $_SESSION['rol'];
                $this->datos['sesion']['email'] = $_SESSION['email'];
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
                if ($palabras == null)
                {
                    $errores['palabras'] = 'Campo obligatorio';
                    $valido = false;
                }

                $imagenes = $this->request->get_imagenes('imagenes');

                if($imagenes != null)
                {
                    $_SESSION['imagenesEdicion'] = $imagenes;
                }
                else if($imagenes == null && isset($_SESSION['imagenesEdicion']))
                {
                    $imagenes = $_SESSION['imagenesEdicion'];
                }
                
                
                                
                if($valido && isset($_POST['confirmado']))
                {
                    
                
                    $idusuario = $this->datos['sesion']['email'];
                    $estado = "Pendiente";
                    $this->incidenciasModelo->nuevaIncidencia($titulo, $lugar, $descripcion,$palabras, $idusuario, $estado);
                    $id = $this->incidenciasModelo->lastId();
                    
                    foreach($imagenes as $imagen)
                    {
                        $this->fotosModelo->insertarFoto($imagen, $id);

                    }
                    $this->index();
                }
                else
                {
                    $agregar = [
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'lugar' => $lugar,
                        'palabras' => $palabras,
                        'errores' => $errores,
                        'valido' => $valido
                    ];

                    $this->datos['agregar'] = $agregar;

                    $this->cargarVista('nuevaIncidencia/index', $this->datos);
                }
            }
            
        }

        public function editar()
        {
            //Falta por implementar
            
        }
    }
?>