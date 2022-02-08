<?php
require_once __DIR__ . '/../models/Purchase.php';
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user($order['id_user']);

$order = Purchase::get_purchase_by_id($_GET['p']);

$child_view = 'order_details.php';
$page_title = 'Detalhes do pedido';
Utils::render_view($child_view, $page_title, 'layout_beheaded.php', array('order' => $order));
