<?php

use App\config\DB;

if (!function_exists('queryDB'))
{
    function queryDB($sql)
    {
        $db = new DB();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $response = $stmt->fetchAll(PDO::FETCH_OBJ);

        $db = null;

        if($response) 
            return $response; 
    };
}