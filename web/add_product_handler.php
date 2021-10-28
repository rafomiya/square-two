<?php

use Aws\S3\S3Client;

require_once __DIR__ . '/../vendor/autoload.php';

$s3 = new Aws\S3\S3Client([
    'region' => 'Brazil',
    'version' => 'latest',
    'credentials' => [
        'key' => getenv('AWS'),
        'secret' => getenv('AWS')
    ]
]);

$result = $s3->putObject([
    'Bucket' => 'square_two',
    'Key' => $_FILES['image']['name'],
    'Body' => '',
    'SourceFile' => $_FILES['image']['tmp_name'] // is this right?
]);

echo $model = $_POST['model'];
echo $category = $_POST['category'];
echo $brand = $_POST['brand'];
echo $price = $_POST['price'];
echo $description = $_POST['description'];
echo $image = $_POST['image'];
echo $is_new = $_POST['is_new'];
echo $inventory = $_POST['inventory'];
