<div class="container-fluid">
    <div id="products" class="line mb-3 mt-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';


        $search = $_GET['search'] ?? '';

        if ($search == '')
            $prods = Product::get_products();

        else
            $prods = Product::get_search($search);

        Product::load_products($prods);
        ?>
    </div>
</div>