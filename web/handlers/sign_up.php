<?php
require_once __DIR__ . '/../models/User.php';


try {
    $user = new User(
        0,
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['cidade'],
        $_POST['endereco'],
        $_POST['num_endereco'],
        $_POST['cep']
    );

    $user->insert();
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062)
        header('Location: ../controllers/sign_up.php?e=1');
} catch (InvalidArgumentException $e) {
    header('Location: ../controllers/sign_up.php?e=2');
}

header('Location: ../controllers/login.php');
