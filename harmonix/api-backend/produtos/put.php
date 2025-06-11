<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {
        $id = $postfields['produto_id'] ?? null;
        $categoria_id = $postfields['categoria_id'] ?? null;
        $marca_id = $postfields['marca_id'] ?? null;
        $produto = $postfields['produto'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $desconto = $postfields['desconto'] ?? null;
        $estoque = $postfields['estoque'] ?? null;
        $image_url = $postfields['image_url'] ?? null;



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
        UPDATE produto SET 
            categoria_id = :categoria_id
            marca_id = :marca_id
            produto = :produto,
            descricao = :descricao,
            estoque = :estoque, 
            preco = :preco
            desconto = :desconto
            image_url = :image_url,
        WHERE produto_id = :id
        ";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->bindParam(':marca_id', $marca_id, PDO::PARAM_INT);
        $stmt->bindParam(':produto', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':desconto', $desconto, PDO::PARAM_STR);
        $stmt->bindParam(':estoque', $estoque, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_STR);


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
