<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();
?>

<?php
$error_messages = array(
    1 => 'Dados atualizados com sucesso.',
    2 => 'CEP inválido.'
);
?>

<div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
    <div id="toast-error" class="<?= $_GET['e'] == 1 ? 'bg-success' : 'bg-danger' ?> toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex text-center">
            <div class="toast-body text-center text text-white">
                <?= $error_messages[$_GET['e']] ?>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid d-flex flex-column h-100" style="position: relative; top: 1.5em;">
    <div class="row gy-2">
        <div class="col-12 col-sm-6">
            <a href="show_orders.php" class="p-3 w-100 btn btn-lg btn-light border border-5">
                <span class="bi bi-card-checklist display-1 d-block"></span>
                Ver meus pedidos
            </a>
        </div>
        <div class="col-12 col-sm-6">
            <a href="update_user.php" class="p-3 w-100 btn btn-lg btn-light border border-5">
                <span class="bi bi-pencil display-1 d-block"></span>
                Atualizar meus dados
            </a>
        </div>
    </div>
</div>
<?php if ($_GET['e']) : ?>

    <script>
        const toast = new bootstrap.Toast(document.getElementById('toast-error'));
        toast.show();
    </script>

<?php endif; ?>