<?php
include "../verificar-autenticacao.php";
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "</pre>";
exit;
try {

    if (!$_POST) {
        throw new Exception("Acesso indevído! Tente novamente.");
    }
    //Verificar se o arquivo foi enviado
    if ($_FILES["productImage"]["name"] != "") {
        //pegar a extensão do arquivo
        $extensao = pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION);
        //gerar um novo nome para o arquivo
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // VERIFICAR SE O DIRETORIO EXISTE
        $diretorio = "imagens";
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755); // 0755 é um dos niveis de permissão FTP
        }

        //mover o arquivo para a pasta de imagens
        move_uploaded_file($_FILES["productImage"]["tmp_name"], "$diretorio/$novo_nome");
        //adicionar o nome do arquivo no POST
        $_POST["productImage"] = $novo_nome;

        //se ja existir uma imagem, deletar a imagem
        if ($_POST["currentImage"] != "") {
            //unlink = deletar arquivos
            unlink("imagens/" . $_POST["currentImage"]);
        }
    } else {
        //se não foi enviado arquivo, verificar se é uma edição
        $_POST["productImage"] = $_POST["currentImage"];
    }

    $msg = '';

    // $id = $_POST['productId'];
    // $categoria_id = $_POST['categoria_id'] ?? null;
    // $marca_id = $_POST['marca_id'] ?? null;
    // $nome = $_POST['productName'] ?? null;
    // $descricao = $_POST['descricao'] ?? null;
    // $preco = $_POST['preco'] ?? null;
    // $desconto = $_POST['desconto'] ?? null;
    // $estoque = $_POST['estoque'] ?? null;
    // $image_url = $_POST['image_url'] ?? null;

    if ($_POST["productId"] == "") {
        $postfields = array(
            "categoria_id" => $_POST["productCategory"],
            "marca_id" => $_POST["productBrand"],
            "nome" => $_POST["productName"],
            "descricao" => $_POST["productDescription"],
            "preco" => str_replace(',', '.', $_POST['productPrice']),
            "desconto" => str_replace(',', '.', $_POST['productPriceWDiscount']),
            "estoque" => $_POST["productQuantity"],
            "image_url" => $_POST["productImage"],
        );
        require("../requests/produtos/post.php");
    } else {
        $postfields = array(
            "id" => $_POST["productId"],
            "categoria_id" => $_POST["productCategory"],
            "marca_id" => $_POST["productBrand"],
            "nome" => $_POST["productName"],
            "descricao" => $_POST["productDescription"],
            "preco" => $_POST["productPrice"],
            "desconto" => $_POST["productPriceWDiscount"],
            "estoque" => $_POST["productQuantity"],
            "image_url" => $_POST["productImage"],
        );
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        require("../requests/clientes/put.php");
    }
    $_SESSION["msg"] = $response["message"];
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    echo "oi";
    // header("Location: ./");
}
