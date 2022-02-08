<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

$child_view = 'brand.php';
$page_title = 'Marca';
Utils::render_view($child_view, $page_title, 'layout_products.php');
