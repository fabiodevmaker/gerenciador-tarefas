<?php

$connect = mysqli_connect('localhost','root','') or die ("Erro ao conectar");
$banco = mysqli_select_db($connect, 'task_diary') or die ("Erro ao selecionar db");
