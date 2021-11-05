<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/models/Product.php';


use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// insertion on s3 bucket
$image_name = $_FILES['image']['name'];
$extension = end(explode('.', $image_name));

$filename = str_replace('/', '', password_hash($image_name, PASSWORD_BCRYPT, array('cost' => 4))) . '.' . $extension;

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1',
    'credentials' => [
        'key' => getenv('AWS_KEY_ID'),
        'secret' => getenv('AWS_SECRET_KEY')
    ]
]);

try {
    $result = $s3->putObject([
        'Bucket' => getenv('AWS_S3_BUCKET'),
        'Key'    => $filename,
        'Body'   => 'Hello, world!',
        'SourceFile' => $_FILES['image']['tmp_name']
    ]);
}
// erro
catch (S3Exception $e) {
    header('Location: controllers/add_product.php?e=1');
}

// insertion on the database
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
}
// erro
catch (Exception $e) {
    header('Location: controllers/add_product.php?e=1');
}

// execução sem erros
header('Location: controllers/add_product.php?e=2');
