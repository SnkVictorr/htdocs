<?php


define('DB_HOST', 'localhost'); // Servidor do banco de dados
define('DB_USER', 'root'); // Usuário do banco de dados
define('DB_PASS', 'senha123'); // Senha do banco de dados
define('DB_NAME', 'harmonix'); // Nome do banco de dados


try {

    // Create connection
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Define o modo de erro do PDO para exceções
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
