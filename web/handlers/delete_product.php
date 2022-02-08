<?php
require_once __DIR__ . '/../models/Product.php';


$id = $_GET['p'];

Product::delete((int) $id);
header('Location: ../controllers/list.php?e=2');
