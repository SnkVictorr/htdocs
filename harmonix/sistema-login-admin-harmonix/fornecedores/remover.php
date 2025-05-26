<?php
include "../verificar-autenticacao.php";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    //unset: remove um item de um array
    unset($_SESSION["fornecedor"][$key]);
    //array_values: reorganiza os índices do array
    $_SESSION["fornecedor"] = array_values($_SESSION["fornecedor"]);
    $_SESSION["msg"] = "Fornecedor removido com sucesso!";
}
header("location: ./");
exit;
