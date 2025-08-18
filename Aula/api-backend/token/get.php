<?php
try {

    // Verifica se há um Token na URL para consulta específica
    if (isset($_GET["token"]) && is_string($_GET["token"])) {
        $token = urldecode($_GET["token"]);

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT cliente, validade, status
            FROM token
            WHERE SHA1(token) = SHA1(:token)
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :token com o valor da variável $token
        $stmt->bindParam(':token', $token, PDO::PARAM_STR);
    } else {
        http_response_code(400);
        $result = array(
            'status' => 'error',
            'message' => "Token in Required"
        );
        echo json_encode($result);
        exit;
    }

    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto

    $data = $stmt->fetch(PDO::FETCH_OBJ);

    // Verifica se o resultado da pesquisa é vazio
    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(204);
        exit;
    } else {


        // SE usasse fetchAll Seria $data[0]
        if ($data->status == 0) {
            $result = array(
                'status' => 'error',
                'message' => 'Token is inactive'
            );
        } elseif (strtotime($data->validade) < strtotime(date('Y-m-d'))) {
            $result = array(
                'status' => 'error',
                'message' => 'Token has expired'
            );
        }
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
exit;
