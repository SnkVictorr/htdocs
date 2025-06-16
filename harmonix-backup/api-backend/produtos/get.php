<?php
try {


    if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
        $id = $_GET["id"];


        $sql = "
            SELECT * 
            FROM produto
            JOIN marca ON produto.marca_id = marca.marca_id
            JOIN categoria ON produto.categoria_id = categoria.categoria_id
            WHERE produto_id = :id
        ";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    } elseif (isset($_GET["produto"]) && is_string($_GET["produto"])) {
        $produto = $_GET["produto"];


        $sql = "
            SELECT * 
            FROM produto
            JOIN marca ON produto.marca_id = marca.marca_id
            JOIN categoria ON produto.categoria_id = categoria.categoria_id
            WHERE produto LIKE :produto
        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':produto', '%' . $produto . '%', PDO::PARAM_STR);
    } elseif (isset($_GET["marca_id"]) && is_string($_GET["marca_id"])) {
        $marca_id = $_GET["marca_id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM produto
            JOIN marca ON produto.marca_id = marca.marca_id
            WHERE marca_id = :marca_id

        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':marca_id', '%' . $marca_id . '%', PDO::PARAM_STR);
    } elseif (isset($_GET["categoria_id"]) && is_string($_GET["categoria_id"])) {
        $categoria_id = $_GET["categoria_id"];

        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM produto
            JOIN categoria ON produto.categoria_id = categoria.categoria_id
            WHERE categoria_id = :categoria_id

        ";

        // Preparar a sintaxe SQL
        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':categoria_id', '%' . $categoria_id . '%', PDO::PARAM_STR);
    } else {
        // Monta a sintaxe SQL de busca
        $sql = "
            SELECT * 
            FROM produto
            JOIN marca ON produto.marca_id = marca.marca_id
            JOIN categoria ON produto.categoria_id = categoria.categoria_id
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
exit;


// // VERIFICAR SE O ID FOI PASSADO NA URL E SE É UM NÚMERO
// if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
//     $id = $_GET["id"];
//     // BUSCAR O CLIENTE COM O ID PASSADO NA URL
//     $found = false;
//     foreach ($data as $produto) {
//         if ($produto->id == $id) {
//             $data = $produto;
//             $found = true;
//             break;
//         }
//     }
//     // SE O CLIENTE NÃO FOI ENCONTRADO, RETORNAR UM ERRO
//     // $data = $found ? $data : null;
//     if (!$found) {
//         http_response_code(204);
//     }
// } elseif (isset($_GET["produto"]) && is_string($_GET["produto"])) {
//     $produto = $_GET["produto"];
//     $result = array();
//     // BUSCAR O CLIENTE COM O ID PASSADO NA URL
//     $found = false;
//     foreach ($data as $produto) {
//         if (stripos($produto->produto, $produto) !== false) {
//             $result[] = $produto;
//             $found = true;
//         }
//     }
//     // SE O produto NÃO FOI ENCONTRADO, RETORNAR UM ERRO
//     // $data = $found ? $data : null;
//     if (!$found) {
//         http_response_code(204);
//     } else {
//         $data = $result;
//     }
// }

// echo json_encode(
//     array(
//         'status' => 'success',
//         'message' => 'GET method called',
//         'data' => $data
//     )
// );
