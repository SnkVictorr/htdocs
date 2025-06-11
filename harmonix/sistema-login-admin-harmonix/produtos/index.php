<?php
include "../verificar-autenticacao.php";
include "../../api-backend/conn.php";

//Indica qual página está
$pagina = "produtos";
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/produtos/get.php");

    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        $produto = $response['data'][0];
    } else {
        $produto = null;
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Produtos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <!-- Tabela de produtos cadastrados -->
                <h2>Produtos Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Estoque</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Desconto</th>
                            <th scope="col" style="white-space: nowrap;">Preço com Desconto</th>

                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php

                        require("../requests/produtos/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $produto) {
                                echo '
                                <tr>
                                    <th scope="row">' . $produto['produto_id'] . '</th>
                                    <td><img width="60" src="../produtos/imagens/' . $produto["image_url"] . '"></td>

                                    <td>' . $produto["produto"] . '</td>
                                    <td>' . $produto["descricao"] . '</td>
                                    <td>' . $produto["marca"] . '</td>
                                    <td>' . $produto["categoria"] . '</td>
                                    <td>' . $produto["estoque"] . '</td>
                                    <td>R$ ' . number_format($produto["preco"], 2, ",", ".") . '</td>
                                    <td>R$ ' . number_format($produto["desconto"], 2, ",", ".") . '</td>
                                    <td>R$ ' . number_format($produto["preco"] - $produto["desconto"], 2, ",", ".")     . '</td>

                                    <td>
                                        <a href="/produtos/formulario.php?key=' . $produto['produto_id'] . '" class="btn btn-warning">Editar</a>
                                        <a href="/produtos/remover.php?key=' . $produto['produto_id'] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum produto cadastrado</td>
                            </tr>
                            ';
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>