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

    <div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    Erro! E-mail ou senha incorretos.
                </div>
            </div>
        </div>
    </div>

    <form id="login" class="p-5" action="../handlers/login.php" method="post">
        <h2>Login</h2>
        <div class="form-group row mt-3">
            <label for="email" class="text-lg-end col-sm col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" required placeholder="Digite o e-mail" name="email">
            </div>
        </div>
        <div class="form-group row mt-2 mb-4">
            <label for="senha" class="text-lg-end col-sm col-form-label">Senha</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" required placeholder="Insira sua senha" name="senha">
            </div>
            <a href="forgot_password.php" class="text-muted text-end mt-1">
                Esqueceu a senha?
            </a>
        </div>

        <button type="submit" class="btn btn-sm btn-success float-end d-block">
            <span class="bi bi-check">Entrar</span>
        </button>
        <a href="sign_up.php" class="btn btn-link">
            Ainda não possui cadastro?
        </a>
    </form>

    <?php if ($_GET['e']) : ?>

        <script>
            const toast = new bootstrap.Toast(document.getElementById("toast-error"));
            toast.show();
        </script>

    <?php endif; ?>

</body>

</html>