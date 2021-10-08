<?php
require_once __DIR__ . '/models/User.php';


try {
    $user = new User(
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['cidade'],
        $_POST['endereco'],
        $_POST['num_endereco'],
        $_POST['cep']
    );

    $user->insert_user();
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062)
        echo '<script>document.location = "controllers/sign_up.php?e=1";</script>';
} catch (InvalidArgumentException $e) {
    echo '<script>document.location = "controllers/sign_up.php?e=2";</script>';
}

echo '<script>document.location = "controllers/login.php"</script>';