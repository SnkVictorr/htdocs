<?php

if (isset($key) && is_numeric($key)) {
    // Se a chave for numérica, significa que é uma requisição específica
    $url = "http://localhost:8080/fornecedores/?id=" . $key;
} else {
    // Caso contrário, é uma requisição para todos os fornecedores
    $url = "http://localhost:8080/fornecedores/";
}

// INICIAR SESSÃO GLOBAL
$curl = curl_init();
// CONFIGURAR O CURL
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
));
// RECUPERA O RETORNO DO CURL
$response = curl_exec($curl);
// ENCERRAR O CURL
curl_close($curl);

if (empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}
