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

    private function get_view($view_name)
    {
        $conn = $this->get_conn();

        $sql = "SELECT view_code from view where view_name=:view_name;";

        $stm = $conn->prepare($sql);
        $stm->bindValue(":view_name", $view_name);
        $stm->execute();

        $code = $stm->fetchAll()[0]["view_code"];

        return $code;
    }

    public function get_products()
    {
        $conn = $this->pdo;

        $sql = $this->get_view("list_products");

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }
}
