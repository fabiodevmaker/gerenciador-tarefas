<?php

require __DIR__ . '/connectiontask.php';

session_start();


if (!isset($_SESSION['idUser'] ) ) {

    header('Location: loginpage.php');
}

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = :id");
$stmt->bindParam(':id', $_GET['key']);
$stmt->execute();
$data = $stmt->fetchAll();

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
    <title>Detalhes da Tarefa</title>
</head>
<body>

<div class="details-container">
    <div class="header">
        <h1><?php echo $data[0]['nome_tarefa'];?></h1>
        <img class="voltaricon" src="https://img.icons8.com/external-phatplus-solid-phatplus/64/000000/external-back-arrow-essential-phatplus-solid-phatplus.png"/>
        <a class="Voltar" href="homepage.php"><strong>Voltar</strong></a>
    </div>
    <div class="row">

        <div class="detalhes">

            <d1>
                <dt>Descrição da tarefa:</dt>
                <dd><?php echo $data[0]['des_tarefa'] ?></dd>
                <dt>Data da tarefa:</dt>
                <dd><?php echo $data[0]['data_tarefa'] ?></dd>
            </d1>
        </div>
        <div class="imagem">
            <img src="uploads/<?php echo $data[0]['arquivo_tarefa'] ?>" alt="Imagem da tarefa">
        </div>
    </div>
    <div class="footer">
        <p>Desenvolvido por @henridev</p>
    </div>
</div>
</body>
</html>
