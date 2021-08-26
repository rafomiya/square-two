<?php

class Database
{
    private string $server;
    private string $user;
    private string $dbname;
    private string $password;

    function __construct()
    {
        $this->server = getenv("DB_SERVER");
        $this->user = getenv("DB_USER");
        $this->dbname = getenv("DB_NAME");
        $this->password = getenv("DB_PASSWORD");

        $this->pdo = new PDO('mysql:dbname=' . $this->dbname . ';host=' . $this->server, $this->user, $this->password);
    }

    private function get_conn()
    {
        return $this->pdo;
    }

    public function get_products()
    {

        $conn = $this->get_conn();

        $sql = $this->get_view("get_products");

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }

    private function get_view($view)
    {
        require_once __DIR__ . '/SQLViews.php';
        return $views[$view];
    }
}
