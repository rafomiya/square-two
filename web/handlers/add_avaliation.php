<?php
require_once __DIR__ . '/../models/Avaliation.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Utils.php';

session_start();

Utils::handle_unlogged_user();

$comment = $_POST['comment'];
$score = $_POST['score'];
$id_prod = (int) $_GET['p'];

$avaliation = new Avaliation(
    0,
    (int) $score,
    (string) $comment,
    new User(
        (int) $_SESSION['id_user'],
        null,
        null,
        null,
        null,
        null,
        null,
        '00000000'
    ),
    $id_prod,
    null
);

try {
    $avaliation->insert();
    header('Location: ../controllers/details.php?p=' . $id_prod);
} catch (Exception $e) {
    if ($e->errorInfo[1] == 1062)
        header('Location: ../controllers/details.php?p=' . $id_prod . '&e=1');
    else
        echo $e->getMessage();
}
