<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_not_admin();
?>
<div class="container-fluid d-flex flex-column h-100" style="position: relative; top: 1.5em;">
    <div class="row gy-2">
        <div class="col-12 col-sm-6">
            <a href="../controllers/add_product.php" class="p-3 w-100 btn btn-lg btn-light border border-5">
                <span class="bi bi-file-earmark-plus display-1 d-block"></span>
                Adicionar novo um produto
            </a>
        </div>
        <div class="col-12 col-sm-6">
            <a href="../controllers/list.php" class="p-3 w-100 btn btn-lg btn-light border border-5">
                <span class="bi bi-pencil-square display-1 d-block"></span>
                Alterar ou excluir um produto
            </a>
        </div>
        <div class="col-12 col-sm-6">
            <a href="../controllers/show_orders.php" class="p-3 w-100 btn btn-lg btn-light border border-5">
                <span class="bi bi-card-checklist display-1 d-block"></span>
                Gerenciar vendas
            </a>
        </div>
    </div>
</div>