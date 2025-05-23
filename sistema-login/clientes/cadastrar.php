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
    if ($_FILES["clientImage"]["name"] != "") {
        // PEGAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($_FILES["clientImage"]["name"], PATHINFO_EXTENSION);
        // GERAR UM NOVO NOME PARA O ARQUIVO
        $novo_nome = md5(uniqid() . microtime()) . ".$extensao";
        // MOVER O ARQUIVO PARA A PASTA DE IMAGENS
        move_uploaded_file($_FILES["clientImage"]["tmp_name"], "imagens/$novo_nome");
        // ADICIONAR O NOME DO ARQUIVO NO POST
        $_POST["clientImage"] = $novo_nome;

        // SE JÁ EXISTIR UMA IMAGEM, DELETAR A IMAGEM
        if ($_POST["currentClientImage"] != "") {
            // UNLINK = DELETAR ARQUIVOS
            unlink("imagens/" . $_POST["currentClientImage"]);
        }
    } else {
        // SE NÃO FOI ENVIADO ARQUIVO, PEGAR O NOME DO ARQUIVO ATUAL
        $_POST["clientImage"] = $_POST["currentClientImage"];
    }

    $msg = '';


    if ($_POST["clientId"] == "") {
        $postfields = array(
            "nome" => $_POST["clientName"],
            "email" => $_POST["clientEmail"],
            "cpf" => $_POST["clientCPF"],
            "whatsapp" => $_POST["clientWhatsapp"],
            "imagem" => $_POST["clientImage"],
            "endereco" => array(
                "cep" => $_POST["clientCEP"],
                "logradouro" => $_POST["clientAddress"],
                "numero" => $_POST["clientNumber"],
                "complemento" => $_POST["clientComplement"],
                "bairro" => $_POST["clientNeighborhood"],
                "cidade" => $_POST["clientCity"],
                "estado" => $_POST["clientState"]
            )
        );
        require("../requests/clientes/post.php");
    } else {
        $postfields = array(
            "id" => $_POST["clientId"],
            "nome" => $_POST["clientName"],
            "cpf" => $_POST["clientCPF"],
            "email" => $_POST["clientEmail"],
            "whatsapp" => $_POST["clientWhatsapp"],
            "imagem" => $_POST["clientImage"],
            "endereco" => array(
                "cep" => $_POST["clientCEP"],
                "logradouro" => $_POST["clientAddress"],
                "numero" => $_POST["clientNumber"],
                "complemento" => $_POST["clientComplement"],
                "bairro" => $_POST["clientNeighborhood"],
                "cidade" => $_POST["clientCity"],
                "estado" => $_POST["clientState"]
            )
        );
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        require("../requests/clientes/put.php");
    }
    $_SESSION["msg"] = $response["message"];;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}
