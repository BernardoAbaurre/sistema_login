<?php
    //conexão
    require_once 'db_connect.php';

    //botão enviar
    if(isset($_POST['enviar']))
    {
        $erros = array();
        $nome = mysqli_escape_string($connect, $_POST['nome']);// filtra de acordo com o BD e armazena o valor do HTML na variável PHP
        $login = mysqli_escape_string($connect, $_POST['login']);// filtra de acordo com o BD e armazena o valor do HTML na variável PHP
        $senha = mysqli_escape_string($connect, $_POST['senha']);// filtra de acordo com o BD e armazena o valor do HTML na variável PHP
    
    
        if(empty($nome) or empty($login) or empty($senha))
        {
            $erros[] = "<li>Campos incompletos</li>";
        }
        else
        {
            $senha = md5($senha);
            $sqlSelecionar = "SELECT * FROM usuario WHERE login = '$login'";
            $resultadoTeste = mysqli_query($connect, $sqlSelecionar);
            if(mysqli_num_rows($resultadoTeste) == 1)
            {
                $erros[] = "<li>login já cadastrado</li>";
            }
            else
            {
                $sqlCriar = "INSERT INTO usuario (nome, login, senha) VALUES ('$nome', '$login', '$senha')";

                if ($connect->query($sqlCriar) === TRUE) 
                {
                    echo "New record created successfully";
                    header('Location: index.php'); //redireciona para o index
                }
                else
                {
                    $erros[] = "<li>erro</li>";
                }
            }
        }
    }
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
    </style>
</head>
<body>
    <h1>Criar Conta</h1>
    <section>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome"><br>
            <label for="login">Login:</label>
            <input type="text" id="login" name="login"><br>
            <label for="senha">Senha:</label>
            <input type="text" id="senha" name="senha"><br>
            <button type="submit" name="enviar">Enviar</button>
        </form>
    </section>
    <?php
        if(!empty($erros)):
            foreach ($erros as $erro)
            {
                echo $erro;
            }
        endif;
    ?>
</body>
</html>