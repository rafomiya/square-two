<?php
require_once __DIR__ . '/../models/Category.php';
require_once __DIR__ . '/../models/Brand.php';

$categories = Category::get_categories();
$brands = Brand::get_brands();
?>

<div id="form-product" class="my-4 mb-5">
    <form class="mx-4 mt-4 mb-5" action="../add_product_handler.php" method="post">
        <h1>Cadastro de produto</h1>

        <div class="form-group row mt-3">
            <label for="model" class="text-lg-end col-sm col-form-label">Modelo:</label>
            <div class="col-sm-9">
                <input class="form-control" required type="text" name="model" />
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

                        <option value="<?= $category->id ?>">
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

                        <option value="<?= $brand->id ?>">
                            <?= $brand->name ?>
                        </option>

                    <?php endforeach; ?>

                </select>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="price" class="text-lg-end col-sm col-form-label">Preço</label>
            <div class="col-sm-9">
                <input data-prefix="R$" data-decimals="2" min="0.00" max="99999999.00" step="0.5" value="0" class="form-control" type="number" required id="price" name="price" />
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="description" class="text-lg-end col-sm col-form-label">Descrição:</label>
            <div class="col-sm-9">
                <textarea rows="5" class="form-control" id="description" name="description"></textarea>
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
                    <input id="no" class="form-check-input" checked type="radio" name="is_new" value="0" />
                    <label for="no" class="form-check-label">Não</label><br />
                </div>

            </div>

        </div>

        <div class="form-group row mt-3">
            <label for="inventory" class="text-lg-end col-sm col-form-label">Em estoque:</label>
            <div class="col-sm-9">
                <input data-suffix="Unidades" class="form-control" min="0" max="99999999" value="1" id="inventory" type="number" required name="inventory" />
            </div>
        </div>

        <div class="d-flex justify-content-end mb-5">
            <button type="submit" class="btn btn-sm btn-success mt-5">
                <span class="bi bi-check">Cadastrar</span>
            </button>
        </div>
    </form>
    <script>
        $("input[type='number']").inputSpinner()
    </script>
</div>