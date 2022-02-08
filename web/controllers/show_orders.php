<?php

require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();

$child_view = 'show_orders.php';
$page_title = 'Área do usuário';
Utils::render_view($child_view, $page_title);
