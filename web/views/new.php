<div class="container-fluid">
    <div id="products" class="line mb-3 mt-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';

        $prods = Product::get_new_products();
        Product::load_products($prods);
        ?>
    </div>
</div>