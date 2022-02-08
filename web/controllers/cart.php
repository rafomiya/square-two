<?php
require_once __DIR__ . '/../models/Utils.php';
require_once __DIR__ . '/../models/Product.php';

session_start();

Utils::handle_unlogged_user();

$id_product = $_GET['p'] ?? 0;
$quantity = $_POST['quantity'] ?? 1;

if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = array();

if ($id_product !== 0)
    if (isset($_SESSION['cart'][$id_product]))
        $_SESSION['cart'][$id_product] += $quantity;
    else
        $_SESSION['cart'][$id_product] = $quantity;

$child_view = 'cart.php';
$page_title = 'Carrinho';
Utils::render_view($child_view, $page_title);
