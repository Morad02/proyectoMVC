<?php
    class Valoraciones extends Modelo
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('valoraciones'))
            {
                $this->createTable();

            }
                
            
        }

        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `valoraciones`(
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `idusuario` VARCHAR(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
                `idincidencia` INT(11) NOT NULL,
                `valoraciones` TINYINT(1) DEFAULT NULL,
                PRIMARY KEY(`id`),
                KEY `tk_valoraciones_1_idx`(`idusuario`),
                KEY `tk_valoraciones_2_idx`(`idincidencia`),
                CONSTRAINT `fk_valoraciones_1` FOREIGN KEY(`idusuario`) REFERENCES `usuario`(`email`) ON DELETE CASCADE ON UPDATE CASCADE,
                CONSTRAINT `fk_valoraciones_2` FOREIGN KEY(`idincidencia`) REFERENCES `incidencias`(`id`) ON DELETE CASCADE ON UPDATE CASCADE);";
            
            $this->query($q,[],[],false);
        }

        public function votar($idUsuario, $idIncidencia, $valoracion)
        {
            $table = "valoraciones";
            $params = [
                'idusuario' => $idUsuario,
                'idincidencia' => $idIncidencia,
                'valoraciones' => $valoracion
            ];
            return $this->insert($table, $params);
        }

        public function haVotado($idUsuario, $idIncidencia)
        {
            $table = "valoraciones";
            $select = "SELECT COUNT(*) AS count FROM $table WHERE idusuario = ? AND idincidencia = ?";
            $params = [$idUsuario, $idIncidencia];

            $result = $this->query($select, $params);

            return ($result[0]['count'] > 0);
        }

        public function obtenerVotos($idIncidencia,$voto)
        {
            $table = "valoraciones";
            $select = "SELECT COUNT(*) AS count FROM $table WHERE idincidencia = ? AND valoraciones = ?";
            $params = [$idIncidencia,$voto];

            $result = $this->query($select, $params);

            return $result[0]['count'];
        }
        


    }
?>