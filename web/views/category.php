<div class="container-fluid">
    <div id="products" class="line mb-3 mt-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';


        $id_category = $_GET['c'] ?? 2;
        $prods = Product::get_category_products($id_category);
        Product::load_products($prods);
        ?>
    </div>
</div>