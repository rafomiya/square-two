<?php
$views = array(
    "get_products" => "SELECT id_prod as `id`, name_cat as `category`, name_brand as `brand`, model_prod as `model`, preco_prod as `price`, descr_prod as `description` from product inner join brand on product.id_brand = brand.id_brand inner join category on product.id_category = category.id_cat;"
);
