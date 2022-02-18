<?php

require __DIR__ . '/connectiontask.php';

session_start();

include 'conection.php';

if (!isset($_SESSION['idUser'])) {

    header('Location: loginpage.php');
}

if (!isset($_SESSION['tarefas'])) {
    $_SESSION['tarefas'] = array();
}
$status = "Finalizada";

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id_user = :id and status_tarefa != :status");
$stmt->bindParam('id', $_SESSION['idUser']);
$stmt->bindParam('status', $status);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);


$stmt2 = $conn->prepare("SELECT * FROM tasks WHERE id_user = :id and status_tarefa = :status");
$stmt2->bindParam('id', $_SESSION['idUser']);
$stmt2->bindParam('status', $status);
$stmt2->execute();
$stmt2->setFetchMode(PDO::FETCH_ASSOC);

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
    <title>Gerenciador de Tarefas</title>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Gerenciador de Tarefas</h1><br>
        <?php
        if (isset($_SESSION['success'])) {
            ?>
            <br>
            <div class="alert-success"><?php echo $_SESSION['success']; ?></div>
            <?php
            unset($_SESSION['success']);
        }
        ?>
        <?php
        if (isset($_SESSION['failure'])) {
            ?>
            <br>
            <div class="alert-failure"><?php echo $_SESSION['failure']; ?></div>
            <?php
            unset($_SESSION['failure']);
        }
        ?>
        </br>
        <img class="logouticon" src="https://img.icons8.com/ios-filled/50/000000/door-opened.png"/>
        <a class="Logout" href="logout.php"><strong>Logout</strong></a>
    </div>
    <div class="form">
        <form action="tarefa.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="insert" value="insert">
            <label for="nome">Nome da Tarefa:</label>
            <input type="text" name="nome-tarefa" placeholder="Nome da Tarefa" maxlength="13">
            <label for="des-tarefa">Descrição da Tarefa:</label>
            <input type="text" name="des-tarefa" placeholder="Descrição da Tarefa">
            <label for="data-tarefa">Data da Tarefa:</label>
            <input type="date" name="data-tarefa">
            <label for="arquivo-tarefa">Imagem da Tarefa:</label>
            <input type="file" name="arquivo-tarefa">
            <input type="hidden" name="status" id="status" value="Em andamento">
            <button type="submit">Cadastrar</button>
        </form>
        <?php

        if (isset($_SESSION['message'])) {
            echo "<p style='color: #EF5350';>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <div class="separator">
    </div>
    <label>
        <center><p>Em andamento</p></center>
    </label>
    <div class="lista-tarefa">
        <?php

        echo "<ul>";
        foreach ($stmt->fetchAll() as $tarefa) {
            echo "<li>
                        <a href='detalhes.php?key=" . $tarefa['id'] . "'>" . $tarefa['nome_tarefa'] . "</a>
                        <a class='btnEdit' href='Edit.php?key=" . $tarefa['id'] . "'><strong>Editar Tarefa</strong></a>
                        <a class='statusTsk' id='statusTsk' href='finalizar.php?key=" . $tarefa['id'] . "'><strong>Finalizar Tarefa</strong></a>
                        <button type='button' class='btn-limpar' onclick='deletar" . $tarefa['id'] . "()'><strong>Remover tarefa</strong></button>
                        <script>
                            function deletar" . $tarefa['id'] . "(){
                                if ( confirm('Confirmar remoção?') ) {
                                    window.location = 'http://localhost:63342/Projeto-Comeia/tarefa.php?key=" . $tarefa['id'] . "';
                                } 
                                return false;
                            }
                        </script>
                </li>";
        }

        echo "</ul>";

        ?>
    </div>
    <div class="separator">
    </div>
    <label>
        <center><p>Finalizadas</p></center>
    </label>
    <div class="lista-tarefa2">
        <?php

        echo "<ul>";
        foreach ($stmt2->fetchAll() as $tarefa) {
            echo "<li>
                        <a href='detalhes.php?key=" . $tarefa['id'] . "'>" . $tarefa['nome_tarefa'] . "</a>
                        <a class='btnEdit2' href='Edit.php?key=" . $tarefa['id'] . "'><strong>Editar Tarefa</strong></a>
                        <button type='button' class='btn-limpar' onclick='deletar" . $tarefa['id'] . "()'><strong>Remover tarefa</strong></button>
                        <script>
                            function deletar" . $tarefa['id'] . "(){
                                if ( confirm('Confirmar remoção?') ) {
                                    window.location = 'http://localhost:63342/Projeto-Comeia/tarefa.php?key=" . $tarefa['id'] . "';
                                } 
                                return false;
                            }
                        </script>
                </li>";
        }

        echo "</ul>";
        ?>
        <div class="footer">
            <p>Desenvolvido por @henridev</p>
        </div>
    </div>

</body>
</html>