<?php
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Utils.php';


$orders =
    Utils::is_admin() ?
    Purchase::get_all_purchases() :
    Purchase::get_purchases_by_user($_SESSION['id_user']);
?>
<div class="container my-5">
    <h1>Seus pedidos</h1>

    <?php if (count($orders) == 0) : ?>

        <div class="col-12">
            <p class="text-center mt-5 text-muted fs-4">Não há produtos no carrinho.</p>
        </div>

    <?php else : ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Data</th>
                    <th>Valor total</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($orders as $order) : ?>

                    <tr>
                        <td><?= $order['id_purchase'] ?></td>
                        <td><?= date_format(date_create($order['date_purchase']), 'd/m/Y') ?></td>
                        <td>
                            R$<?= number_format($order['total'], 2, ',', '.')  ?>
                            <a href="order_details.php?p=<?= $order['id_purchase'] ?>" class="btn btn-primary float-end">
                                Detalhes
                            </a>
                        </td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

    <?php endif; ?>

</div>