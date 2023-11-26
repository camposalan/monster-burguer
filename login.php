<?php

if (isset($_GET["logout"])) {
    session_start();
    session_destroy();
}

if (isset($_POST["login"])){
    require ('./data/conection.php');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha =  filter_input(INPUT_POST, 'senha');

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stm = $pdo->prepare($sql);
    $stm->bindValue(':email', $email);
    $stm->execute();

    $usuario = $stm->fetchObject();

    if ($usuario && password_verify($senha, $usuario->senha)){
        session_start();
        $_SESSION["usuario"] = $usuario;

        header("Location: /index.php");
    }else{
        header("Location: /login.php?erro=1");
    }
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Epic Food</title>


    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            background-color: #0f172a;
            font-family: "Segoe UI";
            color: #CBD5e1;
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;

        }
        form{
            display: flex;
            flex-direction: column;
            gap: 2rem;
            background-color: #1E293B;
            padding: 2rem;
            border-radius: .5rem ;


        }
        .form-group{
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }
        input[type="email"],
        input[type="password"]{
            padding: .5rem;
            border-radius: 4px;
            border: 0;
            background-color: #CBD5e1;

        }

        button{
            padding: .5rem;
            border-radius: 4px;
            border: 0;
            background-color: #F59e0B;
            cursor:pointer;
        }


    </style>

</head>

    <body>



        <nav>
            <h1>Monster Food</h1>

        </nav>

        <main>

            <div class="container">

                <form method="post" >
                    <h3>Acessar Sistema</h3>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" id="email" placeholder="exemplo@exemplo.com">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" >
                    </div>
                        <button name="login" type="submit"> Login </button>


                <span>
                <?php
                if (isset($_GET["erro"]))
                    echo "email ou senha invalidos!";
                ?>

            </span>
            </form>
        </div>


    </main>


</body>

</html>