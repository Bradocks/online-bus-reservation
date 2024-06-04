<?php

require_once __DIR__ . "/Generator.php";

class VehicleReportGenerator extends BaseReportGenerator
{
    protected $queries = [];



    public function __construct(mysqli $conn = null)
    {

        $this->custom_query = "SELECT
                v.*,
                bs.status as bs_status,
                COUNT(*) as seat_count
            FROM `vehicle` AS v
            JOIN bus_seats AS bs
            ON bs.vehicleId = v.vehicleId
            {where_clause}
            GROUP BY v.vehicleId, bs.status";


        $this->queries = [
            new QueryDef([
                "key" => "driverId",
                "query" => "SELECT * FROM user where `role` = 'driver'",
                "type" => "keyval",
                "value" => "userId",
                "text" => "name"
            ]),
            new QueryDef([
                "key" => "bs.status",
                "type" => "status",
                "options" => [
                    "booked" => "booked",
                    "available" => "available",
                ]
            ]),
        ];
        parent::__construct($conn);
    }
}
