<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "sistema_login";

$connect = mysqli_connect($servername, $username, $password, $db_name);

if(mysqli_connect_error()):
    echo "Falha: ".mysqli_connect_error();
endif;
?>
