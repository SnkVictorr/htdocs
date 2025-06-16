<?php
try {

    // Verifica se há um ID na URL para consulta específica
    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT *
            FROM categorias
            WHERE id_categoria = :id
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :id com o valor da variável $id
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    // Verifica se há um Produto na URL para consulta
    elseif (isset($_GET["categoria"]) && is_string($_GET["categoria"])) {
        $categoria = $_GET["categoria"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT *
            FROM categorias
            WHERE categoria LIKE :categoria
            ORDER BY categoria
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
        // Vincular o parâmetro :nome com o valor da variável $nome
        $stmt->bindValue(':categoria', '%' . $categoria . '%', PDO::PARAM_STR);
    } else {
        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT *
            FROM categorias
            ORDER BY categoria
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);
    }

    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto
    $data = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Verifica se o resultado da pesquisa é vazio
    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(204);
        exit;
    } else {
        // Se houver dados, retorna os dados
        $result = array(
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        );
    };
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
