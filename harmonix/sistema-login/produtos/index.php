<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // SE HOUVER KEY, BUSCA O CLIENTE NO BANCO DE DADOS
    require("../requests/produtos/get.php");
    // 
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e unico cliente na posição [0]
        $produto = $response["data"][0];
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
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">

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
                <div class="card">
                    <div class="card-header">
                        <h1>Produtos Cadastrados
                            <a href="/produtos/formulario.php" class="btn btn-primary btn-sm">Novo Produto</a>
                        </h1>
                    </div>
                    <div class="card-body overflow-auto">
                        <table class="table table-striped " id="produtos">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 10%;">Imagem</th>
                                    <th style="width: 15%;">Produto</th>
                                    <th style="width: 20%;">Descrição</th>
                                    <th style="width: 10%;">Marca</th>
                                    <th style="width: 5%;">Qtd</th>
                                    <th style="width: 10%;">Preço</th>
                                    <th style="width: 20%;">Ações</th>
                                </tr>
                            </thead>
                            <tbody id="produtoTableBody">
                                <!-- Os clientes serão carregados aqui via PHP -->
                                <?php

                                // SE HOUVER CLIENTES NA BD, EXIBIR
                                require("../requests/produtos/get.php");
                                if (!empty($response)) {
                                    foreach ($response["data"] as $key => $produto) {
                                        echo '
                                <tr>
                                    <th scope="row">' . $produto['id_produto'] . '</th>
                                    <td><img width="60" src="../produtos/imagens/' . $produto["imagem"] . '"></td>

                                    <td>' . $produto["produto"] . '</td>
                                    <td class="text-truncate" style="max-width: 150px;">' . $produto["descricao"] . '</td>
                                    <td>' . $produto["marca"] . '</td>
                                    <td>' . $produto["quantidade"] . '</td>
                                    <td>R$ ' . $produto["preco"] . '</td>
                                    <td>
                                        <a href="/produtos/formulario.php?key=' . $produto['id_produto'] . '" class="btn btn-warning">Editar</a>
                                        <a href="/produtos/remover.php?key=' . $produto['id_produto'] . '" class="btn btn-danger">Excluir</a>
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
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS (para Bootstrap 5) -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>

    <script>
        let table = new DataTable('#produtos', {
            language: {
                url: "https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json"
            }
        });
    </script>

</body>

</html>