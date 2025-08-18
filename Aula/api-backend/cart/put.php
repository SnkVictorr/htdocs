<?php

$postfields = json_decode(file_get_contents('php://input'), true);
try {
    // Verificar se existe informações de formulário
    if (!empty($postfields)) {

        // Extrair os campos do formulário
        $id_cliente = $postfields['id_cliente'] ?? null;
        $id_produto = $postfields['id_produto'] ?? null;
        $qtde = $postfields['qtde'] ?? null;
        $preco = $postfields['preco'] ?? null;

        // Verifica campos obrigatórios
        if (empty($id_cliente) || empty($id_produto) || empty($qtde) || empty($preco)) {
            http_response_code(400);
            throw new Exception('Todos os campos são obrigatórios');
        }


        // Monta a sintaxe SQL de inserção
        $sql = "
            UPDATE cart SET 
                qtde = :qtde,
                preco = :preco
            WHERE id_cliente = :id_cliente AND id_produto = :id_produto
            ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);


        // Vincular os parâmetros
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt->bindParam(':qtde', $qtde, PDO::PARAM_INT);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        // Executar a sintaxe SQL
        $stmt->execute();
    } else {
        throw new Exception('Nenhum dado foi enviado!', 400);
    }
    $result = array(
        'status' => 'success',
        'message' => 'Produto atualizado no carrinho com sucesso!'
    );
} catch (Exception $e) {
    $code = !empty($e->getCode()) ? $e->getCode() : 400; // Define o código de status HTTP
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
