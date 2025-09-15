<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

    // Verificar se existe informações de formulário
    if (!empty($postfields)) {
        // Extrair os campos do formulário
        $id_cliente = $postfields['id_cliente'] ?? null;
        $status = $postfields['status'] ?? null;

        // Verifica campos obrigatórios
        if (empty($id_cliente) || empty($status)) {
            http_response_code(400);
            throw new Exception('Todos os campos são obrigatórios');
        }




        $insert = $conn->prepare("INSERT INTO pedidos (id_cliente, status) VALUES (?, ?, ?)");
        $insert->execute([$id_cliente, $data, $status]);

        $result = array(
            'status' => 'success'
        );

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->rowCount() == 0) {
            http_response_code(400);
            $result = "erro";
            throw new Exception('Erro ao adicionar produto ao pedidos');
        }

        // 201 - Created
        http_response_code(201);
        $result = array(
            'status' => 'success',
            'message' => 'Produto adicionado ao pedidos com sucesso!'
        );
    } else {
        throw new Exception('Nenhum dado foi enviado!', 400);
    }
} catch (Exception $e) {
    $code = !empty($e->getCode()) ? $e->getCode() : 400; // Define o código de status HTTP
    // http_response_code($code); // Define o código de status HTTP
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
