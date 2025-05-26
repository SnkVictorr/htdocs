<?php
session_start();

if(
isset($_COOKIE["email"]) &&
isset($_COOKIE["password"]) &&
isset($_COOKIE["remember"])
){
    $email = $_COOKIE["email"];
    $password = $_COOKIE["password"];
    $remember = "checked";
} else{
    $email = "";
    $password = "";
    $remember = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    include "mensagens.php"
    ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h2 class="text-center mt-5">Login</h2>
                <!--Action é o caminho do arquivo que vai receber os dados-->
                <form action="validar-login.php" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input value="<?php echo $email;?>" type="email" class="form-control" name="email" id="email" placeholder="Digite seu email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input value="<?php echo $password;?>" type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha">
                    </div>
                    <div class="mb-3 form-check">
                        <input <?php echo $remember;?> type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Lembrar-me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>