<?php
include_once PATH . '/view/header.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Предварительный просмотр</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php
                    foreach ($ar_products as $product):
                        ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?= $product['product_name'] ?></h6>
                                <small class="text-muted">Количество: <?= $product['count'] ?></small>
                            </div>
                            <span class="text-muted">Цена за еденицу: <?= $product['cost'] ?></span>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <form action="" method="post">
                    <input type="hidden" name="client_data" value='<?= $_POST['client_data'] ?>'>
                    <input type="hidden" name="products" value='<?= $_POST['products'] ?>'>

                    <input type="submit" name="create_invoice_pdf" class="btn btn-primary btn-lg"
                           value="PDF">
                    <input type="submit" name="create_invoice_word" class="btn btn-primary btn-lg"
                           value="WORD">
                    <input type="submit" name="back_to_products" class="btn btn-danger btn-lg" value="Назад">
                </form>
            </div>
        </div>
    </div>


<?php
include_once PATH . '/view/footer.php';