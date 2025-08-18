<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {
        $id = $postfields['id_produto'] ?? null;
        $id_categoria = $postfields['id_categoria'] ?? null;
        $id_marca = $postfields['id_marca'] ?? null;
        $produto = $postfields['produto'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $desconto = $postfields['desconto'] ?? null;
        $estoque = $postfields['estoque'] ?? null;
        $imagem = $postfields['imagem'] ?? null;



        // Verifica campos obrigatórios
        if (empty($id)) {
            http_response_code(400);
            throw new Exception('ID do cliente é obrigatório');
        }
        if (empty($produto) || empty($postfields['id_marca'])) {
            http_response_code(400);
            throw new Exception('Marca e produto são obrigatórios');
        }

        $sql = "
        UPDATE produtos SET 
            id_categoria = :id_categoria,
            id_marca = :id_marca,
            produto = :produto,
            descricao = :descricao,
            estoque = :estoque, 
            preco = :preco,
            desconto = :desconto,
            imagem = :imagem
        WHERE id_produto = :id
        ";



        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->bindParam(':id_marca', $id_marca, PDO::PARAM_INT);
        $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
        $stmt->bindParam(':imagem', $imagem, PDO::PARAM_STR);


        $stmt->execute();

        $result = array(
            'status' => 'success',
            'message' => 'Cliente alterado com sucesso!'
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
