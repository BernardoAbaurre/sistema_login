<?php
    //conexão
    require_once 'db_connect.php';
    
    //Sessão
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página restrita</title>
</head>
<body>
    <h1>página</h1>
    <?php
        echo "Nome: ".$_SESSION['nome_usuario']."<br>";
        echo "ID: ".$_SESSION['id_usuario']."<br>";
        echo "Login: ".$_SESSION['login']."<br>";
    ?>
</body>
</html>