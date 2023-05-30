<?php

class Request
{
    public function __construct(){}

    public function get_Dato($dato){
        if(isset($_POST[$dato]) && !empty($_POST[$dato] && $dato != 'password' && $dato != 'email' && $dato != 'telefono')){
            $dato_filtrado = htmlentities($_POST[$dato]);
            return dato_filtrado;
        }
    }

    public function get_Password(){
        if(isset($_POST['password']) && !empty($_POST['password'])){
            $dato_filtrado = password_hash($_POST['password']);
            return dato_filtrado;
        }
    }

    public function get_Email(){
        if(isset($_POST['email']) && !empty($_POST['email'])){
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $dato_filtrado = htmlentities($_POST['email']);
                return dato_filtrado;
            }
        }
    }

    public function get_Telefono(){
        if(isset($_POST['telefono']) && !empty($_POST['telefono'])){
            $dato_filtrado = htmlentities($_POST['telefono']);
            $patron = "/^[0-9]{10}$/";
            if (preg_match($patron, $telefono)) {
                return dato_filtrado;
            }
        }
    }
}
?>