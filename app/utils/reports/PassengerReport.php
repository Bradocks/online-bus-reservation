<?php

require_once __DIR__ . "/Generator.php";

class PassengerReportGenerator extends BaseReportGenerator
{
    protected $queries = [];


    public function __construct(mysqli $conn = null)
    {
        $this->queries = [
            new QueryDef([
                "key" => "driverId",
                "query" => "SELECT * FROM user where `role` = 'driver'",
                "type" => "keyval",
                "value" => "userId",
                "text" => "name"
            ])

            // Vacant positions
        ];
        parent::__construct($conn);
    }
}
