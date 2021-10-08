<?php

require_once __DIR__ . '/Database.php';

class Product
{
    /**
     * Creates a new instance of Login.
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

        try {
            $stm->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
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
     * Loads the products with the correct style.
     */
    public static function load_products($prods)
    {
        echo '<h2 class="mb-3">' . count($prods) . ' resultados encontrados.</h2>';

        $aws_link = getenv("AWS_LINK");

        foreach ($prods as $prod) :
            $img_bw = $prod['inventory'] == 0 ? 'bw' : '';
            $btn_disabled = $prod['inventory'] == 0 ? 'disabled' : '';  ?>

            <div class="prod">
                <img class="<?= $img_bw ?>" src="<?= $aws_link . $prod['image'] ?>" />
                <p class="text-muted"><?= $prod['brand'] ?>
                <p>
                <p class="fw-bold"><?= mb_strimwidth($prod['model'], 0, 16, '...') ?></p>
                <p class="fs-5 mt-3">R$<?= number_format($prod['price'], 2, ',', '.') ?></p>
                <div class="d-grid gap-2">
                    <button type="button" <?= $btn_disabled ?> class="btn btn-lg btn-primary">
                        <span class="bi bi-bag-check" role="img" aria-label="bag-icon"></span>
                        Comprar
                    </button>
                    <button type="button" class="btn btn-lg btn-outline-secondary">
                        <span class="bi bi-info-circle" role="img" aria-label="info-icon"></span>
                        Detalhes
                    </button>
                </div>
            </div>

        <?php endforeach;
    }
}
