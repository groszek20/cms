<?php

define("DB_HOST", "127.0.0.1");
define("DB_USER", "adam");
define("dsn", 'mysql:dbname=cms;host=127.0.0.1');
define("DB_PASS", "root");
define("DB_NAME", "cms");

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

function getConnectionPDO() {
    try{
        $connection = new PDO(dsn, DB_USER, DB_PASS, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        return $connection;
    }catch (PDOException $e){
        echo 'Połączenie nie mogło zostać utworzone: ' . $e->getMessage();
    }
}
