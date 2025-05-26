<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {

        $categoria_id = $postfields['categoria_id'] ?? null;
        $marca_id = $postfields['marca_id'] ?? null;
        $nome = $postfields['productName'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $desconto = $postfields['desconto'] ?? null;
        $estoque = $postfields['estoque'] ?? null;
        $image_url = $postfields['image_url'] ?? null;


        // Verifica campos obrigatórios
        if (empty($nome) || empty($postfields['endereco'])) {
            http_response_code(400);
            throw new Exception('Nome e Endereço são obrigatórios');
        }

        $sql = "INSERT INTO produto (categoria_id, marca_id, nome, descricao, preco, desconto, estoque, image_url) VALUES
        (:categoria_id, :marca_id, :nome, :descricao, :preco, :desconto, :estoque, :image_url)
       ";




        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);

        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Produto cadastrado com sucesso!'
        );
    } else {
        http_response_code(400);
        // Se não existir dados, retornar erro
        throw new Exception('Nenhum dado foi enviado!');
    }
} catch (Exception $e) {
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
