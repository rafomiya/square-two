<?php
require_once __DIR__ . '/../models/Purchase.php';


session_start();

Purchase::remove_from_cart($_GET['p']);

header('Location: ../controllers/cart.php');
