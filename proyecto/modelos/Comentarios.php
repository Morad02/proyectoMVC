<?php

    class Comentarios extends Modelo
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('comentarios'))
                $this->createTable();
            
        }

        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `comentarios`(
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `idusuario` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                                `idincidencia` INT(11) NOT NULL,
                                `comentario` TEXT COLLATE utf8_spanish2_ci,
                                `fecha` DATETIME DEFAULT NULL,
                                PRIMARY KEY(`id`),
                                KEY `fk_comentarios_1_idx`(`idusuario`),
                                KEY `fk_comentarios_2_idx`(`idincidencia`),
                                CONSTRAINT `tk_comentarios_1` FOREIGN KEY(`idusuario`) REFERENCES `usuario`(`email`) ON DELETE CASCADE ON UPDATE CASCADE,
                                CONSTRAINT `tk_comentarios_2` FOREIGN KEY(`idincidencia`) REFERENCES `incidencias`(`id`) ON DELETE CASCADE ON UPDATE CASCADE);";
            $this->query($q,[],[],false);
        }

        public function comentar($idusuario, $idincidencia, $comentario)
        {
            $table = "comentarios";
            $params = [
                'idusuario' => $idusuario,
                'idincidencia' => $idincidencia,
                'comentario' => $comentario,
                'fecha' => date('Y-m-d H:i:s')
            ];
            return $this->insert($table, $params);

        }

        public function getComentarios($idIncidencia)
        {
            $select = "SELECT * FROM comentarios WHERE idincidencia = ?";
            $result = $this->query($select, [$idIncidencia]);
            return $result;
        }

        public function eliminarComentarios($idIncidencia, $idComentario)
        {
            $delete = "DELETE FROM comentarios WHERE idincidencia = ? AND id = ?";
            $this->query($delete, [$idIncidencia, $idComentario]);
        }

        public function top()
        {
            $select = "SELECT idusuario COUNT(*) AS numComentarios FROM comentarios GROUP BY idusuario ORDER BY numComentarios DESC LIMIT 3";
            $result = $this->query($select);
            return $result;
        }

    }
?>