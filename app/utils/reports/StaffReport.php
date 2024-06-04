<?php

require_once __DIR__ . "/Generator.php";

class StaffReportGenerator extends BaseReportGenerator
{
    protected $queries = [];


    public function __construct(mysqli $conn = null)
    {
        $this->queries = [
            new QueryDef([
                "key" => "position",
                "query" => "SELECT DISTINCT `role` FROM staff",
                "type" => "string",
            ]),
            new QueryDef([
                "key" => "state",
                "query" => "SELECT DISTINCT `state` FROM staff",
                "type" => "string",
            ]),
            new QueryDef([
                "key" => "gender",
                "query" => "SELECT DISTINCT gender FROM staff",
                "type" => "string",
            ]),
        ];
        parent::__construct($conn);
    }
}
