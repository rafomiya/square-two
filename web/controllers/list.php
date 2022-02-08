<?php

require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_not_admin();

$child_view = 'list.php';
$page_title = 'Alterar ou excluir produto';
Utils::render_view($child_view, $page_title);
