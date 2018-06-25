<?php
include_once PATH . '/view/header.php';
$textarea_paceholder = <<< END
Adress;
Email;
Telephon
END;

?>

    <div class="container">
        <div class="row">
            <div class="col-md-10 order-md-1 my-4">
                <h5 class="mb-4">Добавить клиента</h5>
                <form action="" method="post" class="needs-validation" novalidate>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="name">Название</label>
                        </div>
                        <div class="col-md-11">
                            <input type="text" name="name" class="form-control" id="name" placeholder="ООО РИТЕЙЛ ГРУП" value="" required>
                            <div class="invalid-feedback">
                                Valid name is required.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="currency">Валюта</label>
                        </div>
                        <div class="col-md-11">
                            <input type="text" name="currency" class="form-control" id="currency" placeholder="$" required>
                            <div class="invalid-feedback">
                                Your Currency is required.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="requisites">Реквизиты</label>
                        </div>
                        <div class="col-md-11">
                            <textarea name="requisites" class="form-control" id="requisites" placeholder="<?= $textarea_paceholder ?>" cols="100" rows="7" required></textarea>
                            <div class="invalid-feedback">
                                Your Requisites is required.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-md-1">
                            <button class="btn btn-primary btn-lg ml-3" type="submit" name="add_client">Добавить пользователя</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php
include_once PATH . '/view/footer.php';