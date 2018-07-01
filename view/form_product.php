<?php
include_once PATH . '/view/header.php';
?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 order-md-1 my-4">
                <h5 class="mb-4">Добавить продукт</h5>
                <form action="" method="post" class="needs-validation" novalidate>
                    <input type="hidden" name="client_data" value='<?= $json_client ?>'>
                    <?php
                    if(isset($_POST['add_one_product'])):
                    ?>
                        <input type="hidden" name="products" value='<?= $json_products ?>'>
                        <?php
                    endif;
                        ?>
                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="product_name">Название</label>
                        </div>
                        <div class="col-md-11">
                            <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Товар.." value="" >
                            <div class="invalid-feedback">
                                Valid product name is required.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-1">
                            <label for="username">Штук</label>
                        </div>
                        <div class="col-md-11">
                            <input type="number" name="count" class="form-control" id="count" placeholder="" value="1" >
                            <div class="invalid-feedback" style="width: 100%;">
                                Valid count is required.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="email">Цена</label>
                        </div>
                        <div class="col-md-11">
                            <input type="number" name="cost" class="form-control" id="email" placeholder=".." >
                            <div class="invalid-feedback">
                                Your cost is required.
                            </div>
                        </div>
                    </div>

                    <br class="m-3">
                    <button class="btn btn-lg" type="submit" name="add_one_product">Добавить продукт</button>
                    <?php
                    if(isset($_POST['add_one_product'])||isset($_POST['back_to_products'])):
                    ?>
                    <input type="submit" name="preview" class="btn btn-primary btn-lg" value="Предварительный просмотр">
                        <?php
                    endif;
                        ?>
                </form>
            </div>
        </div>
    </div>


<?php
include_once PATH . '/view/footer.php';