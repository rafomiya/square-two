<?php
class Database
{
    private string $server;
    private string $user;
    private string $dbname;
    private string $password;

    function __construct()
    {
        $this->server = getenv("SERVER");
        $this->user = getenv("USER");
        $this->dbname = getenv("DBNAME");
        $this->password = getenv("PASSWORD");

        $this->pdo = new PDO('mysql:dbname=' . $this->dbname . ';host=' . $this->server, $this->user, $this->password);
    }

    public function get_products()
    {
        $conn = new Database();

        $pdo = &$conn->pdo;

        $sql = "SELECT
            id_prod,
            name_cat,
            name_brand,
            model_prod,
            preco_prod,
            descr_prod
        from
            product inner join brand on product.id_brand = brand.id_brand
            inner join category on product.id_category = category.id_cat";

        $stm = $pdo->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }
}
