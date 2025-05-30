<?php
include "../verificar-autenticacao.php";
include "../../api-backend/conn.php";

//Indica qual página está
$pagina = "produtos";
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // print_r($_SESSION["produtos"][$key]);
    $product = $_SESSION["produtos"][$key];
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
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Produto..." required value="<?php echo isset($product) ? $product["productName"] : ""; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Categoria</label>
                        <select class="form-select" id="productCategory" name="productCategory" required>
                            <option value="" disabled selected>Selecione uma categoria...</option>
                            <?php
                            $sql = "SELECT * FROM categoria";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($categories as $category) {
                                echo '<option value="' . $category["categoria_id"] . '" ' . (isset($product) && $product["categoria_id"] == $category["categoria_id"] ? 'selected' : '') . '>' . $category["nome"] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Marca</label>
                        <select class="form-select" id="productBrand" name="productBrand" required>
                            <option value="" disabled selected>Selecione uma marca...</option>
                            <?php
                            $sql = "SELECT * FROM marca";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($brands as $brand) {
                                echo '<option value="' . $brand["marca_id"] . '" ' . (isset($product) && $product["marca_id"] == $brand["marca_id"] ? 'selected' : '') . '>' . $brand["nome"] . '</option>';
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
                        <input type="file" accept="image/*" class="form-control" id="productImage" name="productImage" value="<?php echo isset($product) ? $product["productImage"] : ""; ?>">
                    </div>
                    <?php
                    if (isset($product["productImage"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentImage" value="' . $product["productImage"] .  '">
                            <img width="100" src="imagens/' . $product["productImage"] . '">
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
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Preço</th>
                            <th scope="col" style="white-space: nowrap;">Preço com Desconto</th>
                            <th scope="col">Quantidade</th>

                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php
                        require("../requests/produtos/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $product) {
                                echo '
                                <tr>
                                    <th scope="row">' . $product['product_id'] . '</th>
                                    <td ><img src="' . $product["image_url"] . '" width="50"></td>
                                    <td style="white-space: nowrap;">' . $product["nome"] . '</td>
                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $product["descricao"] . '</td>
                                    <td style="white-space: nowrap;">R$ ' . number_format($product["desconto"], 2, ",", ".") . '</td>
                                    <td style="white-space: nowrap;">R$ ' . number_format($product["preco"], 2, ",", ".") . '</td>
                                    <td style="white-space: nowrap;">R$ ' . number_format(($product["preco"] - $product["desconto"]), 2, ",", ".") . '</td>
                                    <td style="white-space: nowrap;">' . $product["estoque"] . '</td>
                                        <td>
                                        <a href="/produtos/?key=' . $product["id_cliente"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/produtos/remover.php?key=' . $product["id_cliente"] . '" class="btn btn-danger">Excluir</a>
                                        
                                        </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                            <td colspan = "7">Nenhum produto cadastrado!</td>
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