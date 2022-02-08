<?php
session_start();

$child_view = 'search.php';
$page_title = 'Pesquisa';
Utils::render_view($child_view, $page_title, 'layout_products.php');
