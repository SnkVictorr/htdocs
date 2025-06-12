<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// VERIFICAR SE ESTÁ VINDO DADOS DO PRODUTO
// if($_POST) {
//     // VERIFICAR ITENS DO POST
//     // echo "<pre>";
//     // print_r($_SESSION);
//     // echo "</pre>";
//     // exit;

//     // VAZIO SIGNIFICA PRODUTO NOVO
//     if ($_POST["clientId"] == "") {
//         $_SESSION["clientes"][] = $_POST; // OU
//     } else {
//         // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
//         $_SESSION["clientes"][$_POST["clientId"]] = $_POST;
//     }

//     // AMBAS AS LINHAS FAZEM A MESMA COISA
//     // array_push($_SESSION["produtos"], $_POST);
//     $_SESSION["msg"] = "Cliente cadastrado com sucesso!";    
// }

try {
    if (!$_POST) {
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    // VERIFICAR SE O ARQUIVO FOI ENVIADO
    if ($_FILES["imagem"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["imagem"]["tmp_name"], "../produtos/imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["imagem"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentimagem"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentimagem"]);
        }
    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["imagem"] = $_POST["currentimagem"];
    }

    $msg = '';


    if ($_POST["productId"] == "") {
        $postfields = array(
            "produto" => $_POST["produto"],
            "descricao" => $_POST["descricao"],
            "id_marca" => $_POST["id_marca"],
            "imagem" => $_POST["imagem"],
            "quantidade" => $_POST["quantidade"],
            "preco" => $_POST["preco"]
        );

        require("../requests/produtos/post.php");
    } else {
        $postfields = array(
            "id_produto" => $_POST["productId"],
            "produto" => $_POST["produto"],
            "descricao" => $_POST["descricao"],
            "id_marca" => $_POST["id_marca"],
            "imagem" => $_POST["imagem"],
            "quantidade" => $_POST["quantidade"],
            "preco" => $_POST["preco"]
        );
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        require("../requests/produtos/put.php");
    }
    $_SESSION["msg"] = $response["message"];;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}
