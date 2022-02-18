<?php
include "conection.php";
session_start();
$login = $_POST['login'];
$pass = $_POST['senha'];
$sql = "select * from usuarios where login='$login' and senha='$pass' limit 1";
$query = mysqli_query($connect, $sql);
$lin = mysqli_num_rows($query);

$sqlId = "select id from usuarios where login='$login' and senha = '$pass' limit 1";
$queryId = mysqli_query($connect, $sqlId);
$dadoID = mysqli_fetch_assoc($queryId);
$dadoIDc = intval($dadoID);
$_SESSION['idUser'] = $dadoIDc['id'];


if ($lin == 0) {
    $_GET['key'] = "Dados incorretos!";
    header ('Location: loginpage.php?key=Dados Incorretos');
} else {
    $dados = mysqli_fetch_assoc($query);
    session_start();
    $_SESSION['idUser'] = $dadoID['id'];
    $_SESSION['nome_user_session'] = $dados['nome'];
    header("Location: homepage.php");
}
