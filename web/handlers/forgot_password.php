<?php
require_once __DIR__ . '/../models/User.php';


$email = $_POST['email'];

if (!User::email_exists($email)) {
    // echo 'Email does not exist';
    header('Location: ../controllers/forgot_password.php?e=1');
} elseif (!User::reset_password($email)) {
    // echo 'Error resetting password';
    header('Location: ../controllers/forgot_password.php?e=2');
}
