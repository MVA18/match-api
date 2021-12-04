<?php

namespace App\config;

use PDO;

class DB
{
    // Properties
    private $dbhost = 'match_database';
    private $dbname = 'match_database';
    private $dbuser = 'match_user';
    private $dbpass = 'match_password';
    
    //Connect
    public function connect()
    {
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str,$this->dbuser,$this->dbpass);   
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}