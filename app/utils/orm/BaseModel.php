<?php
class BaseModel
{
    protected $table_name;
    protected $conn;
    protected $conditions = [];

    public function __construct($table_name, $conn) //initializes the BaseModel with the table name and database connection.
    {
        $this->table_name = $table_name;
        $this->conn = $conn;
    }

    public function first()
    {
        $sql = "SELECT * FROM {$this->table_name}";
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(' AND ', $this->conditions);
        }
        $sql .= " LIMIT 1"; // Limit the results to only 1
        $result = $this->conn->query($sql);
        return (object) $result->fetch_assoc(); // Fetch and return the first row
    }

    public function where($field, $operator, $value)
    {
        $this->conditions[] = sprintf("%s %s '%s'", $field, $operator, $this->conn->real_escape_string($value));
        return $this; // Return $this for method chaining
    }

    public function get_all() //Retrieves all records from the table.
    {
        $sql = "SELECT * FROM {$this->table_name}";
        if (!empty($this->conditions)) {
            $sql .= " WHERE " . implode(' AND ', $this->conditions);
        }
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * @param mixed $id
     * @param string $column
     */
    public function get_one($id, $column = 'id') //Retrieves a single record by its ID.
    {
        $sql = "SELECT * FROM `{$this->table_name}` WHERE `{$column}` = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return (object) $result->fetch_assoc();
    }

    private function get_param_type($params) //Determines the parameter types for bind_param() based on the values' data types.
    {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';  // Type integer
            } elseif (is_float($param)) {
                $types .= 'd';  // Type double
            } elseif (is_string($param)) {
                $types .= 's';  // Type string
            } else {
                $types .= 'b';  // Type blob or default to blob
            }
        }
        return $types;
    }

    private function debug_query($query, $params)
    {
        foreach ($params as $param) {
            // Assuming all parameters are strings here, adjust as necessary for real types
            $param = is_numeric($param) ? $param : "'" . addslashes($param) . "'";
            $query = preg_replace('/\?/', $param, $query, 1);
        }
        return $query;
    }

    /**
     * @param mixed $name
     */
    public function create($data, $id_column = 'id') //Prepares an INSERT SQL statement with placeholders, Uses get_param_type() to determine the parameter types, Binds the parameters to the statement using bind_param()
    {
        $keys = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

        $sql = "INSERT INTO {$this->table_name} ($keys) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(strtolower($this->get_param_type(array_values($data))), ...array_values($data));

        if ($stmt->execute()) {
            $id = $stmt->insert_id;  // Get the ID of the inserted record
            return $this->get_one($id, $id_column);  // Assuming you have a method to fetch a single record by ID
        }
        return null;  // Return null if the insert failed
    }


    public function update($id, $data, $id_column = 'id') //Prepares an UPDATE SQL statement with placeholders, Uses get_param_type() to determine the parameter types, appending 'i' for the ID parameter, Binds the parameters to the statement using bind_param().
    {
        $updates = implode(', ', array_map(function ($key) {
            return "$key = ?";
        }, array_keys($data)));

        $sql = "UPDATE {$this->table_name} SET $updates WHERE {$id_column} = ?";


        $stmt = $this->conn->prepare($sql);
        $data[$id_column] = $id;  // Ensure 'id' is at the end of $data
        $stmt->bind_param(strtolower($this->get_param_type(array_values($data))), ...array_values($data));

        if ($stmt->execute()) {
            return $this->get_one($id, $id_column);  // Fetch and return the updated record
        }
        return null;  // Return null if the update failed
    }


    public function delete($id) //Deletes a record by its ID.
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function paginate($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM {$this->table_name} LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $perPage, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function random_select()
    {
        $sql = "SELECT * FROM {$this->table_name} ORDER BY RAND() LIMIT 1;";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
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
