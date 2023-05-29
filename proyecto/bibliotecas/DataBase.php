<?php

class DataBase
{
    private static $instance;
    private static $host = DB_HOST;
    private static $database = DB_NAME, $user = DB_USER, $password = DB_PASSWORD;

    private function __construct(){}

    private static function connect()
    {
        $bbdd = mysqli_connect(self::$host,self::$user,self::$password,self::$database);

        if(!$bbdd)
            return "Error de conexión a la base de datos (".mysqli_connect_errno().") : ".mysqli_connect_error();

        mysqli_set_charset($bbdd,"utf8");

        return $bbdd;
    }

    public static function getInstance()
    {
        if(!self::$instance)
            self::$instance = self::connect();
        return self::$instance;
    }

}
?>