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
    
        if(isset($_FILES[$nombre]) && is_array($_FILES[$nombre]['tmp_name'])) {
            foreach ($_FILES[$nombre]['tmp_name'] as $rutaTemporal) {
                if(!empty($rutaTemporal)) {
                    $contenidoImagen = file_get_contents($rutaTemporal);
                    // Codificación en base64
                    $imagenBase64 = base64_encode($contenidoImagen);
                    $imagenesBase64[] = $imagenBase64;
                }
            }
        }
    
        return $imagenesBase64;
    }
    
    
    
}
?>