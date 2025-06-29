<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {

        $nome = $postfields['nome'] ?? null;
        $razaoSocial = $postfields['razaoSocial'] ?? null;
        $cnpj = $postfields['cnpj'] ?? null;
        $email = $postfields['email'] ?? null;
        $telefone = $postfields['telefone'] ?? null;
        $logradouro = $postfields['endereco']['logradouro'] ?? null;
        $numero = $postfields['endereco']['numero'] ?? null;
        $complemento = $postfields['endereco']['complemento'] ?? null;
        $bairro = $postfields['endereco']['bairro'] ?? null;
        $cidade = $postfields['endereco']['cidade'] ?? null;
        $estado = $postfields['endereco']['estado'] ?? null;
        $cep = $postfields['endereco']['cep'] ?? null;

        // Verifica campos obrigatórios
        if (empty($nome) || empty($postfields['endereco'])) {
            http_response_code(400);
            throw new Exception('Nome e Endereço são obrigatórios');
        }

        $sql = "
        INSERT INTO fornecedores (nome, razao_social, cnpj, telefone, email, logradouro, numero, complemento, bairro, cidade, estado, cep) VALUES 
        (
            :nome,
            :razaoSocial,
            :cnpj,
            :telefone,
            :email,  
            :logradouro, 
            :numero, 
            :complemento, 
            :bairro, 
            :cidade,
            :estado,
            :cep
        )";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':razaoSocial', $razaoSocial, PDO::PARAM_STR);
        $stmt->bindParam(':cnpj', $cnpj, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':complemento', $complemento, is_null($complemento) ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cep', $cep);

        $stmt->execute();

        // 201 - Created
        http_response_code(201);
        $result = array(
            'status' => 'success',
            'message' => 'Fornecedor cadastrado com sucesso!'
        );
    } else {

        throw new Exception('Nenhum dado foi enviado!', 400);
    }
} catch (Exception $e) {
    $code = !empty($e->getCode()) ? $e->getCode() : 500; // Define o código de status HTTP
    http_response_code($code); // Define o código de status HTTP
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => $e->getMessage(),
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
