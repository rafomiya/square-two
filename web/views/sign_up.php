<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <link rel="icon" href="../images/favicon.ico">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- jQuery masks -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- JavaScript bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="./../style.css" />

    <script>
        $(document).ready(function() {
            $("#cep").mask("00000-000");
        });
    </script>
</head>

<body id="signin-body">
    <?php include 'navbar.php'; ?>

    <?php
    $error_messages = array(
        1 => 'E-mail já cadastrado',
        2 => 'CEP inválido'
    );
    ?>

    <div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    Erro! <?= $error_messages[$_GET['e']] ?>.
                </div>
            </div>
        </div>
    </div>

    <form id="signin" class="p-5 my-5" action="./../sign_up_handler.php" method="post">
        <h2>Cadastro</h2>
        <div class="form-group row mt-3">
            <label for="nome" class="text-lg-end col-sm col-form-label">Nome</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="João da Silva" name="nome" id="nome">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="email" class="text-lg-end col-sm col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" required placeholder="joaosilva@mail.com" name="email" id="email">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="senha" class="text-lg-end col-sm col-form-label">Senha</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" required placeholder="12345" name="senha" id="senha">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="endereco" class="text-lg-end col-sm col-form-label">Endereço</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="Av. das Nações Unidas" name="endereco" id="endereco">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="num_endereco" class="text-lg-end col-sm col-form-label">Número</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="94B" name="num_endereco" id="num_endereco">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="cidade" class="text-lg-end col-sm col-form-label">Cidade</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="São Paulo" name="cidade" id="cidade">
            </div>
        </div>
        <div class="form-group row mt-3 mb-3">
            <label for="cep" class="text-lg-end col-sm col-form-label">CEP</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" minlength="9" required placeholder="00000-000" name="cep" id="cep">
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success float-end d-block">
            <span class="bi bi-check">Cadastrar</span>
        </button>
        <a href="login.php" class="btn btn-sm btn-link">
            Já possui cadastro?
        </a>
    </form>

    <?php if ($_GET['e']) : ?>
        <script>
            const emailToast = new bootstrap.Toast(document.getElementById("toast-error"));
            emailToast.show();
        </script>
    <?php endif; ?>
</body>

</html>