<div class="container-fluid">
    <div id="products" class="line mb-3">
        <?php
        require_once __DIR__ . '/../models/Database.php';

        $prods = (new Database())->get_products();
        $aws_link = getenv("AWS_LINK");

        foreach ($prods as $prod) {
            echo
            '<div class="prod">
                <img style="border: 2px solid #e5e5e5; padding: 0.5em; width: 300px; height: 300px; margin:auto; display: block; margin-bottom: 1em; object-fit: cover;" src="' . $aws_link . $prod['image'] . '"/>
                <h2>' . $prod['model'] . '</h2>
                <p>' . $prod['category'] . '</p>
                <h3>Marca: ' . $prod['brand'] . '</h3>
                <h4>R$' . number_format($prod['price'], 2, ',', '.') . '</h4>
            </div>';
        }
        ?>
    </div>
</div>