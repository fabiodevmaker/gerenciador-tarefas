<?php

require __DIR__ . '/connectiontask.php';

if (isset($_POST['update'])) {
    if (isset($_FILES['arquivo-tarefaup'])) {
        $ext = strtolower(substr($_FILES['arquivo-tarefaup']['name'], -4));
        $fileNome = md5(date('Y.m.d.H.i.s')) . $ext;
        $dir = 'uploads/';
        move_uploaded_file($_FILES['arquivo-tarefaup']['tmp_name'], $dir . $fileNome);
    }

    $stmt = $conn->prepare('UPDATE tasks SET nome_tarefa =:name, des_tarefa = :description, data_tarefa = :date , arquivo_tarefa = :image
                                     WHERE id = :id');
    $stmt->bindParam('name', $_POST['nome-tarefaup']);
    $stmt->bindParam('description', $_POST['des-tarefaup']);
    $stmt->bindParam('date', $_POST['data-tarefaup']);
    $stmt->bindParam('image', $fileNome);
    $stmt->bindParam('id', $_POST['idtsk']);

    if ($stmt->execute()) {
        header('Location: homepage.php');

    } else {
        echo 'Erro ao atualizar!';
    }

}

