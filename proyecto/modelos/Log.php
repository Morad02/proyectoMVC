<?php

    class Log extends Modelo 
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('log'))
                $this->createTable();
        }

        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `log`(
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `fecha` DATETIME DEFAULT NULL,
                                `descripcion` TEXT COLLATE utf8_spanish2_ci,
                                KEY(`id`));";
        }

        public function nuevoLog($descripcion)
        {
            $table = "log";
            $columns = [
                'fecha' => date('Y-m-d H:i:s'),
                'descripcion' => $descripcion
            ];        
            return $this->insert($table, $columns);
        }
    }
?>