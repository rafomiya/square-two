<?php
require_once 'Database.php';

class Product
{
    public int $id;
    public string $brand;
    public string $model;
    public string $category;
    public float $price;
    public string $description;

    public static function getRow($id)
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
            inner join category on product.id_category = category.id_cat
        where product.id_prod = :id_prod;";

        $stm = $pdo->prepare($sql);
        $stm->bindValue(':id_prod', $id);
        $stm->execute();

        return $stm->fetchAll()[0];
    }


    function __construct($id)
    {
        $row = Product::getRow($id);


        $this->id = $row['id_prod'];
        $this->brand = $row['name_brand'];
        $this->model = $row['model_prod'];
        $this->category = $row['name_cat'];
        $this->preco = $row['preco_prod'];
        $this->descr = $row['descr_prod'];
    }


    function getid()
    {
        return $this->id;
    }
    function getbrand()
    {
        return $this->brand;
    }
    function getmodel()
    {
        return $this->model;
    }
    function getcategory()
    {
        return $this->category;
    }
    function getprice()
    {
        return $this->preco;
    }
    function getdescription()
    {
        return $this->descr;
    }
}
