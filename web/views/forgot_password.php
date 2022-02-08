<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="icon" href="../images/favicon.ico">

    <?php require_once __DIR__ . '/../imports.html' ?>
</head>

<body id="login-body">
    <?php include_once 'navbar.php'; ?>

    <?php
    $error_messages = array(
        1 => 'E-mail não encontrado.',
        2 => 'Algo deu errado. Tente novamente mais tarde.'
    );
    ?>

    <div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    <?= $error_messages[$_GET['e']] ?>
                </div>
            </div>
        </div>
    </div>

    <form id="login" class="p-5" action="../handlers/forgot_password.php" method="post">
        <h2>Recuperação de senha</h2>
        <div class="form-group row mt-3 mb-4">
            <label for="email" class="text-lg-end col-sm col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" required placeholder="Digite o e-mail" name="email">
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success float-end d-block">
            <span class="bi bi-check">Continuar</span>
        </button>
    </form>

    <?php if ($_GET['e']) : ?>

        <script>
            const toast = new bootstrap.Toast(document.getElementById('toast-error'));
            toast.show();
        </script>

    <?php endif; ?>

</body>