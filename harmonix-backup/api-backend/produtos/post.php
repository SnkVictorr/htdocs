<?php


try {
    $postfields = json_decode(file_get_contents('php://input'), true);

    if (!empty($postfields)) {

        $categoria_id = $postfields['categoria_id'] ?? null;
        $marca_id = $postfields['marca_id'] ?? null;
        $produto = $postfields['produto'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $desconto = $postfields['desconto'] ?? null;
        $estoque = $postfields['estoque'] ?? null;
        $image_url = $postfields['image_url'] ?? null;

        // Verifica campos obrigatórios
        if (empty($produto) || empty($preco) || empty($categoria_id) || empty($marca_id) || empty($desconto) || empty($desconto) || empty($image_url) || empty($estoque)) {
            http_response_code(400);
            throw new Exception('Todos os campos são obrigatórios');
        }

        $sql = "INSERT INTO produto (categoria_id, marca_id, produto, descricao, estoque, preco, desconto,  image_url) VALUES
        (:categoria_id, :marca_id, :produto, :descricao,:estoque, :preco,  :desconto,  :image_url)
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
