<?php


class QueryDef
{
    public $key;
    public $value;
    public $text;
    public $query;
    public $type;
    public $options;

    public $custom_where;


    public function __construct($query = [])
    {
        $this->key = $query['key'];
        $this->value = $query['value'];
        $this->text = $query['text'];
        $this->query = $query['query'];
        $this->type = $query['type'];
        $this->options = $query['options'];
        $this->custom_where = $query['custom_where'];
    }
}

class BaseReportGenerator
{

    protected $custom_query = null;
    protected $queries = [];
    protected mysqli $conn;

    public function __construct(mysqli $conn = null)
    {
        $this->conn = $conn;
    }

    public function render_filters(string $type)
    {
        echo "<form method='GET' style='display: flex; flex-wrap: wrap; align-items: center;'>";

        echo "<input type='hidden' name='type' value='" . $type . "'/>";

        // var_dump($this->queries);
        foreach ($this->queries as $query) {
            // var_dump($details->type == 'keyval' || $details->type == 'string');
            $details = (object) $query;


            echo "<div style='margin-right: 20px;'>";
            echo "<label for='$details->key'>$details->key:</label><br>";
            echo "<select name='" . htmlspecialchars($details->key) . "' id='$details->key'>";
            echo "<option></option>";



            try {
                if ($details->type == 'keyval' || $details->type == 'string') {

                    $query = $details->query;
                    // var_dump($query);
                    $result = $this->conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($details->type === 'keyval') {
                                $valueField = $details->value;
                                $textField = $details->text;
                                echo "<option value='" . htmlspecialchars($row[$valueField]) . "'>" . htmlspecialchars($row[$textField]) . "</option>";
                            } elseif ($details->type === 'string') {
                                $columns = array_keys($row);
                                $firstColumn = $columns[0];
                                echo "<option value='" . htmlspecialchars($row[$firstColumn]) . "'>" . htmlspecialchars($row[$firstColumn]) . "</option>";
                            }
                        }
                    }
                } elseif ($details->type === 'time' || $details->type === 'status') {
                    foreach ($details->options as $value => $text) {
                        echo "<option value='$value'>$text</option>";
                    }
                }
            } catch (Exception $e) {
                var_dump($e->getMessage());
            }

            echo "</select>";
            echo "</div>";
        }

        echo "<input type='submit' value='Submit' style='margin-left: auto;'>";
        echo "</form>";
    }

    public function filter_query(string $tableName = null, array $exclusions = ['type'])
    {

        $queryString = '';

        if (isset($tableName)) {
            $queryString = 'SELECT * FROM ' . $tableName;
        }


        if (!empty($_GET)) {
            $whereClauses = [];
            $params = [];

            foreach ($_GET as $key => $value) {
                if (!in_array($key, $exclusions) && !empty($value)) {
                    if ($key === 'time') {
                        $whereClauses[] = $this->get_time_filter_clause($value);
                    } elseif ($key === 'status') {
                        $whereClauses[] = $this->get_status_filter_clause($value);
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

        if (isset($this->custom_query)) {
            $queryString = "SELECT * FROM (" . str_replace('{where_clause}', "", $this->custom_query) . ") as result " . $queryString;
        }
        echo "<pre>" . $queryString . "</pre>";

        return $queryString;
    }

    protected function get_status_filter_clause($status)
    {
        $query = "";
        switch ($status) {
            case 'UNSUCCESSFUL':
                $query = "PaymentStatement IS NULL OR PaymentStatement = ''";
                break;
            case 'SUCCESSFUL':
                $query = "PaymentStatement IS NOT NULL AND PaymentStatement <> ''";
                break;
        }
        return $query;
    }

    protected function get_time_filter_clause($time)
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


class BookingReportGenerator extends BaseReportGenerator
{
    protected $queries = [];


    public function __construct(mysqli $conn = null)
    {
        $this->queries = [
            new QueryDef([
                "key" => "PassengerId",
                "query" => "SELECT * FROM passenger",
                "type" => "keyval",
                "value" => "passengerId",
                "text" => "passengerIdNo"
            ]),
            new QueryDef([
                "key" => "vehicleId",
                "query" => "SELECT * FROM vehicle",
                "type" => "keyval",
                "value" => "vehicleId",
                "text" => "plateNo"
            ]),
            new QueryDef([
                "key" => "departure",
                "query" => "SELECT DISTINCT departure FROM booking",
                "type" => "string",
            ]),
            new QueryDef([
                "key" => "destination",
                "query" => "SELECT DISTINCT destination FROM booking",
                "type" => "string",
            ]),
            new QueryDef([
                "key" =>  "category",
                "query" => "SELECT DISTINCT category FROM booking",
                "type" => "string",
            ]),
            new QueryDef([
                "key" => "status",
                "type" => "status",
                "options" => [
                    "SUCCESSFUL" => "SUCCESSFUL",
                    "UNSUCCESSFUL" => "UNSUCCESSFUL",
                ]
            ]),
            new QueryDef([
                "key" => "time",
                "type" => "time",
                "options" => [
                    "1_year" => "Last 1 Year",
                    "6_months" => "Last 6 Months",
                    "3_months" => "Last 3 Months",
                    "1_month" => "Last 1 Month",
                    "1_week" => "Last 1 Week",
                    "1_day" => "Last 1 Day",
                ]
            ])
        ];
        parent::__construct($conn);
    }
}
