<?php
include_once PATH . '/view/header.php';
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
                        <div class="col-1">
                            <label for="ceo">ФИО</label>
                        </div>
                        <div class="col-md-11">
                            <input type="text" name="ceo" class="form-control" id="ceo" placeholder="Иван Филипов" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your CEO is required.
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-1">
                            <label for="email">Email</label>
                        </div>
                        <div class="col-md-11">
                            <input type="email" name="email" class="form-control" id="email" placeholder="their@email.com" required>
                            <div class="invalid-feedback">
                                Your Email is required.
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
                            <input type="text" name="requisites" class="form-control" id="requisites" placeholder="Adress.." required>
                            <div class="invalid-feedback">
                                Your Requisites is required.
                            </div>
                        </div>
                    </div>
                    <br class="m-3">
                    <button class="btn btn-primary btn-lg" type="submit" name="add_client">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>


<?php
include_once PATH . '/view/footer.php';