<?php
    class Fotos extends Modelo
    {
        function __construct()
        {
            parent::__construct();

            if(!$this->tableExists('fotos'))
                $this->createTable();
        }

        private function createTable()
        {
            $q = "CREATE TABLE IF NOT EXISTS `fotos`(
                                `id` INT(11) NOT NULL AUTO_INCREMENT,
                                `fotografia` MEDIUMBLOB,
                                `idincidencia` INT(11) NOT NULL,
                                PRIMARY KEY(`id`),
                                KEY `fk_fotos_1_idx`(`idincidencia`),
                                CONSTRAINT `tk_fotos_1` FOREIGN KEY(`idincidencia`)REFERENCES `incidencias`(`id`) ON DELETE CASCADE ON UPDATE CASCADE);";
            $this->query($q,[],[],false);
        }

        public function insertarFoto($fotografia, $idincidencia)
        {
            $table = 'fotos';
            $columns = [
                'fotografia' => $fotografia,
                'idincidencia' => $idincidencia
            ];

            return $this->insert($table, $columns);
        }


        public function eliminarFoto($id)
        {
            $table = 'fotos';
            $conditions = [
                'id' => $id
            ];

            return $this->delete($table, $conditions);
        }

        public function obtenerFoto($id)
        {
            $table = 'fotos';
            $select = "SELECT fotografia FROM $table WHERE id = ?";
            $params = [$id];

            return $this->query($select, $params);
        }

        public function obtenerFotosIncidencia($idincidencia)
        {
            $table = 'fotos';
            $select = "SELECT * FROM $table WHERE idincidencia = ?";
            $params = [$idincidencia];

            return $this->query($select, $params);
        }


    }
?>