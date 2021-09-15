<div class="container-fluid">
    <div id="products" class="line mb-3 mt-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';

        $cat = $_GET['c'] ?? "2";

        $prods = Product::get_category_products($cat);
        Product::load_products($prods);
        ?>
    </div>
</div>