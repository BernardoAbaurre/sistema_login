<?php
    //conexão
    require_once 'db_connect.php';
    
    //Sessão
    session_start();


    //botão enviar
    if(isset($_POST['enviar'])):
        $erros = array();
        $login = mysqli_escape_string($connect, $_POST['login']);// filtra de acordo com o BD e armazena o valor do HTML na variável PHP
        $senha = mysqli_escape_string($connect, $_POST['senha']);// filtra de acordo com o BD e armazena o valor do HTML na variável PHP

        if (empty($login) or empty($senha)):
            $erros[] = "<li>Campos incompletos</li>";
        else:
            //verifica se o login existe no BD
            $sql = "SELECT login FROM usuario WHERE login = '$login' ";
            $resultado = mysqli_query($connect, $sql);

            if(mysqli_num_rows($resultado) == 1)
            {
                $senha = md5($senha); //criptografa a senha inserida
                $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha' ";
                $resultado = mysqli_query($connect, $sql);

                if(mysqli_num_rows($resultado) == 1)
                {
                    $dados = mysqli_fetch_array($resultado); //armazena o resultado da consulta na array dados
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    $_SESSION['nome_usuario'] = $dados['nome'];
                    $_SESSION['login'] = $dados['login'];
                    header('Location: home.php'); //redireciona pra página restrita
                }
                else
                {
                    $erros[] = "<li>Senha incorreta</li>";
                }
            }
            else
            {
                $erros[] = "<li>Usuário inexistente</li>";
            }

        endif;
    endif;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body
        {
            background-color: #4082EC;
            font-size: 20pt;
            font-family: Arial, Helvetica, sans-serif;
            text-align: center;
        }
        input
        {
            margin-bottom: 10px;
        }
        section
        {
            margin: auto;
            background-color: lightgray;
            width: fit-content;
            padding: 20px;
            border-radius: 10px;
        }
        h1
        {
            color: white;
        }
        button
        {
            margin: auto;
            font-size: 20pt;
            border-radius: 10px;
            margin-top: 20px;
            cursor: pointer;
        }
        a
        {
            font-size: 15pt;
            color: black;
        }
    </style>
</head>
<body>

    <h1>Login</h1>
    
    <?php
        if(!empty($erros)):
            foreach ($erros as $erro)
            {
                echo $erro;
            }
        endif;
        ?>
    <section>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="login">Login: </label>
        <input type="text" name="login" id="login"><br>
        <label for="senha">Senha: </label>
        <input type="text" name="senha" id="senha"><br>
        <button type="submit" name="enviar">Enviar</button><br>
        <a href="criar_conta.php">Criar conta</a>
        </form>
    </section>
</body>
</html>