<div class="container-fluid">
    <div id="products" class="line mb-3">
        <?php
        require_once __DIR__ . '/../models/Product.php';

        $count = 1;
        while ($count != 0) {
            try {
                $prod = new Product($count);

                echo '<div class="prod">';
                echo '<img class="img-responsive" src="./images/gts3m.jpg" style="width: 100%;"/>';
                echo '<h2>' . $prod->getmodel() . '</h2>';
                echo '<h3>Marca: ' . $prod->getbrand() . '</h3>';
                echo '<h4>R$' . $prod->getprice() . '</h4>';
                echo '<p>' . $prod->getcategory() . '</p>';
                echo '<p>' . $prod->getdescription() . '</p>';
                echo '</div>';

                $count++;
            } catch (\Throwable $th) {
                $count = 0;
            }
        }
        ?>
    </div>
</div>