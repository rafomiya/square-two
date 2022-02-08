<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro</title>
    <?php require_once __DIR__ . '/../imports.html';  ?>
</head>

<body class="error-body">
    <?php include 'navbar.php'; ?>

    <span class="bi bi-emoji-neutral neutral-face"></span>
    <div class="p-5 error-message">
        <h1 class="display-1 my-5 text-light">Ocorreu um <strong class="text-danger">erro</strong>.</h1>
        <a type="a" class="btn btn-outline-danger btn-lg float-end" href="./../controllers/index.php">Voltar ao início</a>
    </div>
</body>

</html>