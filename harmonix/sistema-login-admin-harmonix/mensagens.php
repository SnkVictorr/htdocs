<?php
if (isset($_SESSION["msg"])) {
    //se houver mensagem de erro, exibir texto
    echo '
        <div class="alert alert-success" role="alert">
            ' . $_SESSION["msg"] . '
        </div>
        ';
    unset($_SESSION["msg"]);
}
