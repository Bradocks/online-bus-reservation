<?php

class BookingReportGenerator
{

    private $queries = [
        "PassengerId" => [
            "query" => "SELECT * FROM passenger",
            "type" => "keyval",
            "value" => "passengerId",
            "text" => "passengerIdNo"
        ],
        "vehicleId" => [
            "query" => "SELECT * FROM vehicle",
            "type" => "keyval",
            "value" => "vehicleId",
            "text" => "plateNo"
        ],
        "departure" => [
            "query" => "SELECT DISTINCT departure FROM booking",
            "type" => "string",
        ],
        "destination" => [
            "query" => "SELECT DISTINCT destination FROM booking",
            "type" => "string",
        ],
        "category" => [
            "query" => "SELECT DISTINCT category FROM booking",
            "type" => "string",
        ],
        // [
        //     "route" => []
        // ],
        // [
        //     "charges" => []
        // ],
        // [
        //     "PaymentMethod" => []
        // ],
        // [
        //     "PaymentStatement" => []
        // ],
        // [
        //     "paymentDetail" => []
        // ],
        // [
        //     "ticketCode" => []
        // ],
    ];

    private mysqli $conn;

    public function __construct(mysqli $conn = null)
    {
        $this->conn = $conn;
    }


    public function render_filters()
    {
        echo "<form  method='GET' style='display: flex; flex-wrap: wrap; align-items: center;'>";

        echo "<input type='hidden' name='type' value='listOfbookings'/>";

        foreach ($this->queries as $key => $details) {
            $query = $details['query'];
            $result = $this->conn->query($query);

            echo "<div style='margin-right: 20px;'>";
            echo "<label for='$key'>$key:</label><br>";
            echo "<select name='$key' id='$key'>";
            echo "<option></option>";

            while ($row = $result->fetch_assoc()) {
                if ($details['type'] === 'keyval') {
                    $valueField = $details['value'];
                    $textField = $details['text'];

                    var_dump("<option value='" . htmlspecialchars($row[$valueField]) . "'>" . htmlspecialchars($row[$textField]) . "</option>");
                    echo "<option value='" . htmlspecialchars($row[$valueField]) . "'>" . htmlspecialchars($row[$textField]) . "</option>";
                } elseif ($details['type'] === 'string') {
                    $columns = array_keys($row);
                    $firstColumn = $columns[0];
                    echo "<option value='" . htmlspecialchars($row[$firstColumn]) . "'>" . htmlspecialchars($row[$firstColumn]) . "</option>";
                }
            }
            echo "</select>";
            echo "</div>";
        }

        echo "<input type='submit' value='Submit' style='margin-left: auto;'>";
        echo "</form>";
    }

    public function filter_query(string $tableName = "booking", array $exclusions = ['type'])
    {
        $queryString = ''; // Initialize the query string
        if (!empty($_GET)) {
            $whereClauses = []; // To hold parts of our WHERE clause
            $params = []; // To hold parameter values for display

            foreach ($_GET as $key => $value) {
                // Check if the key is not in the exclusion list and has data
                if (!in_array($key, $exclusions) && !empty($value)) {
                    $whereClauses[] = "$key = ?";
                    $params[] = $value; // Collect value for display
                }
            }

            if (!empty($whereClauses)) {
                $queryString = "WHERE ";
                $queryString .= implode(" AND ", $whereClauses); // Append all where clauses
                // Replace placeholders with actual parameters for display
                foreach ($params as $param) {
                    $pos = strpos($queryString, '?');
                    if ($pos !== false) {
                        $queryString = substr_replace($queryString, "'" . $param . "'", $pos, 1);
                    }
                }
            }
        }

        return $queryString;
    }
}
