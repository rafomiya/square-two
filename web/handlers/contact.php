<?php
require_once __DIR__ . '/../models/User.php';


$subject = $_POST['subject'];
$message = $_POST['message'];

User::send_email_to_admins($subject, $message);

header('Location: ../controllers/index.php?s=1');
