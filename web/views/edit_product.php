<?php
if ($_SESSION['level_user'] != 1)
    header('Location: index.php');

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Brand.php';

$categories = Category::get_categories();
$brands = Brand::get_brands();

$id = $_GET['p'];
$product = Product::get_product($id);

?>
<div id="form-product" class="my-4 mb-5">

    <div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
        <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex text-center">
                <div class="toast-body text-center text text-white">
                    Algo deu errado. Tente novamente.
                </div>
            </div>
        </div>
    </div>

    <form class="mx-4 mt-4 mb-5" action="../edit_product_handler.php?p=<?= $id ?>" method="post" enctype="multipart/form-data">
        <h1>Alteração de produto</h1>

        <div class="form-group row mt-3">
            <label for="model" class="text-lg-end col-sm col-form-label">Modelo:</label>
            <div class="col-sm-9">
                <input class="form-control" required type="text" name="model" placeholder="<?= $product->model ?>" />
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="category" class="text-lg-end col-sm col-form-label">Categoria:</label>
            <div class="col-sm-9">
                <select class="form-control" required id="category" name="category">
                    <option value="">
                        Selecione uma opção
                    </option>

                    <?php foreach ($categories as $category) : ?>

                        <option <?= ($category->id === $product->category->id) ? 'selected' : '' ?> value="<?= $category->id ?>">
                            <?= $category->name ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="brand" class="text-lg-end col-sm col-form-label">Marca:</label>
            <div class="col-sm-9">
                <select class="form-control" required id="brand" name="brand">
                    <option value="">
                        Selecione uma opção
                    </option>

                    <?php foreach ($brands as $brand) : ?>

                        <option <?= ($brand->id === $product->brand->id) ? 'selected' : '' ?> value="<?= $brand->id ?>">
                            <?= $brand->name ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="price" class="text-lg-end col-sm col-form-label">Preço</label>
            <div class="col-sm-9">
                <input data-prefix="R$" data-decimals="2" min="0.00" max="99999999.00" step="0.5" value="<?= $product->price ?>" class="form-control" type="number" required id="price" name="price" />
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="description" class="text-lg-end col-sm col-form-label">Descrição:</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="description" name="description" placeholder="<?= $product->description ?>"></textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="image" class="text-lg-end col-sm col-form-label">Imagem:</label>
            <div class="col-sm-9">
                <input id="image" class="form-control" type="file" name="image" required />
            </div>
        </div>

        <div class="form-group row mt-3">

            <label for="is_new" class="text-lg-end col-sm col-form-label">O produto é um lançamento?</label>

            <div class="col-sm-9 my-auto">

                <div class="form-check form-check-inline">
                    <input id="yes" class="form-check-input" type="radio" name="is_new" value="1" />
                    <label for="yes" class="form-check-label">Sim</label><br />
                </div>

                <div class="form-check form-check-inline">
                    <input id="no" class="form-check-input" type="radio" name="is_new" value="0" />
                    <label for="no" class="form-check-label">Não</label><br />
                </div>

            </div>

        </div>

        <div class="form-group row mt-3">
            <label for="inventory" class="text-lg-end col-sm col-form-label">Em estoque:</label>
            <div class="col-sm-9">
                <input data-suffix="Unidades" class="form-control" min="0" max="99999999" value="<?= $product->inventory ?>" id="inventory" type="number" required name="inventory" />
            </div>
        </div>

        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-sm btn-success mt-5">
                <span class="bi bi-check">Alterar</span>
            </button>
        </div>
    </form>

    <?php if ($_GET['e'] == 1) : ?>
        <script>
            const toast = new bootstrap.Toast(document.getElementById("toast-error"));
            toast.show();
        </script>
    <?php endif; ?>

    <script>
        // definign the input[type=number] as a spinner
        $("input[type='number']").inputSpinner();

        // definign the default value of the is_new input
        let yes = document.getElementById("yes");
        let no = document.getElementById("no");

        if (<?= $product->is_new ? 'true' : 'false' ?>) {
            yes.checked = true;
        } else {
            no.checked = true;
        }
    </script>
</div>