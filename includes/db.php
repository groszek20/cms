<?php

define("DB_USER", "adam");
define("dsn", 'mysql:dbname=cms;host=localhost');
define("DB_PASS", "root");
define("DB_NAME", "cms");

define("DB_HOST_LOCAL", "localhost");
define("DB_USER_LOCAL", "root");
define("DB_PASS_LOCAL", "");

$connection = mysqli_connect(DB_HOST_LOCAL, DB_USER_LOCAL, DB_PASS_LOCAL, DB_NAME);

$options = [
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
 PDO::ATTR_EMULATE_PREPARES => false,
 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
];

function getConnectionPDO() {
    try {
        $connection = new PDO(dsn, DB_USER_LOCAL, DB_PASS_LOCAL, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        return $connection;
    } catch (PDOException $e) {
        error_log($e->getMessage());
        exit("Połączenie nie mogło zostać utworzone");
    }
}
