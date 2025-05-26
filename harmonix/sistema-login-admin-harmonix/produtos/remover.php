<?php
include "../verificar-autenticacao.php";

if (isset($_GET["key"])) {
    $key = $_GET["key"];

    // Verifica se a imagem existe antes de tentar excluí-la
    // if (isset($_SESSION["produtos"][$key]["productImage"]) && !empty($_SESSION["produtos"][$key]["productImage"])) {
    //     $imagePath = "imagens/" . $_SESSION["produtos"][$key]["productImage"];
    //     if (file_exists($imagePath)) {
    //         unlink($imagePath);
    //     }
    // }

    require "../requests/produtos/delete.php";
    $_SESSION["msg"] = $response["message"];
}
header("Location: ./");
exit;
