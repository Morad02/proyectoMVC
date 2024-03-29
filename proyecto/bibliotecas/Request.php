<?php

class Request
{
    public function __construct(){}

    public function get_Dato($dato){
        if(isset($_POST[$dato]) && !empty($_POST[$dato] && $dato != 'password' && $dato != 'email' && $dato != 'telefono'
         && $dato != 'nuevoClave1' && $dato != 'nuevoClave2' && $dato != 'nuevoEmail' && $dato != 'nuevoTelefono' )){
            $dato_filtrado = htmlentities($_POST[$dato]);
            
            return $dato_filtrado;
        }
        return null;
    }

    public function get_Password($clave){
        if(isset($_POST[$clave]) && !empty($_POST[$clave])){
            $dato_filtrado = password_hash($_POST[$clave], PASSWORD_DEFAULT);
            return $dato_filtrado;
        }
        return null;
    }

    public function get_Email($email){
        if(isset($_POST[$email]) && !empty($_POST[$email])){
            if (filter_var($_POST[$email], FILTER_VALIDATE_EMAIL)){
                $dato_filtrado = htmlentities($_POST[$email]);
                return $dato_filtrado;
            }
        }
        return null;
    }

    public function get_Telefono($telefono){
        if(isset($_POST[$telefono]) && !empty($_POST[$telefono])){
            $dato_filtrado = htmlentities($_POST[$telefono]);
            $patron = "/^[0-9]{9}$/";
            if (preg_match($patron, $_POST[$telefono])) {
                return $dato_filtrado;
            }
        }
        return null;
    }

    public function get_Imagen($nombre) {
        if(isset($_FILES[$nombre]) && !empty($_FILES[$nombre]['tmp_name'])) {
            $rutaTemporal = $_FILES[$nombre]['tmp_name'];
            $contenidoImagen = file_get_contents($rutaTemporal);
            // Codificación en base64
            $imagenBase64 = base64_encode($contenidoImagen);
            return $imagenBase64;
        }
        return null;
    }
    


    public function get_imagenes($nombre) {
        $imagenesBase64 = [];
        if(isset($_FILES[$nombre])) {
            // Comprobar si se subió una sola imagen o varias
            // Normalmente, $_FILES[$nombre]['tmp_name'] siempre será un array incluso si se sube una sola imagen
            // debido al atributo "multiple" en el input del archivo.
            foreach ($_FILES[$nombre]['tmp_name'] as $rutaTemporal) {
                // Verificar si la ruta temporal no está vacía
                if(!empty($rutaTemporal)) {
                    // Leer el contenido de la imagen
                    $contenidoImagen = file_get_contents($rutaTemporal);
                    // Codificar en base64
                    $imagenBase64 = base64_encode($contenidoImagen);
                    // Agregar a la lista de imágenes
                    $imagenesBase64[] = $imagenBase64;
                }
            }
            return $imagenesBase64;
        }
        // Si $_FILES[$nombre] no está configurado, devolver nulo
        return null;
    }
    
    
    
}
?>