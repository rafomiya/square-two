<?php
session_start();

if ($_SESSION['level_user'] != 1)
    header('location: index.php');

$child_view = 'admin.php';
$page_title = 'Administração';

require_once __DIR__ . '/../layout_beheaded.php';
