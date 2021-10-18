<?php

require_once __DIR__ . '/Database.php';

class Product
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
    public static function get_products()
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_products;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }

    /**
     * Gets the array with the new products.
     */
    public static function get_new_products()
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_products where is_new = 1;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }

    /**
     * Gets all the products of certain category.
     */
    public static function get_category_products($id_cat)
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_categories where id_cat = :id_cat;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_cat', $id_cat);
        $stm->execute();

        return $stm->fetchAll();
    }

    /**
     * Gets all the products of certain brand.
     */
    public static function get_brand_products($id_brand)
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_details where id_brand = :id_brand;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_brand', $id_brand);
        $stm->execute();

        return $stm->fetchAll();
    }

    /**
     * Get a single product.
     */
    public static function get_product($id)
    {
        $conn = Product::get_conn();
        $sql = 'SELECT * from list_details where id = :id;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        return $stm->fetchAll()[0];
    }

    public static function get_search($search)
    {
        $conn = Product::get_conn();
        $sql =
            "SELECT * from list_categories
            where
                model like :search or
                brand like :search or
                category like :search;";

        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', '%' . $search . '%');
        $stm->execute();

        return $stm->fetchAll();
    }

    /**
     * Loads the products with the correct style.
     */
    public static function load_products($prods)
    {
        echo '<h2 class="mb-3">' . count($prods) . ' resultados encontrados.</h2>';

        $aws_link = getenv('AWS_LINK');

        foreach ($prods as $prod) :
            $img_bw = $prod['inventory'] == 0 ? 'bw' : '';
            $btn_disabled = $prod['inventory'] == 0 ? 'disabled' : '';  ?>

            <div class="prod">
                <img class="<?= $img_bw ?>" src="<?= $aws_link . $prod['image'] ?>" />
                <p class="text-muted"><?= $prod['brand'] ?></p>
                <h4 class="fw-bold"><?= mb_strimwidth($prod['model'], 0, 16, '...') ?></h4>
                <p class="fs-5 mt-3">R$<?= number_format($prod['price'], 2, ',', '.') ?></p>
                <div class="d-grid gap-2">
                    <button type="button" <?= $btn_disabled ?> class="btn btn-lg btn-primary">
                        <span class="bi bi-bag-check" role="img" aria-label="bag-icon"></span>
                        Comprar
                    </button>
                    <a href="../controllers/details.php?p=<?= $prod['id'] ?>" type="button" class="btn btn-lg btn-outline-secondary">
                        <span class="bi bi-info-circle" role="img" aria-label="info-icon"></span>
                        Detalhes
                    </a>
                </div>
            </div>
<?php endforeach;
    }
}
