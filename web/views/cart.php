<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Utils.php';


Utils::handle_unlogged_user();

if (isset($_GET['p']))
    echo '<script>document.location = "../controllers/cart.php";</script>';

$ids_prod = [];
if (isset($_SESSION['cart']))
    foreach ($_SESSION['cart'] as $id_prod => $quantity)
        $ids_prod[] = $id_prod;
else
    $ids_prod = [];

$total = 0;
?>
<div class="container pt-3">
    <h1>Carrinho de compras</h1>
    <div class="row">

        <?php if ($ids_prod == []) : ?>

            <div class="col-12">
                <p class="text-center mt-5 text-muted fs-4">Não há produtos no carrinho.</p>
            </div>

        <?php else : ?>

            <?php foreach (Product::get_by_ids($ids_prod) as $product) : ?>

                <div class="col-12 gy-3 shadow">
                    <div class="row p-2 d-flex">
                        <img src="<?= getenv('AWS_LINK') . $product->image ?>" style="width: auto; height: 100px; object-fit: cover;" class="border border-3 img-fluid col-2">
                        <p class="col-2 my-auto text-center">
                            <strong>Modelo:</strong><br /><?= $product->brand->name . ' ' . $product->model ?>
                        </p>
                        <p class="col-2 my-auto text-center">
                            <strong>Preço unitário:</strong><br />R$<?= number_format($product->price, 2, ',', '.') ?>
                        </p>
                        <p class="col-2 my-auto text-center">
                            <!-- <input type="number" value=" -->
                            <strong>Quantidade:</strong><br /><?= $_SESSION['cart'][$product->id] ?>
                            <!-- " min="1" max="<?= $product->inventory ?>" /> -->
                        </p>
                        <p class="col-3 my-auto text-center">
                            <strong>Preço:</strong><br />R$<?= number_format($product->price * $_SESSION['cart'][$product->id], 2, ',', '.') ?>
                        </p>
                        <a href="../handlers/delete_cart.php?p=<?= $product->id ?>" class="btn btn-sm btn-outline-danger col-1 m-auto">
                            <span class="bi bi-x fs-1 my-auto"></span>
                        </a>
                    </div>
                </div>

                <?php $total += $product->price * $_SESSION['cart'][$product->id] ?>

            <?php endforeach; ?>

            <div class="col-12">
                <p class="text-end mt-5 text-muted fs-4">Total: R$<?= number_format($total, 2, ',', '.') ?></p>
            </div>

            <a href="../controllers/index.php" class="btn btn-lg btn-primary bi bi-arrow-left-circle mt-3 col-12 col-sm-4">
                Continuar comprando
            </a>
            <a id="confirm-purchase" href="../controllers/add_purchase.php" class="btn btn-lg btn-success bi bi-bag-check mt-3 col-12 col-sm-4 ms-sm-auto">
                Finalizar compra
            </a>

        <?php endif; ?>

    </div>
</div>
<script>
    // defining the input number
    $('input[type="number"]').inputSpinner();
</script>