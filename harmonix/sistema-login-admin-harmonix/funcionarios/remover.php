<?php
include "../verificar-autenticacao.php";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    //unset: remove um item de um array
    unset($_SESSION["funcionario"][$key]);
    //array_values: reorganiza os índices do array
    $_SESSION["funcionario"] = array_values($_SESSION["funcionario"]);
    $_SESSION["msg"] = "Funcionário removido com sucesso!";
}
header("location: ./");
exit;
