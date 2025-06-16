<?php


try {
    $postfields = json_decode(file_get_contents('php://input'), true);

    if (!empty($postfields)) {

        $id_categoria = $postfields['id_categoria'] ?? null;
        $id_marca = $postfields['id_marca'] ?? null;
        $produto = $postfields['produto'] ?? null;
        $descricao = $postfields['descricao'] ?? null;
        $preco = $postfields['preco'] ?? null;
        $desconto = $postfields['desconto'] ?? null;
        $estoque = $postfields['estoque'] ?? null;
        $imagem = $postfields['imagem'] ?? null;

        // Verifica campos obrigatórios
        if (empty($produto) || empty($preco) || empty($id_categoria) || empty($id_marca) || empty($desconto) || empty($desconto) || empty($imagem) || empty($estoque)) {
            http_response_code(400);
            throw new Exception('Todos os campos são obrigatórios');
        }

        $sql = "INSERT INTO produtos (id_categoria, id_marca, produto, descricao, estoque, preco, desconto,  imagem) VALUES
        (:id_categoria, :id_marca, :produto, :descricao,:estoque, :preco,  :desconto,  :imagem)
       ";



        $stmt = $conn->prepare($sql);

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
