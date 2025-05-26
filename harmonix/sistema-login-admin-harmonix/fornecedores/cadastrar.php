<?php
include "../verificar-autenticacao.php";

if ($_POST) {
    //verificar itens do POST
    // echo "<pre>";
    // print_r($_POST);
    // echo"</pre>";

    //vazio significa produto novo
    // if(empty($_POST["productId"])){;
    if ($_POST["fornecedorId"] == "") {
        $_SESSION["fornecedor"][] = $_POST;
    } else {
        //senao significa que é um produto já cadastrado
        $_SESSION["fornecedor"][$_POST["fornecedorId"]] = $_POST;
    }
    //array_push($_SESSION["produtos"], $_POST);
    $_SESSION["msg"] = "Fornecedor aderido ao sistema!";
}

header("location: ./");
