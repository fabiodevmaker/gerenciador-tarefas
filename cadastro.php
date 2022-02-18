<?php
include "conection.php";

$nome_user = ucwords($_POST['nome']);
$login_user = $_POST['login'];
$senha_user = $_POST['senha'];

$sql = mysqli_query($connect,"select * from usuarios where login= '$login_user'");
$lin = mysqli_num_rows($sql);

if($lin > 0) {
    echo "Login já cadastrado, escolha outro!"?> <a href="cadastrar.html"><strong> voltar para o cadastro</strong></a>.;
    <?php
} else {
    $insert = mysqli_query($connect, "INSERT INTO usuarios (nome,login,senha) 
                 values ('$nome_user', '$login_user', '$senha_user')") or die ("Erro no cadastro");
    $_SESSION['subs'] = "Usuário cadastrado!";
    header('Location: loginpage.php');
}

?>