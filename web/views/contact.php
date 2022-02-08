<?php
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_unlogged_user();
?>
<form class="mx-4 py-5 pb-5 mb-5 form-borders" action="../handlers/contact.php" method="post">
    <h1>Contato</h1>
    <h3 class="mt-3">Tem alguma pergunta, sugestão ou reclamação?</h3>

    <p>Não hesite em nos contatar!</p>

    <div class="form-group row mt-3">
        <label for="subject" class="text-lg-end col-sm col-form-label">Assunto</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" required name="subject" id="subject" placeholder="Assunto">
        </div>
    </div>

    <div class="form-group row my-3">
        <label for="message" class="text-lg-end col-sm col-form-label">Mensagem</label>
        <div class="col-sm-9">
            <textarea type="text" class="form-control" required name="message" id="message" placeholder="Mensagem"></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-sm btn-success float-end d-block">
        <span class="bi bi-check">Enviar</span>
    </button>
</form>