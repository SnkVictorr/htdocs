<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {

        // Extrair os campos do formulário
        $produto = $postfields['produto'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $id_marca = $postfields['id_marca'] ?? null;
        $imagem = $postfields['imagem'] ?? null;
        $quantidade = $postfields['quantidade'] ?? null;
        $preco = $postfields['preco'] ?? null;


        // Verifica campos obrigatórios
        if (empty($produto) || empty($postfields['id_marca'])) {
            http_response_code(400);
            throw new Exception('Nome e Marcas são obrigatórios');
        }

        $sql = "
        INSERT INTO produtos (produto, descricao, id_marca, imagem, quantidade, preco) VALUES 
        (
            :produto,
            :descricao,
            :id_marca,
            :imagem,
            :quantidade,  
            :preco
        )";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco);

        $stmt->execute();

        // 201 - Created
        http_response_code(201);
        $result = array(
            'status' => 'success',
            'message' => 'Produtos cadastrado com sucesso!'
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
