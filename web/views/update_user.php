<?php
require_once __DIR__ . '/../models/User.php';


$user = User::get_user($_SESSION['id_user']);
?>
<script>
    $(document).ready(() => {
        $('#cep').mask('00000-000');
    });
</script>
<form class="mx-4 py-5 pb-5 mb-5 form-borders" action="../handlers/update_user.php" method="post">
    <h1>Atualizar dados</h1>

    <?php
    $error_messages = array(
        1 => 'E-mail já cadastrado.',
        2 => 'CEP inválido.'
    );
    ?>

    <div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    <?= $error_messages[$_GET['e']] ?>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="nome" class="text-lg-end col-sm col-form-label">Nome</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" required name="nome" id="nome" placeholder="<?= $user->nome ?>">
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="email" class="text-lg-end col-sm col-form-label">E-mail</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" required name="email" id="email" placeholder="<?= $user->email ?>">
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="senha" class="text-lg-end col-sm col-form-label">Senha</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" required name="senha" id="senha">
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="endereco" class="text-lg-end col-sm col-form-label">Endereço</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" required name="endereco" id="endereco" placeholder="<?= $user->endereco ?>">
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="num_endereco" class="text-lg-end col-sm col-form-label">Número</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" required name="num_endereco" id="num_endereco" placeholder="<?= $user->num_endereco ?>">
        </div>
    </div>

    <div class="form-group row mt-3">
        <label for="cidade" class="text-lg-end col-sm col-form-label">Cidade</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" required name="cidade" id="cidade" placeholder="<?= $user->cidade ?>">
        </div>
    </div>

    <div class="form-group row my-3">
        <label for="cep" class="text-lg-end col-sm col-form-label">CEP</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" minlength="9" required name="cep" id="cep" placeholder="<?= substr($user->cep, 0, 5) . '-' . substr($user->cep, 5, 3) ?>">
        </div>
    </div>

    <button type="submit" class="btn btn-sm btn-success float-end d-block">
        <span class="bi bi-check">Atualizar</span>
    </button>

    <?php if ($_GET['e']) : ?>

        <script>
            const toast = new bootstrap.Toast(document.getElementById("toast-error"));
            toast.show();
        </script>

    <?php endif; ?>
</form>