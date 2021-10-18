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
    include __DIR__ . '/views/navbar_default.php';

    include __DIR__ . '/views/' . $child_view;

    $footer = $footer ?? 'fixed_footer.php';

    include __DIR__ . '/views/' . $footer;
    ?>
</body>

</html>