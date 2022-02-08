<?php
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Utils.php';

$order = $data['order'];

Utils::handle_unlogged_user($order['id_user']);

$total = $order['total'];

$items = Purchase::get_purchase_items($order['id_purchase']);
?>
<div class="container my-5">
    <h1>Detalhes do pedido</h1>
    <h3>Código do pedido: <?= $order['id_purchase'] ?></h3>
    <table class="table table-striped table-bordered mt-3">
        <thead>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço unitário</th>
                <th>Total do item</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($items as $item) : ?>

                <tr>
                    <td><?= $item['model'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>R$<?= number_format($item['price'], 2, ',', '.') ?></td>
                    <td>R$<?= number_format($item['quantity'] * $item['price'], 2, ',', '.') ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

    <h3 class="float-end">Total do pedido: R$<?= number_format($total, 2, ',', '.')  ?></h3>
</div>