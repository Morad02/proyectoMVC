<?php

    class Usuario extends Modelo
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('usuario'))
                $this->createTable();
        }

        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `usuario`(
                                `email` VARCHAR(100) COLLATE utf8_spanish2_ci NOT NULL,
                                `nombre` VARCHAR(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `apellidos` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `password` CHAR(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `telefono` VARCHAR(11) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `direccion` VARCHAR(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `foto` MEDIUMBLOB,
                                `estado` CHAR(32) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `rol` VARCHAR(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                PRIMARY KEY(`email`));";
            
            $this->query($q,[],[],false);

        }

        public function nuevoUsuario($email, $nombre, $apellidos, $password, $telefono, $direccion, $foto, $estado, $rol)
        {
            $table = "usuario";
            $params = [
                'email' => $email,
                'nombre' => $nombre,
                'apellidos' => $apellidos,
                'password' => $password,
                'telefono' => $telefono,
                'direccion' => $direccion,
                'foto' => $foto,
                'estado' => $estado,
                'rol' => $rol
            ];
            
            return $this->insert($table, $params);
        }

        public function actualizarUsuario($email, $Columns)
        {
            /*  Hay que pasarle las columnas a actualizar 
                $updateColumns = [
                    'nombre' => 'Pepitp',
                    'telefono' => '0000000'
                ];
             */

            $table = "usuario";
            $conditions = [
                'email' => $email
            ];
            
            return $this->update($table, $Columns, $conditions);
        }

        public function eliminarUsuario($email)
        {
            $table = "usuario";
            $conditions = [
                'email' => $email
            ];
        
            return $this->delete($table, $conditions);
        }

        public function obtenerUsuarios()
        {
            $query = "SELECT * FROM usuario";
            $result = $this->query($query);

            return $result;
        }

        public function obtenerUsuario($email)
        {
            $select = "SELECT * FROM usuario WHERE email = ?";
            $result = $this->query($select, [$email]);
            return $result[0];
        }

        public function validarUsuario($email,$password)
        {
            $select = "SELECT password AS P FROM usuario WHERE email=? ";
            $params = [$email];
            $result = $this->query($select,$params);
            
            if( isset($result[0]) && $result[0]['P'] !== null)
            {
                $hash = $result[0]['P'];
                return password_verify($password,$hash);
            }
            else
                return false;
        }

        public function existeUsuario($email)
        {
            $select = "SELECT COUNT(*) AS C FROM usuario WHERE email=?";
            $params = [$email];
            $result = $this->query($select,$params);
        
            return ($result !== null && $result[0]['C'] > 0);
        }


    }
?>