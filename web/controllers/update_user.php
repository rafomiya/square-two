<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();

$child_view = 'update_user.php';
$page_title = 'Atualizar dados';
Utils::render_view($child_view, $page_title);
