<?php
include "../verificar-autenticacao.php";

if (isset($_GET["key"])){
$key = $_GET["key"];

// Verifica se a imagem existe antes de tentar excluí-la
// if (isset($_SESSION["produtos"][$key]["productImage"]) && !empty($_SESSION["produtos"][$key]["productImage"])) {
//     $imagePath = "imagens/" . $_SESSION["produtos"][$key]["productImage"];
//     if (file_exists($imagePath)) {
//         unlink($imagePath);
//     }
// }

if(file_exists("imagens/".$_SESSION["produtos"][$key]["productImage"])){
    unlink("imagens/".$_SESSION["produtos"][$key]["productImage"]);
}
//unset: remove um item de um array
unset($_SESSION["produtos"][$key]);
//array_values: reorganiza os índices do array
$_SESSION["produtos"] = array_values($_SESSION["produtos"]);
$_SESSION["msg"] = "Produto removido com sucesso!";
}
header("location: ./");
exit;