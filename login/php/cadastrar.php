<?php

require_once "Usuario.class.php";

$usuario = new Usuario();
$usuario->conectar();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome  = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if($usuario->inserirUsuario($nome, $email, $senha)){
        echo "Usuário cadastrado com sucesso!";
    }else{
        echo "Erro ao cadastrar usuário!";
    }
}

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/cadastrar.css">
    <title>Tela de Login</title>
</head>

<body>
    <main>
        <div class="banners">
            <img src="../img/banner2.png" alt="banner" class="banner">
        </div>

        <div class="containers">
            <div class="container-login">
                <div class="logo">
                    <a href="cadastrar.php"><img src="../img/logo_instagram.png" alt="logo-instagram"
                            class="logo-instagram"></a>
                </div>
                <form id="meuFormulario" method="POST">
                    <input type="text" name="nome" id="nome" placeholder="Nome de usuário" required>
                    <input type="email" name="email"  id="email" placeholder="E-mail" required>
                    <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    <div class="login-btn">
                        <button type="submit">Cadastre-se</button>
                    </div>
                </form>
                <div class="login-facebook">
                    <img src="../img/logo_facebook.svg" alt="logo-facebook" class="logo-facebook">
                        <a href="#" class="link-facebook">Entrar com o Facebook</a>
                </div>
                <div class="forgot-password">
                    <a href="#" class="text-forgot-password">Esqueceu a senha?</a>
                </div>
            </div>

            <div class="container-login2">
                <p>Já tem uma conta? <a href="../php/login.php" class="register">Entrar</a></p>
            </div>

            <div class="container-login-bottom">
                <p>Obtenha o aplicativo.</p>
                    <div class="imgs">
                        <img src="../img/apple_btn.png" alt="apple-banner" class="banner-app">
                        <img src="../img/gplay_btn.png" alt="googleplay-banner" class="banner-app">
                    </div>
            </div>
        </div>
    </main>
</body>

</html>