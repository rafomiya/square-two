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
    <?php include __DIR__ . '/views/navbar_default.php'; ?>

    <div id="content" class="container-fluid">
        <?php include __DIR__ . '/views/' . $child_view; ?>
    </div>

    <?php include __DIR__ . '/views/footer.html'; ?>

    <script>
        let navbarHeight = $('#navbar-default').outerHeight();
        let footerHeight = $('#footer').outerHeight();
        $('#content').css('min-height', `calc(100vh - ${navbarHeight}px - ${footerHeight}px)    `);
    </script>
</body>

</html>