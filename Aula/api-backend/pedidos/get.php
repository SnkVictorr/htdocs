<?php

try {
    if (isset($_GET["id_cliente"]) && is_numeric($_GET["id_cliente"])) {
        $id_cliente = $_GET["id_cliente"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT pd.id_cliente,
            GROUP_CONCAT(
                JSON_OBJECT(
                    'id_produto', p.id_produto,
                    'produto', p.produto,
                    'qtde', pd.qtde,
                    'preco', pd.preco
                )
            ) AS produtos,
            SUM(pd.qtde) AS qtde_total,
             SUM(p.preco) AS preco_total
             FROM pedidos AS pd
             JOIN produtos AS p ON pd.id_produto = p.id_produto
             WHERE pd.id_cliente = :id_cliente
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
