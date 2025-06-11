<?php
include "verificar-autenticacao.php";
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
    <?php include "navbar.php"; ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-box-seam" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Produtos
                            (<?php
                                require('./requests/produtos/get.php');
                                echo isset($response['data']) ? count($response['data']) : 0; ?>)</h5>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?php echo $_SESSION['url']; ?>/produtos" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-truck" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Fornecedores (<?php echo isset($_SESSION["fornecedor"]) ? count($_SESSION["fornecedor"]) : 0; ?>)</h5>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?php echo $_SESSION['url']; ?>/fornecedores" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="bi bi-truck" style="font-size: 2rem;"></i>
                        <h5 class="card-title mt-2">Funcionários (<?php echo isset($_SESSION["funcionario"]) ? count($_SESSION["funcionario"]) : 0; ?>)</h5>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?php echo $_SESSION['url']; ?>/funcionarios" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>