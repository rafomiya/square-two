<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Utils.php';


session_start();

Utils::handle_not_admin();
?>
<div class="container my-5">
    <!-- toast com a mensagem de sucesso -->
    <div class="position-fixed mt-3 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-success" class="bg-success toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    Produto alterado com sucesso!
                </div>
            </div>
        </div>
    </div>

    <!-- modal de delete -->
    <div class="modal fade" id="delete-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Deletar produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Você tem certeza que deseja deletar o produto selecionado?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="confirm-button" type="button" class="btn btn-danger">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- list -->
    <h1 class="pt-2">Edição e exclusão de produtos</h1>
    <div class="row p-0 gx-3">

        <?php foreach (Product::get_products() as $prod) : ?>
            <?php $img_bw = ($prod->inventory == 0) ? 'bw' : ''; ?>

            <div class="col-12 col-sm-4 gy-5">
                <div class="row p-2 d-flex">
                    <img src="<?= getenv('AWS_LINK') . $prod->image ?>" style="width: auto; height: 150px; object-fit: cover;" class="img-fluid col-4 <?= $img_bw ?>">
                    <div class="col w-auto">
                        <div class="row">
                            <p class="d-block"><?= $prod->brand->name . ' ' . $prod->model ?></p>
                        </div>
                        <div class="row">
                            <div class="btn-group">
                                <a type="button" href="details.php?p=<?= $prod->id ?>" class="btn btn-outline-secondary">Ver</a>
                                <a type="button" href="edit_product.php?p=<?= $prod->id ?>" class="btn btn-outline-secondary">Editar</a>
                                <a type="button" class="btn btn-outline-danger delete" data-bs-toggle="modal" data-bs-target="#delete-modal" data-bs-product-id="<?= $prod->id ?>">Excluir</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

    <!-- success message -->
    <?php if ($_GET['e'] == 2) : ?>

        <script>
            const toast = new bootstrap.Toast(document.getElementById("toast-success"));
            toast.show();
        </script>

    <?php endif; ?>

    <script>
        document.querySelector('#delete-modal').addEventListener('show.bs.modal', event => {
            const id = event.relatedTarget.getAttribute('data-bs-product-id');

            document.querySelector('#confirm-button').onclick = () => {
                window.location = '../handlers/delete_product.php?p=' + id;
            };
        });
    </script>
</div>