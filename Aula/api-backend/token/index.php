<?php
// IMPORTA O ARQUIVO DE CABEÇALHO QUE CONTÉM 
// AS DEFINIÇÕES DE CABEÇALHO E CONFIGURAÇÕES DE ACESSO
require_once '../headers.php';

// VERIFICAR O MÉTODO DA REQUISIÇÃO
if (method == 'GET') {
    include "get.php";
};
