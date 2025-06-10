<?php
//isset verifica se a variavel "não" existe
//verifica se a variavel existe, mas é false
session_start();
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] == false) {

    header("Location: " . $_SESSION['url'] . "http://localhost:8000/tela-login.php");
    exit;
}
//verificar se expirou tempo limite de inatividade
else {
    $tempo_login = $_SESSION["tempo_login"];
    $tempo_agora = time();
    $tempo_limite = 30000; //segundos
    $tempo_expirado = $tempo_login + $tempo_limite;

    if ($tempo_agora <= $tempo_expirado) {
        //significa que pode continuar usando o sistema
        $_SESSION["tempo_login"] = time();
    } else {
        $_SESSION["msg"] = "Tempo excedido! Realize o login novamente.";
        unset($_SESSION["autenticado"]);
        header("Location: " . $_SESSION['url'] . "/tela-login.php");
    }
}
