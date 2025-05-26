<?php
include "../verificar-autenticacao.php";

//Indica qual página está
$pagina = "fornecedor";
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $fornecedor = $_SESSION["fornecedor"][$key];
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
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
                <!-- Formulário de cadastro de Clientes -->
                <h2>Cadastrar Fornecedor
                    <a href="./" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                </h2>

                <form id="productForm" action="cadastrar.php" method="POST">
                    <div class="mb-3">
                        <label for="fornecedorId" class="form-label">Código do Fornecedor</label>
                        <input type="text" class="form-control" id="fornecedorId" name="fornecedorId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorRazao" class="form-label">Razão Social</label>
                        <input type="text" class="form-control" id="fornecedorRazao" name="fornecedorRazao" placeholder="EmpresaLTDA..." required value="<?php echo isset($fornecedor) ? $fornecedor["fornecedorRazao"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorCNPJ" class="form-label">CNPJ</label>
                        <input data-mask="00.000.000/0000-00" type="text" class="form-control" id="fornecedorCNPJ" name="fornecedorCNPJ" placeholder="00.000.000/0001-00" required value="<?php echo isset($fornecedor) ? $fornecedor["fornecedorCNPJ"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="fornecedorEmail" name="fornecedorEmail" placeholder="Emailexemplo@gmail.com" required value="<?php echo isset($fornecedor) ? $fornecedor["fornecedorEmail"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="fornecedorTel" class="form-label">Telefone</label>
                        <input data-mask="(00) 00000-0000" type="text" class="form-control" id="fornecedorTel" name="fornecedorTel" placeholder="(00)00000-0000" required value="<?php echo isset($fornecedor) ? $fornecedor["fornecedorTel"] : ""; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de Clientes cadastrados -->
                <h2>Fornecedores Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" style="white-space: nowrap;">Razão Social</th>
                            <th scope=" col">CNPJ</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php
                        if (!empty($_SESSION["fornecedor"])) {
                            foreach ($_SESSION["fornecedor"] as $key => $fornecedor) {
                                echo '
                                <tr>
                                    <th scope="row">' . ($key + 1) . '</th>
                                    <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $fornecedor["fornecedorRazao"] . '</td>
                                    <td style="white-space: nowrap;">' . $fornecedor["fornecedorCNPJ"] . '</td>
                                    <td style="white-space: nowrap;">' . $fornecedor["fornecedorEmail"] . '</td>
                                    <td style="white-space: nowrap;">' . $fornecedor["fornecedorTel"] . '</td>
                                        <td>
                                        
                                        
                                        <a href="./?key=' . $key . '" class="btn btn-warning">Editar</a>
                                        <a href="remover.php?key=' . $key . '" class="btn btn-danger">Excluir</a>
                                        </td>
                                </tr>
                                        ';
                            }
                        } else {
                            echo '
                            <tr>
                            <td colspan = "7">Nenhum Fornecedor cadastrado!</td>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</body>

</html>