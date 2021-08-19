<?php
include "conn.php";

$sql = "SELECT name_cat, name_brand, model_prod, preco_prod, descr_prod from product inner join brand on product.id_brand = brand.id_brand inner join category on product.id_category = category.id_cat;";

$stm = $pdo->prepare($sql);
$stm->execute();

$rows = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja</title>
    
    <!-- jQuery livraria -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- JavaScript compilado-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- External CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-fluid">
        <?php include "navbar.html"; ?>
        <?php include "header.html"; ?>

        <?php include "products.php" ?>
        
        <?php include "footer.html" ?>
    </div>
</body>
</html>
