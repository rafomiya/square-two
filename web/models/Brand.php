<?php

require_once __DIR__ . '/Database.php';


class Brand
{
    /**
     * Creates a new instance of Brand
     */
    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Gets a PDO connection to the database.
     */
    private static function get_conn()
    {
        return (new Database())->pdo;
    }

    /**
     * Gets the array with all the brands.
     */
    public static function get_brands()
    {
        $conn = Brand::get_conn();

        $sql =
        'SELECT
                id_brand as `id`,
                name_brand as `name`
            from brand;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        $brands = [];

        foreach ($stm->fetchAll() as $row)
            $brands[] = new Brand($row['id'], $row['name']);

        return $brands;
    }
}
