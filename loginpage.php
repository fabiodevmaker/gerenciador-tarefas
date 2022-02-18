<?php
$_GET['key'] = "Dados Incorretos!";
$error = $_GET['key'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styletask.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+4&display=swap" rel="stylesheet">
    <title>Tela de login</title>
</head>
<body>
<div class="container">
    <p class="errorlogin" ></p>
    <div class="header">
        <center><h1> Login </h1></center>
        <br>
    </div>
    <form action="login.php" method="POST">
        <p><label>* Login:</label></p>
        <input type="text" name="login" id="login" autocomplete="off">
        <p><label>* Senha:</label></p>
        <input type="password" name="senha" id="senha">
        <br><br><p><button class="logar" type="submit" name="logar" value="logar" id="logar">Login</button></p>
    </form>
    <br><a class="tosubscribe" href="cadastrar.html" id="tosubscribe">Cadastrar Usuário</a>
    <br><br>
    <div class="separator">
    </div>

    <div class="footer">
        <p>Desenvolvido por @henridev</p>
    </div>
</div>

</body>
</html>