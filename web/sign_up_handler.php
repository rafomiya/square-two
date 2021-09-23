<?php
require_once __DIR__ . '/models/User.php';

$user = new User(
    $_POST['nome'],
    $_POST['email'],
    $_POST['senha'],
    $_POST['endereco'],
    $_POST['cidade'],
    $_POST['cep']
);

try {
    $user->insert_user();
    echo 'Sucesso';
} catch (Exception $e) {
    var_dump($e);
}

var_dump($user);

# Considerar criar uma tabela de login, e separá-la da tabela de usuário. Ou pensar em outras formas de armazenar e validar as informações de login.