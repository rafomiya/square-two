<?php
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();

try {
    $user = new User(
        $_SESSION['id_user'],
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['cidade'],
        $_POST['endereco'],
        $_POST['num_endereco'],
        $_POST['cep']
    );

    User::update($user);
} catch (PDOException $e) {
    if ($e->errorInfo[1] == 1062)
        header('Location: ../controllers/update_user.php?e=1');
} catch (InvalidArgumentException $e) {
    header('Location: ../controllers/update_user.php?e=2');
}

header('Location: ../controllers/user_area.php?e=1');
