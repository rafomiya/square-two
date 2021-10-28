<?php
require_once __DIR__ . '/../models/Product.php';

$id = $_GET['p'] ?? '0';

if ($id == '0')
    echo '<script>document.location = "../views/error.php"</script>';

$product = Product::get_product($id);


if ($product == null)
    echo '<script>document.location = "../views/error.php"</script>';

$has_in_stock = $product->inventory > 0;
?>

<div class="container mb-3 mt-3">

    <h1 class="display-3 fw-normal">Detalhes do produto</h1>

    <div class="row">

        <div id="img-details" class="col-12 col-sm-5 border border-5 p-0 mx-auto">
            <img src="<?= getenv('AWS_LINK') . $product->image ?>" class="w-100 img-responsive rounded-3 m-0 <?= $has_in_stock ? '' : 'bw' ?>">
        </div>

        <div class="col-12 col-sm d-flex flex-column">
            <p class="text text-muted m-0"><?= $product->brand->name ?></p>
            <h1><?= $product->category->name . ' ' . $product->brand->name . ' ' . $product->model ?></h1>

            <hr>

            <h2><strong>R$ <?= number_format($product->price, 2, ',', '.') ?></strong></h2>

            <!-- <label for="amount" class="form-label-for">Quantidade:</label>
            <input type="number" min="1" max="<?= $product->inventory ?>" value="1" class="form-control-sm" id="amount" name="amount" /> -->

            <button <?= $has_in_stock ? '' : 'disabled' ?> class="btn btn-lg btn-success col-12 col-sm-3 mb-5">Comprar</button>

            <?php if (!$has_in_stock) : ?>
                <p class="d-inline text text-danger">Produto indisponível</p>
            <?php endif; ?>

            <section class="mt-auto">
                <p class="mb-0 fs-5 text-break">
                    <strong>Marca:</strong>
                    <a href="brand.php?b=<?= $product->brand->id ?>">
                        <?= $product->brand->name ?></a>
                </p>

                <p class="mb-0 fs-5 text-break">
                    <strong>Modelo:</strong>
                    <?= $product->model ?>
                </p>

                <p class="mb-0 fs-5 text-break">
                    <strong>Categoria:</strong>
                    <a href="category.php?c=<?= $product->category->id ?>">
                        <?= $product->category->name ?>
                    </a>
                </p>

                <p class="mb-0 fs-5 text-break">
                    <strong>Descrição:</strong>
                    <?= $product->description ?>
                </p>
            </section>
        </div>

    </div>
</div>
<!-- <script>
    $("input[type='number']").inputSpinner({
        buttonsOnly: true,
        autoInterval: undefined
    })
</script> -->