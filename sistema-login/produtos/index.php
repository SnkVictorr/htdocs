<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // SE HOUVER KEY, BUSCA O CLIENTE NO BANCO DE DADOS
    require("../requests/produtos/get.php");
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
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <!-- Formulário de cadastro de clientes -->
                <h2>
                    Cadastrar Produto
                    <a href="/produtos" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>
                <form id="produtoForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="id_produto" class="form-label">Código do produto</label>
                        <input type="text" class="form-control" id="id_produto" name="id_produto" readonly value="<?php echo isset($produto) ? $produto['id_produto'] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="produto" class="form-label">Nome do Produto</label>
                        <input onblur="teste()" type="text" class="form-control" id="produto" name="produto" required value="<?php echo isset($produto) ? $produto["produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" placeholder="Descrição produto..." rows="3" required><?php echo isset($produto) ? $produto["descricao"] : ""; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_marca" class="form-label">Marca</label>
                        <select class="form-select" id="id_marca" name="id_marca" required>
                            <option value="" disabled selected>Selecione uma Marca...</option>
                            <?php
                            require("../requests/marcas/get.php");
                            // ISSO SERÀ FEITO ATRAVES DA 

                            if (!empty($response)) {
                                foreach ($response["data"] as $marca) {
                                    echo '<option value="' . $marca["id_marca"] . '" >' . $marca["marca"] . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>Nenhuma marca cadastrada</option>';
                            }

                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="imagem" name="imagem" accept="image/*" value="<?php echo isset($produto) ? $produto["imagem"] : ""; ?>">
                    </div>

                    <?php
                    // SE HOUVER IMAGEM NO CLIENTE, EXIBIR MINIATURA
                    if (isset($produto["imagem"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentImage" value="' . $$produto["imagem"] . '">
                            <img width="100" src="/produtos/imagens/' . $$produto["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>

            </div>
            <div class="mb-3">
                <label for="preco" class="form-label">Preço</label>
                <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="R$..." required value="<?php echo isset($produto) ? $produto["preco"] : ""; ?>">
            </div>
            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quant..." required value="<?php echo isset($produto) ? $produto["quantidade"] : ""; ?>">
            </div>


            <button type="submit" class="btn btn-primary">Salvar</button>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Imagem</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Preco</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody id="produtoTableBody">
                    <!-- Os clientes serão carregados aqui via PHP -->
                    <?php
                    // Deixa a key null para mostrar todos os clientes
                    $key = null;
                    // SE HOUVER CLIENTES NA BD, EXIBIR
                    require("../requests/produtos/get.php");
                    if (!empty($response)) {
                        foreach ($response["data"] as $key => $produto) {
                            echo '
                                <tr>
                                    <th scope="row">' . $produto['id_produto'] . '</th>
                                    <td><img width="60" src="/produtos/imagens/' . $produto["imagem"] . '"></td>
                                    <td>' . $produto["produto"] . '</td>
                                    <td>' . $produto["descricao"] . '</td>
                                    <td>' . $produto["marca"] . '</td>
                                    <td>' . $produto["quantidade"] . '</td>
                                    <td>' . $produto["preco"] . '</td>
                                    <td>
                                        <a href="/produtos/?key=' . $produto['id_produto'] . '" class="btn btn-warning">Editar</a>
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

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</body>

</html>