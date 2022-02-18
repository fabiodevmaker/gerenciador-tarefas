<?php

require __DIR__ . '/connectiontask.php';

session_start();

include 'conection.php';

if (!isset($_SESSION['idUser'])) {

    header('Location: loginpage.php');
}

if(!empty($_GET['key'])) {

    $idSelect = $_GET['key'];

    $stmt = $conn->prepare("SELECT * FROM tasks WHERE id ='" . $idSelect . "' ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $id = $stmt->fetchAll();

}
else {
    header('Location: homepage.php');
}

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
    <title>Editor de Tarefa</title>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Editor de Tarefa</h1>
        <img class="voltaricon" src="https://img.icons8.com/external-phatplus-solid-phatplus/64/000000/external-back-arrow-essential-phatplus-solid-phatplus.png"/>
        <a class="voltarEdit" href="homepage.php"><strong>Voltar</strong></a>
    </div>
    <div class="form">
        <form action="saveEdit.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="insert" value="insert">
            <input type="hidden" id='idtsk' name="idtsk" maxlength="13" value="<?php echo $_GET['key'] ?>">
            <label for="nome">Nome da Tarefa:</label>
            <input type="text" name="nome-tarefaup" placeholder="<?php echo $id[0]['nome_tarefa'] ?>" maxlength="13">
            <label for="des-tarefa">Descrição da Tarefa:</label>
            <input type="text" name="des-tarefaup" placeholder="<?php echo $id[0]['des_tarefa'] ?>">
            <label for="data-tarefa">Data da Tarefa:</label>
            <input type="date" name="data-tarefaup" value="<?php echo $id[0]['data_tarefa'] ?>">
            <label for="arquivo-tarefaup">Imagem da Tarefa:</label>
            <input type="file" name="arquivo-tarefaup">
            <button type="submit" name="update" id="update">Atualizar</button>
        </form>
    </div>
    <div class="separator">
    </div>
    <div class="footer">
        <p>Desenvolvido por @henridev</p>
    </div>
</div>

</body>
</html>