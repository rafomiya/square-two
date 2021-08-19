<div class="container-fluid">
    <div id="products" class="line mb-3">
    <?php
        // iterando de produto em produto
        foreach ($rows as $row) 
        {
            $modelo = $row['model_prod'];
            $marca = $row['name_brand'];
            $categoria = $row['name_cat'];
            $preco = str_replace(".", ",", $row['preco_prod']);
            $descricao = substr($row['descr_prod'], 0, 50);

            echo '<div class="prod">';
            echo '<img class="img-responsive" src="img/gts3m.jpg" style="width: 100%;"/>';
            echo '<h2>'.$modelo.'</h2>';
            echo '<h3>Marca: '.$marca.'</h3>';
            echo '<h4>R$'.$preco.'</h4>';
            echo '<p>'.$categoria.'</p>';
            echo '<p>'.$descricao.'</p>';
            echo '</div>';
        }
    ?>
    </div>
</div>
