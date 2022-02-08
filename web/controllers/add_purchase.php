<?php
require_once __DIR__ . '/../models/Purchase.php';


session_start();

$id_purchase = Purchase::make_purchase();

// empty the cart
$_SESSION['cart'] = null;
?>
<script>
    document.location = '../views/add_purchase.php?ticket=<?= $id_purchase ?>';
</script>