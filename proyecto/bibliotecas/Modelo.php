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
            throw new Exception('Failed to prepare statement: ' . $this->db->error);
        }
    
        if (!empty($params)) {
            $types = '';
            $values = [];
        
            foreach ($params as $key => $param) {
                if (in_array($key, $blobs)) {
                    $types .= 'b';
                } else {
                    $types .= $this->getMysqliType($param);
                }
                $values[] = $param;
            }
        
            $stmt->bind_param($types, ...$values);
        }
    
        $result = null;
    
        if ($stmt->execute()) {
            if ($return_result) {
                $result_set = $stmt->get_result();
            
                if ($result_set === false) {
                    throw new Exception('Failed to get result set: ' . $stmt->error);
                }
            
                $result = $result_set->fetch_assoc();
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

        return $result['current_schema'];
    }

    public function tableExists($table)
    {
        $select = "SELECT COUNT(*) AS C FROM information_schema.tables WHERE table_schema = ? AND table_name = ?";
        $params = [$this->getCurrentSchema(), $table];
        $result = $this->query($select, $params);

        return ($result !== null && $result['C'] > 0);
    }

    public function columnCount($tab)
    {
        $select = "SELECT COUNT(*) AS C FROM information_schema.columns WHERE table_name = ?";
        $result = $this->query($select,[$tab]);

        return $result['C'];
    }

    public function insert($table, $params = [])
    {
        $query = $this->buildQuery($table, [], $params, 'INSERT');

        return $this->query($query['query'], $query['params'], $query['blobs']);
    }

    protected function buildQuery($table, $conditions, $params, $queryType)
    {
        $where = [];
        $blobs = [];

        foreach ($params as $column => $value) {
            if ($this->isBlobColumn($table, $column)) {
                $blobs[] = $column;
            }
        }

        foreach ($conditions as $column => $value) {
            $where[] = "$column = ?";
            $params[] = $value;
        }
        $whereClause = implode(' AND ', $where);

        $query = "$queryType $table";
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

        $query = $this->buildQuery($table, $conditions, $columns, 'UPDATE');
        $query['query'] .= " SET " . implode(', ', array_map(function ($column) {
            return "$column = ?";
        }, array_keys($columns)));

        return $this->query($query['query'], $query['params'], $query['blobs']);
    }

    protected function isBlobColumn($table, $column)
    {
        $query = "SELECT DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? AND COLUMN_NAME = ?";

        $result = $this->query($query, [$table, $column]);

        $dataType = $result[0]['DATA_TYPE'];

        return ($dataType == 'mediumblob');
    }

    public function delete($table, $conditions = [])
    {
        $params = [];

        // Construir la consulta SQL de eliminación utilizando la función buildQuery
        $queryData = $this->buildQuery($table, $conditions, $params, 'DELETE');

        return $this->query($queryData['query'], $queryData['params']);
    }




}
?>