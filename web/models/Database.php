<?php

class Database
{
    function __construct()
    {
        $server = getenv("DB_SERVER");
        $user = getenv("DB_USER");
        $dbname = getenv("DB_NAME");
        $password = getenv("DB_PASSWORD");

        try {
            $this->pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $server, $user, $password);
        } catch (Exception $e) {
            $server = getenv("LOCAL_SERVER");
            $user = getenv("LOCAL_USER");
            $dbname = getenv("LOCAL_NAME");
            $password = getenv("LOCAL_PASSWORD");

            $this->pdo = new PDO('mysql:dbname=' . $dbname . ';host=' . $server, $user, $password);
        }
    }
}
