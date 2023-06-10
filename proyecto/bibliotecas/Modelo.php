<?php
class Modelo
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function query($select, $params = [], $blobs = [], $return_result = true)
    {
        $stmt = $this->db->prepare($select);
        
        if (!$stmt) {
            echo $select;
            echo $stmt;
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
    
        if (!empty($params)) {
            $types = '';
            $values = [];
        
            foreach ($params as $key => $param) {
                if (in_array($key, $blobs)) {
                    $values[] = '';
                    $types .= 'b';
                } else {
                    $values[] = $param;
                    $types .= $this->getMysqliType($param);
                }
                
            }
        
            $stmt->bind_param($types, ...$values);
            //var_dump($values);
            foreach ($blobs as $blobParam) {
                $blobData = $params[$blobParam];
                $segmentSize = 4096; // Tamaño de cada segmento del Blob
                $blobLength = strlen($blobData);
                $segmentOffset = 0;
        
                $paramIndex = array_search($blobParam, array_keys($params)); // Obtener el índice del parámetro Blob en bind_param
        
                while ($segmentOffset < $blobLength) {
                    $segment = substr($blobData, $segmentOffset, $segmentSize);
                    $stmt->send_long_data($paramIndex, $segment);
        
                    $segmentOffset += $segmentSize;
                }
            }
        }
        
        $result = null;
    
        if ($stmt->execute()) {
            if ($return_result) {
                if (strtoupper(substr($select, 0, 6)) === "SELECT") {
                    $result_set = $stmt->get_result();
                    if ($result_set === false) {
                        throw new Exception('Failed to get result set: ' . $stmt->error);
                    }
                    $result = $result_set->fetch_all(MYSQLI_ASSOC);
                }
            }
            $stmt->close();
        } else {
            throw new Exception('Failed to execute statement: ' . $stmt->error);
        }
        return $result;
    }


    protected function getMysqliType($var) {
        switch (gettype($var)) {
            case 'NULL':
            case 'string':
                return 's';
            case 'boolean':
            case 'integer':
                return 'i';
            default:
                throw new \InvalidArgumentException('Invalid type: ' . gettype($var));
        }
    }
    

    public function getCurrentschema()
    {
        $select = "SELECT DATABASE() AS current_schema";
        $result = $this->query($select);

        return $result[0]['current_schema'];
    }

    public function tableExists($table)
    {
        $select = "SELECT COUNT(*) AS C FROM information_schema.tables WHERE table_schema = ? AND table_name = ?";
        $params = [$this->getCurrentSchema(), $table];
        $result = $this->query($select, $params);

        return ($result !== null && $result[0]['C'] > 0);
    }

    public function columnCount($tab)
    {
        $select = "SELECT COUNT(*) AS C FROM information_schema.columns WHERE table_name = ?";
        $result = $this->query($select,[$tab]);

        return $result[0]['C'];
    }

    public function insert($table, $params = [])
    {
        $query = $this->buildQuery($table, [], $params, 'INSERT INTO');
        //var_dump($query);

        return $this->query($query['query'], $query['params'], $query['blobs']);
    }

    protected function buildQuery($table, $conditions, $params, $queryType)
    {
        $where = [];
        $blobs = [];
        $columns = [];
        $placeholders = [];

        foreach ($params as $column => $value) {
            if ($this->isBlobColumn($table, $column)) {
                $blobs[] = $column;
            }
            $columns[] = $column;
            $placeholders[] = '?';
        }

        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
            $params[] = $value;
        }
        $whereClause = implode(' AND ', $where);

        $query = "$queryType $table";

        if ($queryType == 'INSERT INTO') {
            $query .= ' (' . implode(', ', $columns) . ')';
            $query .= ' VALUES (' . implode(', ', $placeholders) . ')';
        }

        if (!empty($whereClause)) {
            $query .= " WHERE $whereClause";
        }

        return [
            'query' => $query,
            'params' => $params,
            'blobs' => $blobs
        ];
    }

    public function update($table, $columns, $conditions = [])
    {
        $params = array_values($columns);
    
        $query = "UPDATE $table SET " . implode(', ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($columns)));
    
        if (!empty($conditions)) {
            $where = [];
            foreach ($conditions as $column => $value) {
                $where[] = "$column = ?";
                $params[] = $value;
            }
            $whereClause = implode(' AND ', $where);
            $query .= " WHERE $whereClause";
        }
    
        return $this->query($query, $params);
    }

    protected function isBlobColumn($table, $column)
    {
        $query = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND COLUMN_NAME = ?";

        $result = $this->query($query, [$table, $column]);

        if($result != null )
        {
            $dataType = $result[0]['DATA_TYPE'];
            return ($dataType == 'mediumblob');
        }

        return false;            
    }

    public function delete($table, $conditions = [])
    {
        $params = [];

        // Construir la consulta SQL de eliminación utilizando la función buildQuery
        $queryData = $this->buildQuery($table, $conditions, $params, 'DELETE FROM');

        return $this->query($queryData['query'], $queryData['params']);
    }

    public function lastId()
    {
        return $this->db->insert_id;
    }

    public function DB_backup() {
        $select = "SHOW TABLES";
        $result = $this->db->query($select);
    
        if ($result === false) {
            throw new Exception("Error executing query: " . $this->db->error);
        }
    
        $tablas = [];
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $tablas[] = $row[0];

            $resultCreate = $this->db->query('SHOW CREATE TABLE '.$row[0]);//nuevo2
            $rowCreate = $resultCreate->fetch_array(MYSQLI_NUM);//nuevo2
            $tablasCreates[$row[0]] = $rowCreate[1];//nuevo2
        }
    
        $nombreArchivo = '/tmp/db_backup_'.date('Ymd_His').'.sql';
        $archivo = fopen($nombreArchivo, 'w');
    
        //$salida = '';
    
        foreach ($tablas as $tab) {
            //$result = $this->db->query('SHOW CREATE TABLE '.$tab);
            //$row2 = $result->fetch_array(MYSQLI_NUM);
            //$salida .= 'DROP TABLE IF EXISTS '.$tab.';';
            //$salida .= "\n\n".$row2[1].";\n\n";
            $salida = 'DROP TABLE IF EXISTS '.$tab.';';//nuevo2
            $salida .= "\n\n".$tablasCreates[$tab].";\n\n";//nuevo2
            fwrite($archivo, $salida);//nuevo2
        }
    
        foreach ($tablas as $tab) {
            // $result = $this->db->query('SHOW CREATE TABLE '.$tab);//nuevo
            // $row2 = $result->fetch_array(MYSQLI_NUM);//nuevo
            // $salida = 'DROP TABLE IF EXISTS '.$tab.';';//nuevo
            // $salida .= "\n\n".$row2[1].";\n\n";//nuevo

            // fwrite($archivo, $salida);
    
            $result = $this->db->query('SELECT * FROM '.$tab);
            $num_fields = $result->field_count;
    
            while ($row = $result->fetch_array(MYSQLI_NUM)) {
                $salida = 'INSERT INTO '.$tab.' VALUES(';
                for ($j = 0; $j < $num_fields; $j++) {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = preg_replace("/\n/","\\n",$row[$j]);
                    if (isset($row[$j])) $salida .= '"'.$row[$j].'"';
                    else $salida .= '""';
                    if ($j < ($num_fields - 1)) $salida .= ',';
                }
                $salida .= ");\n";
                fwrite($archivo, $salida);
            }
            fwrite($archivo, "\n\n\n");
        }
    
        fclose($archivo);
    
        return $nombreArchivo;
    }
    
}
?>