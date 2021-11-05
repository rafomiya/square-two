<?php

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Brand.php';
require_once __DIR__ . '/Category.php';

class Product
{
    /**
     * Creates a new instance of Product
     */
    public function __construct(
        int $id,
        string $model,
        Brand $brand,
        float $price,
        string $description,
        string $image,
        Category $category,
        bool $is_new,
        int $inventory
    ) {
        $this->id = $id;
        $this->model = (string) $model;
        $this->brand = $brand;
        $this->price = (float) $price;
        $this->description = (string) $description;
        $this->image = (string) $image;
        $this->category = $category;
        $this->is_new = (bool) $is_new;
        $this->inventory = (int) $inventory;
    }

    /**
     * Gets a PDO connection to the database.
     */
    private static function get_conn(): PDO
    {
        return (new Database())->pdo;
    }

    /**
     * Gets the array with all the products.
     */
    public static function get_products(): array
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_details;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        $products = array();

        foreach ($stm->fetchAll() as $row)
            $products[] =
                new Product(
                    $row['id'],
                    $row['model'],
                    new Brand(
                        $row['id_brand'],
                        $row['brand']
                    ),
                    $row['price'],
                    $row['description'],
                    $row['image'],
                    new Category(
                        $row['id_category'],
                        $row['category']
                    ),
                    $row['is_new'],
                    $row['inventory']
                );

