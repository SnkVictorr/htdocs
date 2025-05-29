<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

if (isset($_GET["key"])) {
    $key = $_GET["key"];

    require "../requests/fornecedores/delete.php";
    $_SESSION["msg"] = $response["message"];
}
header("Location: ./");
exit;
