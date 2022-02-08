<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

$page_title = 'Detalhes do produto';
$child_view = 'details.php';
Utils::render_view($child_view, $page_title);
