<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // SE HOUVER KEY, BUSCA O CLIENTE NO BANCO DE DADOS
    require("../requests/fornecedores/get.php");
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e unico cliente na posição [0]
        $fornecedor = $response["data"][0];
    } else {
        $fornecedor = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Fornecedores</title>
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
                <div class="card"> <!-- Formulário de cadastro de fornecedores -->
                    <div class="card-header">
                        <h2>
                            Cadastrar Fornecedor
                            <a href="/fornecedores/formulario.php" class="btn btn-primary btn-sm">Novo Fornecedor</a>
                        </h2>
                    </div>


                    <div class="card-body">
                        <form id="fornecedorForm" action="/fornecedores/cadastrar.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="fornecedorId" class="form-label">Código do Fornecedor</label>
                                    <input type="text" class="form-control" id="fornecedorId" name="fornecedorId" readonly value="<?php echo isset($fornecedor) ? $fornecedor['id_fornecedor'] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-8">
                                    <label for="fornecedorName" class="form-label">Nome Fantasia</label>
                                    <input onblur="teste()" type="text" class="form-control" id="fornecedorName" name="fornecedorName" required value="<?php echo isset($fornecedor) ? $fornecedor["nome"] : ""; ?>">
                                </div>

                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-7">
                                    <label for="razaoSocial" class="form-label">Razao Social</label>
                                    <input onblur="teste()" type="text" class="form-control" id="razaoSocial" name="razaoSocial" required value="<?php echo isset($fornecedor) ? $fornecedor["razao_social"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for="fornecedorCNPJ" class="form-label">CNPJ</label>
                                    <input data-mask="00.000.000/0000-00" type="text" class="form-control" id="fornecedorCNPJ" name="fornecedorCNPJ" required value="<?php echo isset($fornecedor) ? $fornecedor["cnpj"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-5">
                                    <label for="fornecedorEmail" class="form-label">E-mail</label>
                                    <input type="email" class="form-control" id="fornecedorEmail" name="fornecedorEmail" required value="<?php echo isset($fornecedor) ? $fornecedor["email"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="fornecedorTelefone" class="form-label">Telefone</label>
                                    <input data-mask="(00) 0000-0000" type="text" class="form-control" id="fornecedorTelefone" name="fornecedorTelefone" required value="<?php echo isset($fornecedor) ? $fornecedor["telefone"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="fornecedorCEP" class="form-label">CEP</label>
                                    <input data-mask="00000-000" type="text" class="form-control" id="fornecedorCEP" name="fornecedorCEP" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cep"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="fornecedorAddress" class="form-label">Logradouro</label>
                                    <input type="text" class="form-control" id="fornecedorAddress" name="fornecedorAddress" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["logradouro"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="fornecedorNumber" class="form-label">Número</label>
                                    <input type="text" class="form-control" id="fornecedorNumber" name="fornecedorNumber" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["numero"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="fornecedorComplement" class="form-label">Complemento</label>
                                    <input type="text" class="form-control" id="fornecedorComplement" name="fornecedorComplement" value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["complemento"] : ""; ?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-5">
                                    <label for="fornecedorNeighborhood" class="form-label">Bairro</label>
                                    <input type="text" class="form-control" id="fornecedorNeighborhood" name="fornecedorNeighborhood" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["bairro"] : ""; ?>">
                                </div>
                                <div class="mb-3 col-md-5">
                                    <label for=" fornecedorCity" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="fornecedorCity" name="fornecedorCity" required value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cidade"] : ""; ?>" readonly>
                                </div>
                                <div class="mb-3 col-md-2">
                                    <label for="fornecedorState" class="form-label">Estado (UF)</label>
                                    <select class="form-select" id="fornecedorState" name="fornecedorState" required>
                                        <option value="">Selecione um estado</option>
                                        <?php
                                        $ufs = [
                                            "AC",
                                            "AL",
                                            "AP",
                                            "AM",
                                            "BA",
                                            "CE",
                                            "DF",
                                            "ES",
                                            "GO",
                                            "MA",
                                            "MT",
                                            "MS",
                                            "MG",
                                            "PA",
                                            "PB",
                                            "PR",
                                            "PE",
                                            "PI",
                                            "RJ",
                                            "RN",
                                            "RS",
                                            "RO",
                                            "RR",
                                            "SC",
                                            "SP",
                                            "SE",
                                            "TO"
                                        ];
                                        foreach ($ufs as $uf) {
                                            $selected = (isset($fornecedor) && $fornecedor["endereco"]["estado"] === $uf) ? "selected" : "";
                                            echo "<option value='$uf' $selected>$uf</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                    </div>

                    <div class="card-footer">
                        <a href="./" class="btn btn-danger ">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $('#fornecedorCEP').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, '');
            // Verifica se o CEP tem 8 dígitos
            if (cep.length === 8) {
                // Faz a requisição para a API ViaCEP
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                    if (!data.erro) {
                        $('#fornecedorAddress').val(data.logradouro);
                        $('#fornecedorNeighborhood').val(data.bairro);
                        $('#fornecedorCity').val(data.localidade);
                        $('#fornecedorState').val(data.uf);
                    } else {
                        alert('CEP não encontrado.');
                        $("#fornecedorCEP").val("");
                        $("#fornecedorAddress").val("");
                        $("#fornecedorNeighborhood").val("");
                        $("#fornecedorCity").val("");
                        $("#fornecedorState").val("");
                    }
                });
            } else {
                alert('Formato de CEP inválido.');
                // Limpa os campos de endereço
                $("#fornecedorCEP").val("");
                $("#fornecedorAddress").val("");
                $("#fornecedorNeighborhood").val("");
                $("#fornecedorCity").val("");
                $("#fornecedorState").val("");
            }
        });
    </script>

</body>

</html>