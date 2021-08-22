<?php
class Database
{
    private string $server;
    private string $user;
    private string $dbname;
    private string $password;
    // private PDO $pdo;

    function __construct()
    {
        $this->server = getenv("SERVER");
        $this->user = getenv("USER");
        $this->dbname = getenv("DBNAME");
        $this->password = getenv("PASSWORD");

        $this->pdo = new PDO('mysql:dbname=' . $this->dbname . ';host=' . $this->server, $this->user, $this->password);
    }
}
