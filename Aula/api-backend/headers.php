<?php
// Conecta-se ao banco de dados
require_once 'conn.php';

// Define as configurações de cabeçalho para permitir o acesso à API
header('Access-Control-Allow-Origin: *'); // Permite acesso de qualquer origem
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); // Permite métodos HTTP específicos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Permite cabeçalhos específicos
header('Access-Control-Allow-Credentials: true'); // Permite o envio de cookies e credenciais
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de conteúdo como JSON

// Define uma constante com o método HTTP da requisição
define('method', $_SERVER['REQUEST_METHOD']);

// Recupera informações do cabeçalho da requisição
$server = apache_request_headers();

// Recupera o token de autorização do cabeçalho
$token = $server['Authorization'] ?? null;

// Verifica se o token de autorização está presente
if ($token === null) {
    http_response_code(400);
    $result = array(
        'status' => 'error',
        'message' => 'Authorization token is required'
    );
    echo json_encode($result);
    exit;
} else {
    // Monta a sintaxe SQL de busca
    // SHA1 está sendo usado para diferenciar maiusculas de minusculas atraves de criptografia
    $sql = "
    SELECT cliente, validade, status
    FROM token
    WHERE SHA1(token) = SHA1(:token)
    ";

    // Preparar a sintaxe SQL
    $stmt = $conn->prepare($sql);
    // Vincular o parâmetro :token com o valor da variável $token
    $stmt->bindParam(':token', $token, PDO::PARAM_STR);

    // Executar a sintaxe SQL
    $stmt->execute();
    // Obter os dados do banco de dados como objeto

    $data = $stmt->fetch(PDO::FETCH_OBJ);

    // Verifica se o resultado da pesquisa é vazio
    if (empty($data)) {
        // Se o resultado for vazio, retorna um erro
        http_response_code(401);
        $result = array(
            'status' => 'error',
            'message' => 'Invalid authorization token'
        );
        echo json_encode($result);
        exit;
    } else {


        // SE usasse fetchAll Seria $data[0]
        // Se for 0 o token esta inativo
        if ($data->status == 0) {
            http_response_code(401); // Unauthorized
            $result = array(
                'status' => 'error',
                'message' => 'Token is inactive'
            );
            echo json_encode($result);
            exit;
        }
        // Verifica se o token expirou
        elseif (strtotime($data->validade) < strtotime(date('Y-m-d'))) {
            http_response_code(401);
            $result = array(
                'status' => 'error',
                'message' => 'Token has expired'
            );
            echo json_encode($result);
            exit;
        }
    }
}
