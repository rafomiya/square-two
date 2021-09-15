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
    // mensagem de sucesso
} catch (Exception $e) {
    //mensagem de erro
}
