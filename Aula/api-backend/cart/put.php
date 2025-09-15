<?php

$postfields = json_decode(file_get_contents('php://input'), true);
try {
    // Verificar se existe informações de formulário
    if (!empty($postfields)) {

        // Extrair os campos do formulário
        $id_cart = $postfields['id_cart'] ?? null;
        $qtde = $postfields['qtde'] ?? 0;





        // Verifica campos obrigatórios
        if (empty($id_cart)) {
            http_response_code(400);
            throw new Exception('Todos os campos são obrigatórios');
        }

        if ($qtde == 0) {
            $sql = "DELETE FROM cart WHERE id_cart = :id_cart";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id_cart', $id_cart, PDO::PARAM_INT);;
        } else {

            // Monta a sintaxe SQL de inserção
            $sql = "
            UPDATE cart SET 
                qtde = :qtde
            WHERE id_cart = :id_cart
            ";

            // Preparar a sintaxe SQL
            $stmt = $conn->prepare($sql);


            // Vincular os parâmetros
            $stmt->bindParam(':id_cart', $id_cart, PDO::PARAM_INT);
            $stmt->bindParam(':qtde', $qtde, PDO::PARAM_INT);
        }


        // Executar a sintaxe SQL
        $stmt->execute();
    } else {
        throw new Exception('Nenhum dado foi enviado!', 400);
    }
    $result = array(
        'status' => 'success',
        'message' => 'Item alterado com sucesso!'
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
