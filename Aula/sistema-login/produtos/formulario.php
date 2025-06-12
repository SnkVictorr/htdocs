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
                <!-- Formulário de cadastro de clientes -->
                <h2>
                    Cadastrar Produto
                    <a href="/produtos/formulario.php" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>
                <form id="produtoForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($produto) ? $produto['id_produto'] : ""; ?>">
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
                                    $selected = (isset($produto) && $produto["id_marca"] == $marca["id_marca"])  ? "selected" : "";
                                    echo '<option ' . $selected . ' value="' . $marca["id_marca"] . '" >' . $marca["marca"] . '</option>';
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
                            <input type="hidden" name="currentImage" value="' . $produto["imagem"] . '">
                            <img width="100" src="/produtos/imagens/' . $produto["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control " id="preco" name="preco" placeholder="R$..." required value="<?php echo isset($produto) ? $produto["preco"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control " id="quantidade" name="quantidade" placeholder="Quant..." required value="<?php echo isset($produto) ? $produto["quantidade"] : ""; ?>">
                    </div>


                    <button type="submit" class="btn btn-primary">Salvar</button>


                </form>
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