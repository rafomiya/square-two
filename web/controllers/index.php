<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

$page_title = 'Início';
Utils::render_view($child_view, $page_title, 'layout_products.php');
