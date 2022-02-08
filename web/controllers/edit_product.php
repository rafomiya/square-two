<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_not_admin();

$page_title = 'Editar produto';
$child_view = 'edit_product.php';
Utils::render_view($child_view, $page_title);
