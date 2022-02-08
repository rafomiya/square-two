<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Avaliation.php';


// getting the product id from the url
$id = $_GET['p'] ?? '0';

// redirecting to error page if the id is not valid
if ($id == '0')
    echo '<script>document.location = "error.php"</script>';

// setting the product object
$product = Product::get_product($id);

// redirecting to error page if the product is not found
if ($product == null)
    echo '<script>document.location = "error.php"</script>';

// defining boolean to check if the product is in stock
$has_in_stock = $product->inventory > 0;

// getting the avaliations
$avaliations = Avaliation::get_avaliations($id);

// get the average avaliation
$sum = 0;
foreach ($avaliations as $avaliation) {
    $sum += $avaliation->score;
}

$avaliations_count = count($avaliations);
if ($avaliations_count > 0)
    $avaliations_average = $sum / $avaliations_count;
else
    $avaliations_average = 0;
?>
<style>
    #rate {
        float: left;
        height: 1vh;
        padding: 0 10px;
    }

    #rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    #rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ffb900;
    }

    #rate>input:checked~label {
        color: #ffb900;
    }

    #rate:not(:checked)>label:hover,
    #rate:not(:checked)>label:hover~label {
        color: #ffb900;
    }

    #rate>input:checked+label:hover,
    #rate>input:checked+label:hover~label,
    #rate>input:checked~label:hover,
    #rate>input:checked~label:hover~label,
    #rate>label:hover~input:checked~label {
        color: #ffb900;
    }
</style>

<div class="position-fixed mt-5 end-0 p-3 d-flex justify-content-center" data-bs-delay="4000" data-bs-autohide="true" style="z-index: 11; max-width: 100%; width: 100%;">
    <div id="toast-error" class="bg-danger toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex text-center">
            <div class="toast-body text-center text text-white">
                Você já avaliou este produto.
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="avaliation-modal" tabindex="-1" aria-labelledby="avaliation-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="avaliation-modal-label">Avaliar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../handlers/add_avaliation.php?p=<?= $id ?>" method="post">
                    <div class="mb-3">
                        <label for="comment" class="col-form-label">Comentário:</label>
                        <textarea class="form-control" id="comment" name="comment" required></textarea>
                    </div>
                    <div>
                        <label class="col-form-label">Nota:</label>
                        <fieldset id="rate">
                            <input type="radio" name="score" class="d-inline" id="rating-5" value="5"><label for="rating-5" class="bi bi-star">5</label>
                            <input type="radio" name="score" class="d-inline" id="rating-4" value="4"><label for="rating-4" class="bi bi-star">4</label>
                            <input type="radio" name="score" class="d-inline" id="rating-3" value="3"><label for="rating-3" class="bi bi-star">3</label>
                            <input type="radio" name="score" class="d-inline" id="rating-2" value="2"><label for="rating-2" class="bi bi-star">2</label>
                            <input type="radio" name="score" class="d-inline" id="rating-1" value="1" checked><label for="rating-1" class="bi bi-star-fill">1</label>
                        </fieldset>
                    </div>
                    <button id="submit" type="submit" class="d-none"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary bi bi-x-circle" data-bs-dismiss="modal">
                    Fechar
                </button>
                <button id="send-avaliation" type="button" class="btn btn-primary bi bi-check-circle" onclick="document.querySelector('#submit').click();">
                    Enviar avaliação
                </button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <h1 class="display-3 fw-normal">Detalhes do produto</h1>
    <div class="row">
        <div id="img-details" class="col-12 col-sm-5 border border-5 p-0 mx-auto">
            <img src="<?= getenv('AWS_LINK') . $product->image ?>" class="w-100 img-responsive rounded-3 m-0 <?= $has_in_stock ? '' : 'bw' ?>">
        </div>

        <div class="col-12 col-sm">
            <p class="text text-muted m-0">Veja mais produtos de <a href="brand.php?b=<?= $product->brand->id ?>"><?= $product->brand->name ?>.</a></p>
            <h1><?= $product->category->name . ' ' . $product->brand->name . ' ' . $product->model ?></h1>
            <p>
                <?php Avaliation::load_stars($avaliations_average); ?>

                <span class="text-muted">(<?= $avaliations_count ?> avaliações)</span>
            </p>

            <hr>

            <div class="row">
                <div class="col-sm-6 col-12">
                    <h2><strong>R$ <?= number_format($product->price, 2, ',', '.') ?></strong></h2>

                    <?php if (!$has_in_stock) : ?>
                        <p class="d-inline text text-danger">Produto indisponível</p>
                    <?php endif; ?>

                    <section>
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

                <div class="col-sm-6 col-12">
                    <form action="../controllers/cart.php?p=<?= $product->id ?>" method="post">
                        <label for="quantity" class="form-label-for mb-2">Quantidade:</label>
                        <input type="number" min="1" max="<?= $product->inventory - $_SESSION['cart'][$product->id] ?>" value="1" class="form-control-sm" id="quantity" name="quantity" />
                        <p class="text-muted text-nowrap"><?= $product->inventory ?> unidade<?= $product->inventory == 1 ? '' : 's' ?> em estoque.</p>

                        <button id="cart" <?= $has_in_stock ? '' : 'disabled' ?> class="btn btn-lg btn-success col-12 bi bi-cart-fill">
                            Adicionar ao carrinho
                        </button>
                    </form>

                    <button type="button" class="btn-lg btn-warning w-100 mt-3 border-0 bi bi-star" data-bs-toggle="modal" data-bs-target="#avaliation-modal">
                        Já comprou? Avalie!
                    </button>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <h2>Avaliações</h2>

        <?php if (count($avaliations) == 0) : ?>

            <p class="text-muted">Nenhuma avaliação para este produto.</p>

        <?php else : ?>

            <?php foreach ($avaliations as $avaliation) : ?>

                <div class="col-12 mb-4">
                    <p class="m-0"><strong><?= explode(' ', $avaliation->user->nome)[0] ?></strong> <span class="text-muted"><?= $avaliation->user->cidade ?></span></p>
                    <p>
                        <?php Avaliation::load_stars($avaliation->score); ?>
                        <span class="text-muted"><?= $avaliation->date ?></span>
                    </p>
                    <p><?= $avaliation->comment ?></p>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>
</div>
<script>
    // setting the cart button as disabled if the product is out of stock
    $('#cart').prop('disabled', <?= !$has_in_stock ? 'true' : 'false' ?>);


    // handling input type number appearance
    $("input[type='number']").inputSpinner({
        buttonsOnly: true,
        autoInterval: undefined
    });

    // handling star fill on rating appearance
    $('input[type="radio"]').on('click', event => {
        let clicked = event.target.value;
        let starsLabels = $('#rate > label');

        // unfill all stars
        for (star of starsLabels) {
            if (star.classList.contains('bi-star-fill')) {
                star.classList.remove('bi-star-fill');
                star.classList.add('bi-star');
            }
        }

        // fill until clicked star
        for (star of starsLabels)
            if (star.innerHTML <= clicked) {
                star.classList.remove('bi-star');
                star.classList.add('bi-star-fill');
            }
    });

    // handling error message on duplicate entry
    <?php if ($_GET['e'] == 1) : ?>

        const toast = new bootstrap.Toast(document.getElementById("toast-error"));
        toast.show();

    <?php endif; ?>

    // handling onchange quantity
    $('#quantity').on('change', event => {
        if (event.target.value == 0)
            $('#cart').attr('disabled', true);
        else
            $('#cart').attr('disabled', false);
    });
</script>