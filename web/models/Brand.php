<?php

require_once __DIR__ . '/Database.php';


class Brand
{
    /**
     * Gets a PDO connection to the database.
     */
    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    /**
     * Gets the array with all the products.
     */
    public static function get_brands()
    {
        $conn = Brand::get_conn();

        $sql =
            'SELECT
                id_brand as id,
                name_brand as brand
            from brand;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }
}
