<?php

try {

    if ($_GET["id_cliente"] && is_numeric($_GET["id_cliente"])) {
        $id_cliente = $_GET["id_cliente"];


        if (empty($id_cliente)) {
            http_response_code(400);
            throw new Exception('ID do cliente');
        }

        if ($_GET["id_produto"] && is_numeric($_GET["id_produto"])) {

            $id_produto = $_GET["id_produto"];
            if (empty($id_produto)) {
                http_response_code(400);
                throw new Exception('ID do produto');
            }

            // Monta a sintaxe SQL de busca
            $sql = "
            DELETE FROM cart
            WHERE id_cliente = :id_cliente AND id_produto = :id_produto
        ";

            $stmt = $conn->prepare($sql);
            // Vincular o parâmetro :id_cliente com o valor da variável $id_cliente
            $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        } else {
            // Monta a sintaxe SQL de busca
            $sql = "
            DELETE FROM cart
            WHERE id_cliente = :id_cliente
        ";

            $stmt = $conn->prepare($sql);
        }





        // Vincular o parâmetro :id_cliente com o valor da variável $id_cliente
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);


        // Executar a sintaxe SQL
        $stmt->execute();
        // Verifica se a inserção foi bem-sucedida
        if ($stmt->rowCount() == 0) {
            http_response_code(400);
            throw new Exception('Erro ao remover produto do carrinho');
        }
        $result = array(
            'status' => 'success',
            'message' => 'Produto removido do carrinho com sucesso!'
        );
    } else {
        http_response_code(400);
        throw new Exception('ID do cliente e do produto são obrigatórios');
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
