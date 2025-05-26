<?php
include "../verificar-autenticacao.php";

//Indica qual página está
$pagina = "funcionarios";
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $funcionario = $_SESSION["funcionario"][$key];
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Funcionários</title>
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
                <!-- Formulário de cadastro de Funcionários -->
                <h2>Cadastrar Funcionário
                    <a href="./" class="btn btn-primary btn-sm">Novo Funcionário</a>
                </h2>

                <form id="employeeForm" action="cadastrar.php" method="POST">
                    <div class="mb-3">
                        <label for="funcionarioId" class="form-label">Código do Funcionário</label>
                        <input type="text" class="form-control" id="funcionarioId" name="funcionarioId" readonly value="<?php echo isset($key) ? $key : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="funcionarioNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="funcionarioNome" name="funcionarioNome" placeholder="Nome Completo" required value="<?php echo isset($funcionario) ? $funcionario["funcionarioNome"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="funcionarioCPF" class="form-label">CPF</label>
                        <input data-mask="000.000.000-00" type="text" class="form-control" id="funcionarioCPF" name="funcionarioCPF" placeholder="000.000.000-00" required value="<?php echo isset($funcionario) ? $funcionario["funcionarioCPF"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="funcionarioCargo" class="form-label">Cargo</label>
                        <input type="text" class="form-control" id="funcionarioCargo" name="funcionarioCargo" placeholder="Cargo do Funcionário" required value="<?php echo isset($funcionario) ? $funcionario["funcionarioCargo"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="funcionarioSalario" class="form-label">Salário</label>
                        <div class="input-group">

                            <input type="text" class="form-control" id="funcionarioSalario" name="funcionarioSalario" required value="<?php echo isset($funcionario) ? number_format($funcionario["funcionarioSalario"], 2, ',', '.') : ''; ?>" placeholder="0,00">
                        </div>
                    </div>
                    <script>
                        document.getElementById("funcionarioSalario").addEventListener("input", function(e) {
                            let value = e.target.value.replace(/\D/g, ""); // Remove tudo que não for número
                            if (value) { // Aplica formatação somente se houver número
                                value = (parseFloat(value) / 100).toLocaleString("pt-BR", {
                                    style: "currency",
                                    currency: "BRL"
                                });
                                e.target.value = value;
                            } else {
                                e.target.value = ""; // Limpa o campo se não houver número
                            }
                        });
                    </script>
                    <div class="mb-3">
                        <label for="funcionarioEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="funcionarioEmail" name="funcionarioEmail" placeholder="Emailexemplo@gmail.com" required value="<?php echo isset($funcionario) ? $funcionario["funcionarioEmail"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="funcionarioTel" class="form-label">Telefone</label>
                        <input data-mask="(00) 00000-0000" type="text" class="form-control" id="funcionarioTel" name="funcionarioTel" placeholder="(00)00000-0000" required value="<?php echo isset($funcionario) ? $funcionario["funcionarioTel"] : ""; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <!-- Tabela de Funcionários cadastrados -->
                <h2>Funcionários Cadastrados</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Nome</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Salário</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefone</th>
                        </tr>
                    </thead>
                    <tbody id="employeeTableBody">
                        <?php
                        if (!empty($_SESSION["funcionario"])) {
                            foreach ($_SESSION["funcionario"] as $key => $funcionario) {
                                echo '
                                <tr>
                                    <th scope="row">' . ($key + 1) . '</th>
                                    <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $funcionario["funcionarioNome"] . '</td>
                                    <td style="white-space: nowrap;">' . $funcionario["funcionarioCPF"] . '</td>
                                    <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $funcionario["funcionarioCargo"] . '</td>
                                    <td style="white-space: nowrap;"> ' . $funcionario["funcionarioSalario"] . '</td>
                                    <td style="max-width: 100px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">' . $funcionario["funcionarioEmail"] . '</td>
                                    <td style="white-space: nowrap;">' . $funcionario["funcionarioTel"] . '</td>
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
                            <td colspan = "7">Nenhum Funcionário cadastrado!</td>
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