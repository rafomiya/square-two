<?php
require_once __DIR__ . '/models/Login.php';
require_once __DIR__ . '/models/User.php';

$login = new Login(
    $_POST['email'],
    $_POST['senha']
);

$id = $login->validate();

if ($id) {
    session_start();
    User::set_session($id);
    echo '<script>document.location = "controllers/"</script>';
} else {
    echo '<script>document.location = "controllers/login.php?e=1";</script>';
}
