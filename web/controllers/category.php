<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

$child_view = 'category.php';
$page_title = 'Categorias';
Utils::render_view($child_view, $page_title, 'layout_products.php');
