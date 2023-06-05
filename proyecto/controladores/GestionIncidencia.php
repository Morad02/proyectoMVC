<?php

    class GestionIncidencia extends Controlador
    {
        public function __construct() 
        {
            $this->incidenciasModelo = $this->cargarModelo('Incidencias');
            $this->comentariosModelo = $this->cargarModelo('Comentarios');
            $this->valoracionesModelo = $this->cargarModelo('Valoraciones');
            $this->fotosModelo = $this->cargarModelo('Fotos');
            $this->request = new Request();
            $this->datos = [];
            
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
                    if(isset($_SESSION['imagenesEdicion']))
                        unset($_SESSION['imagenesEdicion']);
                    
                    $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidencias();
                    $this->cargarVista('inicio/inicio', $this->datos);
                }
                else
                {
                    $agregar = [
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'lugar' => $lugar,
                        'palabras' => $palabras,
                        'errores' => $errores,
                        'imagenes' => $imagenes,
                        'valido' => $valido
                    ];

                    $this->datos['agregar'] = $agregar;
                    $this->cargarVista('nuevaIncidencia/index', $this->datos);
                }
            }
            
        }

        public function editar()
        {
            $valido = true;
            $errores = []; 
            
            if(isset($_POST['editar']) || isset($_SESSION['editando']))
            {
                $valido = FALSE;
                if(isset($_POST['editar']))
                    $id = $this->request->get_Dato('editar');
                else
                {
                    $id = $_SESSION['editando'];
                    unset($_SESSION['editando']);

                }
                    
                $incidencia = $this->incidenciasModelo->obtenerIncidencia($id);
                $this->datos['edicion'] = $incidencia;
                $this->datos['edicion']['valido'] = $valido;
                $this->datos['edicion']['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($id);
                $this->datos['edicion']['idIncidencia'] = $id;
                $this->cargarVista('editarIncidencia/index', $this->datos);
            }
            else if (isset($_POST['editando']))
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

                $keywords = $this->request->get_Dato('keywords');
                if ($keywords == null)
                {
                    $errores['keywords'] = 'Campo obligatorio';
                    $valido = false;
                }

                $estado = $this->request->get_Dato('estado');
                $estado2 = $this->request->get_Dato('estado2');
                if ($estado == null && $estado2 != null)
                {
                    $estado = $estado2;
                }
                else if($estado == null && $estado2 == null)
                {
                    $errores['estado'] = 'Campo obligatorio';
                    $valido = false;
                }


                if($valido && isset($_POST['confirmado']))
                {
                    $id = $this->request->get_Dato('confirmado');

                    $columns = [
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'lugar' => $lugar,
                        'keywords' => $keywords,
                        'estado' => $estado
                    ]; 

                    $this->incidenciasModelo->actualizarIncidencia($id, $columns);
                    
                    $this->datos['incidencia'] = $this->incidenciasModelo->obtenerIncidencia($id);
                    $this->datos['incidencia']['comentarios'] = $this->comentariosModelo->getComentarios($id);
                    $this->datos['incidencia']['imagenes'] = $this->fotosModelo->obtenerFotosIncidencia($id);
                    $this->datos['incidencia']['valoracionesPos'] = $this->valoracionesModelo->obtenerVotos($id,1);
                    $this->datos['incidencia']['valoracionesNeg'] = $this->valoracionesModelo->obtenerVotos($id,-1);
                    
                    $this->cargarVista('incidencia/index', $this->datos);

                }
                else{
                    $id = $this->request->get_Dato('editando');
                    $imagenes = $this->fotosModelo->obtenerFotosIncidencia($id);
                    $edicion = [
                        'idIncidencia' => $id,
                        'titulo' => $titulo,
                        'descripcion' => $descripcion,
                        'lugar' => $lugar,
                        'keywords' => $keywords,
                        'estado' => $estado,
                        'errores' => $errores,
                        'valido' => $valido,
                        'imagenes' => $imagenes
                    ];

                    

                    $this->datos['edicion'] = $edicion;

                    $this->cargarVista('editarIncidencia/index', $this->datos); 
                }

            }            


        }

        public function eliminarIncidencia()
        {
            if(isset($_POST['idIncidencia'])){
                $this->incidenciasModelo->eliminarIncidencia($_POST['idIncidencia']);
                $this->datos['incidencias'] = $this->incidenciasModelo->obtenerIncidencias();
                $this->cargarVista('inicio/inicio', $this->datos);
            }
        }

        public function eliminarFoto()
        {
            if(isset($_POST['borrarImagen']) && isset($_POST['idIncidencia']))
            {
                $this->fotosModelo->eliminarFoto($_POST['borrarImagen']);
                $_SESSION['editando'] = $_POST['idIncidencia'];
                $this->editar();
            }
        }

        public function subirFotos()
        {
            if(isset($_POST['subir']))
            {
                $id = $this->request->get_Dato('subir');

                $imagenes = $this->request->get_imagenes('imagenes');

                if($imagenes != null)
                {
                    foreach($imagenes as $imagen)
                    {
                       
                        $this->fotosModelo->insertarFoto($imagen, $id);

                    }
                }

                $_SESSION['editando'] = $id;
                $this->editar();
            }
        }
    }
?>