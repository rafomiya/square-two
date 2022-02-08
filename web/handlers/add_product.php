<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Utils.php';


use Aws\S3\Exception\S3Exception;

$image_name = $_FILES['image']['name'];
$extension = end(explode('.', $image_name));

$filename = str_replace('/', '', password_hash($image_name, PASSWORD_BCRYPT, array('cost' => 4))) . '.' . $extension;

try {
    $result = Utils::upload_to_bucket($filename, $_FILES['image']['tmp_name']);
} catch (S3Exception $e) {
    header('Location: ../controllers/add_product.php?e=1');
}

try {
    $product = new Product(
        0,
        $_POST['model'],
        new Brand(
            $_POST['brand'],
            ''
        ),
        $_POST['price'],
        $_POST['description'],
        $filename,
        new Category(
            $_POST['category'],
            ''
        ),
        $_POST['is_new'],
        $_POST['inventory']
    );

    $product->insert();
} catch (Exception $e) {
    header('Location: ../controllers/add_product.php?e=1');
}

header('Location: ../controllers/add_product.php?e=2');
