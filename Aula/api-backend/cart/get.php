<?php

try {
    if (isset($_GET["id_cliente"]) && is_numeric($_GET["id_cliente"])) {
        $id_cliente = $_GET["id_cliente"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM cart
            WHERE id_cliente = :id_cliente
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :id_cliente com o valor da variável $id_cliente
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    }


    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(204);
        exit;
    } else {

        $result = array(
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        );
    }
} catch (Exception $e) {
    // Se houver erro, retorna o erro
    $result = array(
        'status' => 'error',
        'message' => 'Error: ' . $e->getMessage()
    );
} finally {
    // Retorna os dados em formato JSON
    echo json_encode($result);
    // Fecha a conexão com o banco de dados
    $conn = null;
}
