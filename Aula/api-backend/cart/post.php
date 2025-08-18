<?php

try {
    // Recuperar informações de formulário vindo do Frontend
    $postfields = json_decode(file_get_contents('php://input'), true);

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



        $check = $conn->prepare("SELECT id_cart FROM cart WHERE id_cliente = ? AND id_produto = ?");
        $check->execute([$id_cliente, $id_produto]);
        $data = $check->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $update = $conn->prepare("UPDATE cart SET qtde = qtde + ? WHERE id_cliente = ? AND id_produto = ?");
            $update->execute([$qtde, $id_cliente, $id_produto]);
        } else {
            $insert = $conn->prepare("INSERT INTO cart (id_cliente, id_produto, qtde) VALUES (?, ?, ?)");
            $insert->execute([$id_cliente, $id_produto, $qtde]);
        }
        $result = array(
            'status' => 'success'
        );

        // Verifica se a inserção foi bem-sucedida
        if ($stmt->rowCount() == 0) {
            http_response_code(400);
            throw new Exception('Erro ao adicionar produto ao cart');
        }

        // 201 - Created
        http_response_code(201);
        $result = array(
            'status' => 'success',
            'message' => 'Produto adicionado ao cart com sucesso!'
        );
    } else {
        throw new Exception('Nenhum dado foi enviado!', 400);
    }
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
