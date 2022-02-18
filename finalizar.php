<?php

require __DIR__ . '/connectiontask.php';

    $finalizar = "Finalizada";

    $stmt = $conn->prepare('UPDATE tasks SET status_tarefa = :status WHERE id = :id');
    $stmt->bindParam('status', $finalizar);
    $stmt->bindParam('id', $_GET['key']);

    if($stmt->execute() ) {
        header('Location: homepage.php');
    }else{
        echo 'Erro ao Finalizar!';
    }