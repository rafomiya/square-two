<div class="container-fluid">
    <div id="products" class="line mb-3">
        <?php
        require_once __DIR__ . '/../models/Database.php';

        $prods = (new Database())->get_products();

        foreach ($prods as $prod) {
            echo '<div class="prod">';
            echo '<img class="img-responsive" src="./images/gts3m.jpg" style="width: 100%;"/>';
            echo '<h2>' . $prod['model_prod'] . '</h2>';
            echo '<h3>Marca: ' . $prod['name_brand'] . '</h3>';
            echo '<h4>R$' . $prod['preco_prod'] . '</h4>';
            echo '<p>' . $prod['name_cat'] . '</p>';
            echo '<p>' . $prod['descr_prod'] . '</p>';
            echo '</div>';
        }
        ?>
    </div>
</div>