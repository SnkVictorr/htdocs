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
            <div class="col-md-6">
                <!-- Formulário de cadastro de produtos -->
                <h2>Cadastrar Produto
                    <a href="./" class="btn btn-primary btn-sm">Novo Produto</a>
                </h2>

                <!--ENCTYPE: PERMITE O ENVIO DE ARQUIVOS JUNTO COM O FORMULARIO  -->
                <form id="productForm" enctype="multipart/form-data" action="/produtos/cadastrar.php" method="POST">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do Produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Produto..." required value="<?php echo isset($produto) ? $produto["nome"] : ""; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Categoria</label>
                        <select class="form-select" id="productCategory" name="productCategory" required>
                            <option value="" disabled selected>Selecione uma categoria...</option>
                            <?php
                            require("../requests/categorias/get.php");;
                            if (!empty($response)) {
                                foreach ($response["data"] as $categoria) {
                                    $selected = (isset($produto) && $produto["categoria_id"] == $categoria["categoria_id"]) ? "selected" : "";
                                    echo '<option ' . $selected . 'value="' . $categoria["categoria_id"] . '">' . $categoria["categoria"] . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>Nenhuma categoria cadastrada</option>';
                            }
                            ?>
                        </select>
                        <!-- Arrumar depois de arrumra o get -->
                    </div>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Marca</label>
                        <select class="form-select" id="productBrand" name="productBrand" required>
                            <option value="" disabled selected>Selecione uma marca...</option>
                            <?php
                            require("../requests/marcas/get.php");
                            if (!empty($response)) {
                                foreach ($response["data"] as $marca) {
                                    $selected = (isset($produto) && $produto["marca_id"] == $marca["marca_id"])  ? "selected" : "";
                                    echo '<option ' . $selected . ' value="' . $marca["marca_id"] . '" >' . $marca["marca"] . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>Nenhuma marca cadastrada</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Descrição produto..." rows="3" required><?php echo isset($product) ? $product["productDescription"] : ""; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPriceWDiscount" class="form-label">Desconto</label>
                        <input type="number" step="0.01" class="form-control" id="productPriceWDiscount" name="productPriceWDiscount" placeholder="R$..." required value="<?php echo isset($product) ? $product["productPriceWDiscount"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Preço</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" placeholder="R$..." required value="<?php echo isset($product) ? $product["productPrice"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="Quant..." required value="<?php echo isset($product) ? $product["productQuantity"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagem</label>
                        <input type="file" accept="image/*" class="form-control" id="productImage" name="productImage" value="<?php echo isset($produto) ? $produto["imagem"] : ""; ?>">
                    </div>
                    <?php
                    if (isset($product["productImage"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentImage" value="' . $product["productImage"] .  '">
                            <img width="100" src="../produtos/imagens/' . $product["productImage"] . '">
                        </div>
                        ';
                    }
                    ?>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
            <div class="col-md-6">
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