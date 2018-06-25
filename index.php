<?php

include_once('config.php');
$bot = new TelegramBot($ini_array['bot']['token']);
require 'vendor/autoload.php';
$word = new  Word();
//199161322
if(isset($_POST['create_invoice'])){
    $word->createInvoice($_POST);
    $bot->sendMessage(405529923,'http://andr-gud.pro/word_generation/tmp/document.docx');
}elseif(isset($_POST['add_one_product'])){
    $json_client = $_POST['client_data'];
    unset($_POST['client_data']);
    if(isset($_POST['products'])){
        //объединение массива $_POST['products'] и массива $_POST;
        $product = $_POST['products'];
        unset($_POST['products']);
        $json_products = $product . ';' . json_encode($_POST);
    }else{
        $json_products = json_encode($_POST);
    }
    include_once "view/form_product.php";
}elseif(isset($_POST['add_client'])){
    $json_client = json_encode($_POST);
    include_once "view/form_product.php";
}else{
    include_once "view/form_user.php";
}
