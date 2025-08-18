<?php

// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

if (isset($_GET["key"]) && is_numeric($_GET["key"])) {
    $key = (int) $_GET["key"];
    // // EXCLUIR IMAGEM DO PRODUTO
    // if (file_exists("imagens/" . $_SESSION["clientes"][$key]["clientImage"])) {
    //     unlink("imagens/" . $_SESSION["clientes"][$key]["clientImage"]);
    // }
    // // UNSET = REMOVE UM ITEM DE UM ARRAY
    // unset($_SESSION["clientes"][$key]);
    // // ARRAY_VALUES = REORGANIZA OS ÍNDICES DO ARRAY
    // $_SESSION["clientes"] = array_values($_SESSION["clientes"]);
    // $_SESSION["msg"] = "Cliente removido com sucesso!";

    require "../requests/clientes/get.php";

    // echo '<pre>';
    // print_r($response["data"][0]);
    // echo '</pre>';
    // exit;
    if (!empty($response["data"][0]["imagem"])) {
        $imagem = $response["data"][0]["imagem"];
        $path = '../clientes/imagens/' . $imagem;
        if (file_exists($path)) {
            unlink($path);
        }
    }
    require "../requests/clientes/delete.php";
    $_SESSION["msg"] = $response["message"];
}
header("Location: ./");
exit;
