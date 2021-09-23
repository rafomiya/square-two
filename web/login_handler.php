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
    User::get_username($id);
    $_SESSION['id_user'] = $id;
    echo '<script>document.location = "controllers/index.php"</script>';
} else {
    echo '<script>document.location = "views/error.php"</script>';
}
