<?php
try {
    $conn = new pdo('mysql:host=localhost;dbname=task_diary','root','');
} catch (PDOException $e) {
    echo "Erro ao se conectart: Erro " . $e->getMessage();
}