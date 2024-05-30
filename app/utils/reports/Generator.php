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
        "status" => [
            "type" => "status",
            "options" => [
                "SUCCESSFUL" => "SUCCESSFUL",
                "UNSUCCESSFUL" => "UNSUCCESSFUL",
            ]
        ],
        "time" => [
            "type" => "time",
            "options" => [
                "1_year" => "Last 1 Year",
                "6_months" => "Last 6 Months",
                "3_months" => "Last 3 Months",
                "1_month" => "Last 1 Month",
                "1_week" => "Last 1 Week",
                "1_day" => "Last 1 Day",
            ]
        ]
    ];

    private mysqli $conn;

    public function __construct(mysqli $conn = null)
    {
        $this->conn = $conn;
    }

    public function render_filters()
    {
        echo "<form method='GET' style='display: flex; flex-wrap: wrap; align-items: center;'>";

        echo "<input type='hidden' name='type' value='listOfbookings'/>";

        foreach ($this->queries as $key => $details) {
            echo "<div style='margin-right: 20px;'>";
            echo "<label for='$key'>$key:</label><br>";
            echo "<select name='$key' id='$key'>";
            echo "<option></option>";

            if ($details['type'] === 'keyval' || $details['type'] === 'string') {
                $query = $details['query'];
                $result = $this->conn->query($query);

                while ($row = $result->fetch_assoc()) {
                    if ($details['type'] === 'keyval') {
                        $valueField = $details['value'];
                        $textField = $details['text'];
                        echo "<option value='" . htmlspecialchars($row[$valueField]) . "'>" . htmlspecialchars($row[$textField]) . "</option>";
                    } elseif ($details['type'] === 'string') {
                        $columns = array_keys($row);
                        $firstColumn = $columns[0];
                        echo "<option value='" . htmlspecialchars($row[$firstColumn]) . "'>" . htmlspecialchars($row[$firstColumn]) . "</option>";
                    }
                }
            } elseif ($details['type'] === 'time') {
                foreach ($details['options'] as $value => $text) {
                    echo "<option value='$value'>$text</option>";
                }
            } elseif ($details['type'] === 'status') {
                foreach ($details['options'] as $value => $text) {
                    echo "<option value='$value'>$text</option>";
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
        $queryString = '';
        if (!empty($_GET)) {
            $whereClauses = [];
            $params = [];

            foreach ($_GET as $key => $value) {
                if (!in_array($key, $exclusions) && !empty($value)) {
                    if ($key === 'time') {
                        $whereClauses[] = $this->get_time_filter_clause($value);
                    } else if ($key === 'status') {
                        $whereClauses[] = $this->get_status_failed($value);
                    } else {
                        $whereClauses[] = "$key = ?";
                        $params[] = $value;
                    }
                }
            }

            if (!empty($whereClauses)) {
                $queryString = "WHERE ";
                $queryString .= implode(" AND ", $whereClauses);

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

    private function get_status_failed($status)
    {
        $query = "";
        switch ($status) {
            case 'UNSUCCESSFUL':
                $query = "PaymentStatement IS NULL OR PaymentStatement = ''";
                break;
            case 'SUCCESSFUL':
                $query = "PaymentStatement <> NULL OR PaymentStatement <> ''";
                break;
        }
        return $query;
    }

    private function get_time_filter_clause($time)
    {
        $currentDateTime = date('Y-m-d H:i:s');
        switch ($time) {
            case '1_year':
                $date = date('Y-m-d H:i:s', strtotime('-1 year'));
                break;
            case '6_months':
                $date = date('Y-m-d H:i:s', strtotime('-6 months'));
                break;
            case '3_months':
                $date = date('Y-m-d H:i:s', strtotime('-3 months'));
                break;
            case '1_month':
                $date = date('Y-m-d H:i:s', strtotime('-1 month'));
                break;
            case '1_week':
                $date = date('Y-m-d H:i:s', strtotime('-1 week'));
                break;
            case '1_day':
                $date = date('Y-m-d H:i:s', strtotime('-1 day'));
                break;
            default:
                return '';
        }
        return "dateTime BETWEEN '$date' AND '$currentDateTime'";
    }
}
