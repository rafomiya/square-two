<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="icon" href="../images/favicon.ico">

    <?php require_once __DIR__ . '/imports.html'; ?>
</head>

<body>
    <?php
    $child_view = $child_view ?? 'index.php';

    include __DIR__ . '/views/navbar.php';
    include __DIR__ . '/views/header.html';

    include __DIR__ . '/views/' . $child_view;

    include __DIR__ . '/views/footer.html';
    ?>
</body>

</html>