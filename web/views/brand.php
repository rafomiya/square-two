<div class="container-fluid">
    <div id="products" class="line mb-3 mt-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';



        $id_brand = (int) $_GET['b'] ?? '0';



        // echo 'a<br><br>a<br><br>a<br><br>a<br><br>a<br><br>a<br><br>a<br><br>a<br><br>a<br><br>';
        
        
        
        $prods = Product::get_brand_products($id_brand);
        
        
        
        Product::load_products($prods);
        
        
        
        ?>
    </div>
</div>