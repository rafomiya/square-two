<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finalizar compra</title>

    <link rel="icon" href="../images/favicon.ico">

    <?php require_once __DIR__ . '/../imports.html'; ?>
</head>

<body>
    <?php include __DIR__ . '/navbar_default.php'; ?>

    <div id="content" class="container-fluid">
        <div class=" container pt-5">
            <div class="row">
                <div class="col-12">
                    <p class="text-center fs-3">Pedido realizado com sucesso.</p>
                    <p class="text-center text-muted">Código do pedido: <?= $_GET['ticket'] ?? 'Ocorreu um erro' ?>.</p>
                </div>
            </div>

            <a>
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <a href="../index.php" class="btn btn-primary">Voltar para o início</a>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <?php include __DIR__ . '/footer.html'; ?>
    <script>
        let navbarHeight = $('#navbar-default').outerHeight();
        let footerHeight = $('#footer').outerHeight();
        $('#content').css('min-height', `calc(100vh - ${navbarHeight}px - ${footerHeight}px)`);
    </script>
</body>

</html>