        return $products;
    }

    /**
     * Gets the array with the new products.
     */
    public static function get_new_products(): array
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_details where is_new = 1;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        $products = array();

        foreach ($stm->fetchAll() as $row)
            $products[] =
                new Product(
                    $row['id'],
                    $row['model'],
                    new Brand(
                        $row['id_brand'],
                        $row['brand']
                    ),
                    $row['price'],
                    $row['description'],
                    $row['image'],
                    new Category(
                        $row['id_category'],
                        $row['category']
                    ),
                    $row['is_new'],
                    $row['inventory']
                );

        return $products;
    }

    /**
     * Gets all the products of certain category.
     */
    public static function get_category_products(int $id_cat): array
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_details where id_category = :id_cat;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_cat', $id_cat);
        $stm->execute();

        $products = array();

        foreach ($stm->fetchAll() as $row)
            $products[] =
                new Product(
                    $row['id'],
                    $row['model'],
                    new Brand(
                        $row['id_brand'],
                        $row['brand']
                    ),
                    $row['price'],
                    $row['description'],
                    $row['image'],
                    new Category(
                        $row['id_category'],
                        $row['category']
                    ),
                    $row['is_new'],
                    $row['inventory']
                );

        return $products;
    }

    /**
     * Gets all the products of certain brand.
     */
    public static function get_brand_products(int $id_brand): array
    {
        $conn = Product::get_conn();

        $sql = 'SELECT * from list_details where id_brand = :id_brand;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id_brand', $id_brand);
        $stm->execute();

        $products = array();

        foreach ($stm->fetchAll() as $row)
            $products[] =
                new Product(
                    $row['id'],
                    $row['model'],
                    new Brand(
                        $row['id_brand'],
                        $row['brand']
                    ),
                    $row['price'],
                    $row['description'],
                    $row['image'],
                    new Category(
                        $row['id_category'],
                        $row['category']
                    ),
                    $row['is_new'],
                    $row['inventory']
                );

        return $products;
    }

    /**
     * Get a single product.
     */
    public static function get_product($id): Product
    {
        $conn = Product::get_conn();
        $sql = 'SELECT * from list_details where id = :id;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();

        $row = $stm->fetchAll()[0];

        return new Product(
            $row['id'],
            $row['model'],
            new Brand(
                $row['id_brand'],
                $row['brand']
            ),
            $row['price'],
            $row['description'],
            $row['image'],
            new Category(
                $row['id_category'],
                $row['category']
            ),
            $row['is_new'],
            $row['inventory']
        );
    }

    public static function get_search($search): array
    {
        $conn = Product::get_conn();
        $sql =
            "SELECT * from list_details
                where
                    model like :search or
                    brand like :search or
                    category like :search;";

        $stm = $conn->prepare($sql);
        $stm->bindValue(':search', '%' . $search . '%');
        $stm->execute();

        $products = array();

        foreach ($stm->fetchAll() as $row)
            $products[] =
                new Product(
                    $row['id'],
                    $row['model'],
                    new Brand(
                        $row['id_brand'],
                        $row['brand']
                    ),
                    $row['price'],
                    $row['description'],
                    $row['image'],
                    new Category(
                        $row['id_category'],
                        $row['category']
                    ),
                    $row['is_new'],
                    $row['inventory']
                );

        return $products;
    }

    /**
     * Loads the products with the correct style.
     */
    public static function load_products($prods): void
    { ?>
        <h2 class="mb-3">
            <?= count($prods) ?> resultados encontrados
        </h2>

        <?php
        $aws_link = getenv('AWS_LINK');

        foreach ($prods as $prod) :
            $img_bw = $prod->inventory == 0 ? 'bw' : '';
            $btn_disabled = $prod->inventory == 0 ? 'disabled' : ''; ?>

            <div class="prod">
                <img class="<?= $img_bw ?>" src="<?= $aws_link . $prod->image ?>" />
                <p class="text-muted"><?= $prod->brand->name ?></p>
                <h4 class="fw-bold"><?= mb_strimwidth($prod->model, 0, 16, '...') ?></h4>
                <p class="fs-5 mt-3">R$<?= number_format($prod->price, 2, ',', '.') ?></p>
                <div class="d-grid gap-2">
                    <button type="button" <?= $btn_disabled ?> class="btn btn-lg btn-primary">
                        <span class="bi bi-bag-check" role="img" aria-label="bag-icon"></span>
                        Comprar
                    </button>
                    <a href="../controllers/details.php?p=<?= $prod->id ?>" type="button" class="btn btn-lg btn-outline-secondary">
                        <span class="bi bi-info-circle" role="img" aria-label="info-icon"></span>
                        Detalhes
                    </a>
                </div>
            </div>
<?php endforeach;
    }

    public static function count()
    {
        $conn = Product::get_conn();
        $sql = 'SELECT count(*) from product;';

        $stm = $conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll()[0][0];
    }

    public function insert()
    {
        $conn = Product::get_conn();
        $sql =
            'INSERT INTO product
            (
                model_prod,
                id_brand,
                price_prod,
                descr_prod,
                image_prod,
                id_cat,
                is_new,
                inventory
            ) values (
                :model,
                :id_brand,
                :price,
                :descr_prod,
                :image_prod,
                :id_category,
                :is_new,
                :inventory
            );';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':model', $this->model);
        $stm->bindValue(':id_brand', $this->brand->id);
        $stm->bindValue(':price', $this->price);
        $stm->bindValue(':descr_prod', $this->description);
        $stm->bindValue(':image_prod', $this->image);
        $stm->bindValue(':id_category', $this->category->id);
        $stm->bindValue(':is_new', $this->is_new);
        $stm->bindValue(':inventory', $this->inventory);
        $stm->execute();
    }

    public function update()
    {
        $conn = Product::get_conn();
        $sql =
            'UPDATE product
            SET
                model_prod = :model,
                id_brand = :id_brand,
                price_prod = :price,
                descr_prod = :descr_prod,
                image_prod = :image_prod,
                id_cat = :id_category,
                is_new = :is_new,
                inventory = :inventory
            WHERE id_prod = :id;';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':model', $this->model);
        $stm->bindValue(':id_brand', $this->brand->id);
        $stm->bindValue(':price', $this->price);
        $stm->bindValue(':descr_prod', $this->description);
        $stm->bindValue(':image_prod', $this->image);
        $stm->bindValue(':id_category', $this->category->id);
        $stm->bindValue(':is_new', $this->is_new);
        $stm->bindValue(':inventory', $this->inventory);
        $stm->bindValue(':id', $this->id);
        $stm->execute();
    }

    public static function delete($id)
    {
        $conn = Product::get_conn();
        $sql = 'DELETE FROM product where id_prod = :id';

        $stm = $conn->prepare($sql);
        $stm->bindValue(':id', $id);
        $stm->execute();
    }
}
