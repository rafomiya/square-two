<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();

$child_view = 'contact.php';
$page_title = 'Contato';
Utils::render_view($child_view, $page_title);
