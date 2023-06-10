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
        
            $result = $this->query($select, [$id]);

            return $result[0];
        }

        public function obtenerIncidenciasUsuario($idUsuario)
        {
            $select = "SELECT * FROM incidencias WHERE idusuario = ?";
        
            return $this->query($select, [$idUsuario]);
        }

        public function existeIncidencia($id)
        {
            $select = "SELECT * FROM incidencias WHERE id = ?";
        
            $result = $this->query($select, [$id]);

            return count($result) > 0;
        }

        public function top()
        {
            $select = "SELECT idusuario, COUNT(*) AS total_incidentes FROM incidencias GROUP BY idusuario ORDER BY total_incidentes DESC LIMIT 3";

            return $this->query($select);

        }

        

        public function filtrar($cOrdenacion,$texto=null,$lugar=null,$idusuario=null,$estados = [])
        {
            $conditions = [];
            $params = [];   


            //criterio de filtrado 

            if($texto != null)
            {
                $conditions[] = "titulo LIKE ? OR descripcion LIKE ? OR keywords LIKE ?";
                $params[] = "%$texto%";
                $params[] = "%$texto%";
                $params[] = "%$texto%";
            }

            if($lugar != null)
            {
                $conditions[] = "lugar = ?";
                $params[] = $lugar;
            }

            if($idusuario != null)
            {
                $conditions[] = "idusuario = ?";
                $params[] = $idusuario;
            }

            if(!empty($estados))
            {
                $conditions[] = "estado IN (".implode(',',array_fill(0,count($estados),'?')).")";
                $params = array_merge($params,$estados);


            }

            //criterios de ordenacion
            switch($cOrdenacion)
            {
                case 'antiguedad':
                    $orderBy = "fecha DESC";
                    break;
                case 'positivos':
                    $orderBy = "(SELECT COUNT(*) FROM valoraciones WHERE valoraciones.idincidencia = incidencias.id AND valoraciones.valoraciones = 1) DESC";
                    break;
                case 'netos':
                    $orderBy = "(SELECT SUM(valoraciones.valoraciones) FROM valoraciones WHERE valoraciones.idincidencia = incidencias.id) DESC";
                    break;
            }

            $query = "SELECT * FROM incidencias";

            if(!empty($conditions))
                $query .= " WHERE ".implode(' AND ',$conditions);
            

            
            $query .= " ORDER BY $orderBy";

            return $this->query($query,$params);
        }
    }
?>