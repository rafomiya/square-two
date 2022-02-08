<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

$page_title = 'Lançamentos';
$child_view = 'new.php';
Utils::render_view($child_view, $page_title, 'layout_products.php');
