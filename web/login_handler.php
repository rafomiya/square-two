<?php
require_once __DIR__ . '/models/User.php';

$user = new User($_POST['email'], $_POST['senha']);

if ($user->validate_login()) {
    // mensagem de sucesso
} else {
    // mensagem de erro
}
