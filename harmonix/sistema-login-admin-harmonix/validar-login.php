<?php
session_start(); //permite trabalhar com variaveis globais
//EXIBIR DADOS DO ARRAY
// var_dump($_POST);

if ($_POST) {
    //Armazena os dados digitados na tela de login
    $email = $_POST["email"];
    $password = $_POST["password"];
    $remember = $_POST["remember"] ?? "off";

    //Verifica se o email e senha estão corretos
    if ($email == "admin@admin" && $password == "1234") {
        $_SESSION["autenticado"] = true; //cria variavel global
        $_SESSION["tempo_login"] = time(); //cria variavel com tempo de login

        if ($remember == "on") {
            setcookie("email", $email);
            setcookie("password", $password);
            setcookie("remember", $remember);
        } else {
            setcookie("email");
            setcookie("password");
            setcookie("remember");
        }

        $_SESSION['url'] = "http://localhost:8000";
        header("Location: ./index.php");
    } else {
        $_SESSION['msg'] = "Email ou senha inválidos";
        header("Location: ./tela-login.php");
    }
} else {
    //Redireciona para tela de login
    header("Location: ./tela-login.php");
}
