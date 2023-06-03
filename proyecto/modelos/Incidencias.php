<?php

    class Incidencias extends Modelo 
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('incidencias'))
                $this->createTable();
        }


        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `incidencias`(
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `titulo` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `fecha` DATETIME DEFAULT NULL,
                                `lugar` VARCHAR(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `descripcion` TEXT COLLATE utf8_spanish2_ci,
                                `keywords` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `idusuario` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `estado`VARCHAR(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                PRIMARY KEY(`id`),
                                KEY `fk_incidencias_1_idx`(`idusuario`),
                                CONSTRAINT `fk_incidencias_1` FOREIGN KEY(`idusuario`) REFERENCES `usuario` (`email`) ON DELETE CASCADE ON UPDATE CASCADE);";
            $this->query($q);
        }

        public function nuevaIncidencia($titulo,$lugar, $descripcion,$keywords, $idusuario, $estado)
        {
            $fecha = date('Y-m-d H:i:s');
            $table = "incidencias";
            $columns = [
                'titulo' => $titulo,
                'fecha' => $fecha,
                'lugar' => $lugar,
                'descripcion' => $descripcion,
                'keywords' => $keywords,
                'idusuario' => $idusuario,
                'estado' => $estado
            ];        
            return $this->insert($table, $columns);
        }

        public function actualizarIncidencia($id, $columns)
        {
            $table = "incidencias";
            $conditions = [
                'id' => $id
            ];
        
            return $this->update($table, $columns, $conditions);
        }

        public function eliminarIncidencia($id)
        {
            $table = "incidencias";
            $conditions = [
                'id' => $id
            ];
        
            return $this->delete($table, $conditions);
        }

        public function obtenerIncidencias()
        {
            $select = "SELECT * FROM incidencias";
        
            return $this->query($select);
        }

        public function obtenerIncidencia($id)
        {
            $select = "SELECT * FROM incidencias WHERE id = ?";
        
            return $this->query($select, [$id]);
        }


    }
?>