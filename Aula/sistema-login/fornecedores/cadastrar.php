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
    $msg = '';

    if ($_POST["fornecedorId"] == "") {
        $postfields = array(
            "nome" => $_POST["fornecedorName"],
            "razaoSocial" => $_POST["razaoSocial"],
            "email" => $_POST["fornecedorEmail"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "telefone" => $_POST["fornecedorTelefone"],
            "endereco" => array(
                "cep" => $_POST["fornecedorCEP"],
                "logradouro" => $_POST["fornecedorAddress"],
                "numero" => $_POST["fornecedorNumber"],
                "complemento" => $_POST["fornecedorComplement"],
                "bairro" => $_POST["fornecedorNeighborhood"],
                "cidade" => $_POST["fornecedorCity"],
                "estado" => $_POST["fornecedorState"]
            )
        );
        require("../requests/fornecedores/post.php");
    } else {
        $postfields = array(
            "id" => $_POST["fornecedorId"],
            "nome" => $_POST["fornecedorName"],
            "razaoSocial" => $_POST["razaoSocial"],
            "email" => $_POST["fornecedorEmail"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "telefone" => $_POST["fornecedorTelefone"],
            "endereco" => array(
                "cep" => $_POST["fornecedorCEP"],
                "logradouro" => $_POST["fornecedorAddress"],
                "numero" => $_POST["fornecedorNumber"],
                "complemento" => $_POST["fornecedorComplement"],
                "bairro" => $_POST["fornecedorNeighborhood"],
                "cidade" => $_POST["fornecedorCity"],
                "estado" => $_POST["fornecedorState"]
            )
        );
        // SENÃO, SIGNIFICA QUE É UM PRODUTO JÁ CADASTRADO
        require("../requests/fornecedores/put.php");
    }


    $_SESSION["msg"] = $response["message"];;
} catch (Exception $e) {
    $_SESSION["msg"] = $e->getMessage();
} finally {
    header("Location: ./");
}
