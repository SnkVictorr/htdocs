<?php
include "../verificar-autenticacao.php";

if ($_POST) {
    //verificar itens do POST
    // echo "<pre>";
    // print_r($_POST);
    // echo"</pre>";

    //vazio significa produto novo
    // if(empty($_POST["productId"])){;
    if ($_POST["funcionarioId"] == "") {
        $_SESSION["funcionario"][] = $_POST;
    } else {
        //senao significa que é um produto já cadastrado
        $_SESSION["funcionario"][$_POST["funcionarioId"]] = $_POST;
    }
    //array_push($_SESSION["produtos"], $_POST);
    $_SESSION["msg"] = "Funcionário aderido ao sistema!";
}

header("location: ./");
