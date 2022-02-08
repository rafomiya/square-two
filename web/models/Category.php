<?php
require_once __DIR__ . '/Database.php';


class Category
{
    /**
     * Creates a new instance of Category.
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
     * Gets the array with all the products.
     */
    public static function get_categories()
    {
        $conn = Category::get_conn();

        $sql =
        'SELECT
                id_cat as `id`,
                name_cat as `name`
            from category;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        $categories = [];

        foreach ($stm->fetchAll() as $row)
            $categories[] = new Category($row['id'], $row['name']);

        return $categories;
    }
}
