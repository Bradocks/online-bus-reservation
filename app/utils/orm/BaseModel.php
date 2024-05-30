<?php
class BaseModel
{
    protected $table_name;
    protected $conn;
    protected $conditions = [];
    protected $joins = [];
    protected $selects = ['*'];
    protected $group_by = [];
    protected $havings = [];

    public function __construct($table_name, $conn)
    {
        $this->table_name = $table_name;
        $this->conn = $conn;
    }

    public function select($fields)
    {
        if (is_array($fields)) {
            $this->selects = $fields;
        } else {
            $this->selects = func_get_args();
        }
        return $this;
    }

    public function first()
    {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM {$this->table_name}";
        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(' AND ', $this->conditions);
        }
        if (!empty($this->group_by)) {
            $sql .= " GROUP BY " . implode(', ', $this->group_by);
        }
        $sql .= " LIMIT 1";
        $result = $this->conn->query($sql);
        if (!$result) {
            throw new Exception("Database Query Failed: " . $this->conn->error);
        }
        return (object) $result->fetch_assoc();
    }

    public function where($field, $operator, $value)
    {
        $this->conditions[] = sprintf("%s %s '%s'", $field, $operator, $this->conn->real_escape_string($value));
        return $this;
    }

    public function join($table, $condition, $type = 'INNER')
    {
        $this->joins[] = sprintf("%s JOIN %s ON %s", strtoupper($type), $table, $condition);
        return $this;
    }

    public function groupBy($fields)
    {
        if (is_array($fields)) {
            $this->group_by = $fields;
        } else {
            $this->group_by = func_get_args();
        }
        return $this;
    }

    public function get_all()
    {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM {$this->table_name}";
        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(' AND ', $this->conditions);
        }
        if (!empty($this->group_by)) {
            $sql .= " GROUP BY " . implode(', ', $this->group_by);
        }

        $result = $this->conn->query($sql);
        if (!$result) {
            throw new Exception("Database Query Failed: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function get_one($id, $column = 'id')
    {
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM `{$this->table_name}`";
        if (!empty($this->joins)) {
            $sql .= ' ' . implode(' ', $this->joins);
        }
        $sql .= " WHERE `{$this->table_name}`.`{$column}` = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Database Query Failed: " . $this->conn->error);
        }
        return (object) $result->fetch_assoc();
    }

    public function having($column, $operator, $value) {
        $this->havings[] = "$column $operator '$value'";
        return $this;
    }
    
    private function get_param_type($params)
    {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } elseif (is_string($param)) {
                $types .= 's';
            } else {
                $types .= 'b';
            }
        }
        return $types;
    }

    private function debug_query($query, $params)
    {
        foreach ($params as $param) {
            $param = is_numeric($param) ? $param : "'" . addslashes($param) . "'";
            $query = preg_replace('/\?/', $param, $query, 1);
        }
        return $query;
    }

    public function create($data, $id_column = 'id')
    {
        $keys = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->table_name} ($keys) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $stmt->bind_param(strtolower($this->get_param_type(array_values($data))), ...array_values($data));

        if ($stmt->execute()) {
            $id = $stmt->insert_id;
            return $this->get_one($id, $id_column);
        }
        return null;
    }

    public function update($id, $data, $id_column = 'id')
    {
        $updates = implode(', ', array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sql = "UPDATE {$this->table_name} SET $updates WHERE {$id_column} = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $data[$id_column] = $id;
        $stmt->bind_param(strtolower($this->get_param_type(array_values($data))), ...array_values($data));

        if ($stmt->execute()) {
            return $this->get_one($id, $id_column);
        }
        return null;
    }

    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function paginate($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT " . implode(', ', $this->selects) . " FROM {$this->table_name} LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $stmt->bind_param("ii", $perPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Database Query Failed: " . $this->conn->error);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function random_select()
    {
        $sql = "SELECT * FROM {$this->table_name} ORDER BY RAND() LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Database Prepare Failed: " . $this->conn->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Database Query Failed: " . $this->conn->error);
        }
        return (object) $result->fetch_assoc();
    }

    public static function generate_id($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
