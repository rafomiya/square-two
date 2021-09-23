<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?></title>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- JavaScript bundle-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <!-- External CSS -->
    <link type="text/css" rel="stylesheet" href="./../style.css" />
</head>

<body id="signin-body">
    <?php include 'navbar.php'; ?>

    <form id="signin" class="p-5 my-5" action="./../sign_up_handler.php" method="post">
        <h2>Cadastro</h2>
        <div class="form-group row mt-3">
            <label for="nome" class="text-lg-end col-sm col-form-label">Nome</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="Digite o nome" name="nome">
            </div>
        </div>
        <div class="form-group row mt-2 mb-4">
            <label for="email" class="text-lg-end col-sm col-form-label">E-mail</label>
            <div class="col-sm-9">
                <input type="email" class="form-control" required placeholder="Insira seu e-mail" name="email">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="senha" class="text-lg-end col-sm col-form-label">Senha</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" required placeholder="Crie uma senha" name="senha">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="endereco" class="text-lg-end col-sm col-form-label">Endereço</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="Digite o endereço" name="endereco">
            </div>
        </div>
        <div class="form-group row mt-3">
            <label for="cidade" class="text-lg-end col-sm col-form-label">Cidade</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="Digite a cidade" name="cidade">
            </div>
        </div>
        <div class="form-group row mt-3 mb-3">
            <label for="cep" class="text-lg-end col-sm col-form-label">CEP</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" required placeholder="Digite o CEP" name="cep">
            </div>
        </div>
        <button type="submit" class="btn btn-sm btn-success float-end d-block">
            <span class="bi bi-check">Entrar</span>
        </button>
    </form>
</body>

</html>