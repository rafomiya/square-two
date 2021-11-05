<?php
if ($_SESSION['level_user'] != 1)
    header('Location: index.php');
?>
<div class="w-25 mx-auto d-flex flex-column gap-3 mt-5">
    <a href="add_product.php" type="button" class="btn btn-secondary btn-lg d-block">
        Adicionar novo um produto
    </a>

    <a href="list.php" type="button" class="btn btn-secondary btn-lg d-block">
        Alterar ou excluir um produto
    </a>

    <a href="#" type="button" class="btn btn-secondary btn-lg d-block">
        Gerenciar vendas
    </a>
</div>