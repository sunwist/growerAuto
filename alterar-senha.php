<?php
    require 'conexao.php';

    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $novaSenha = $_POST['senha'];
        $novaSenha2 = $_POST['senha2'];
        if ($email == "" || $email == null || $novaSenha == "" || $novaSenha == null || $novaSenha2 == "" || $novaSenha2 == null) {
            echo '<script> alert ("Todos os campos devem ser preenchidos!"); location.href=("alterar-senha.php")</script>';
        } else if ($novaSenha != $novaSenha2) {
            echo '<script> alert ("As senhas não correspondem. Digite novamente!"); location.href=("alterar-senha.php")</script>';
        } else {
            $result = mysqli_query($mysqli, "UPDATE tb_usuario SET usu_senha = md5('$novaSenha') WHERE usu_email = '$email'");
            echo '<script> alert ("Senha alterada com sucesso!"); location.href=("login-cadastro.php")</script>';
        }
    }

    ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <title>Alterar Senha</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background-image: url(images/background.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
        }

        h1 {
            font-weight: bold;
            margin: 30px;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            width: 635px;
            height: 780px;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 15px 25px;
            margin: 10px 0;
            width: 100%;
        }

        button {
            border-radius: 20px;
            border: 1px solid #48B752;
            background-color: #48B752;
            color: #FFFFFF;
            font-size: 16px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            margin: 25px;
            cursor: pointer;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container">
            <form action="alterar-senha.php" METHOD="POST">
                <h1>Alterar Senha</h1>
                <input type="email" name="email" maxlength="50" placeholder="Email" />
                <input type="password" name="senha" minlength="4" maxlength="20" placeholder="Digite sua nova senha" />
                <input type="password" name="senha2" minlength="4" maxlength="20"
                    placeholder="Confirme sua nova senha" />
                <button type="submit" name="submit">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>