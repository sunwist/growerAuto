<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grower Auto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style>
        @t url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

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

        h2 {
            text-align: center;
        }

        p {
            font-size: 19px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 2.5px;
            margin: 20px 0 30px;
        }

        a {
            color: #333;
            font-size: 15px;
            text-decoration: none;
            margin: 25px 0px 5px 0px;
        }
        a:hover{
            color:#899FC9;
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

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 15px 25px;
            margin: 8.5px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 1200px;
            height: 780px;
            max-width: 100%;
            min-height: 480px;
        }

        /* container das informações de dentro */
        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #195520;
            background: -webkit-linear-gradient(to right, #195520, #48B752);
            background: linear-gradient(to right, #195520, #48B752);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }
    </style>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="create-usuario.php" METHOD="POST">
                <h1>Crie uma Conta</h1>
                <input type="text" name="nome" onkeypress="return letras_js()" minlength="4" maxlength="50" placeholder="Nome" />
                <input type="email" name="email" maxlength="50" placeholder="Email" />
                <input type="text" name="telefone" id="telefone" maxlength="14" onkeypress="return telefone_js(telefone.value)" placeholder="Telefone" />
                <input type="password" name="senha" minlength="4" maxlength="20" placeholder="Senha" />
                <input type="password" name="confirmesenha" id="confirmesenha" minlength="4" maxlength="20" placeholder="Confirme a senha" />
                <button type="submit" name="btn-usuario">Cadastrar</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="logar.php" METHOD="POST">
                <h1>Login</h1>
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="senha" placeholder="Senha" />
                <a href="recuperar.html">Esqueci Minha Senha</a>
                <button type="submit" name="btn-entrar">Entrar</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bem Vindo de Volta!</h1>
                    <p>Já possui login? <br> Clique no botão abaixo. </p>
                    <button class="ghost" id="signIn">Logar</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Olá, Grower!</h1>
                    <p>Deseja se cadastrar em nosso site e <br> ter acesso a funções exclusivas?
                        Basta clicar no botão abaixo e preencher o formulário.
                    </p>
                    <button class="ghost" id="signUp">Cadastre-se</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        // animação
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
        // máscaras
        function letras() {
            var sDigitos = "qwertyuiopasdfghjklçzxcvbnmQWERTYUIOPASDFGHJKLÇZXCVBNMáéíóúÁÉÍÓÚ ";
            var cTecla = event.key;
            if (sDigitos.indexOf(cTecla) == -1) {
                return false;
            } else {
                return true;
            }

            
        }

        function num(value) {
            var theEvent = value || window.event;
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
            var regex = /^[0-9.]+$/;
            if (!regex.test(key)) {
                theEvent.returnValue = false;
                if (theEvent.preventDefault) theEvent.preventDefault();
            }
        }
        function maskJs(value, pattern) {
            let i = 0;
            let v = value.toString();
            v = v.replace(/\D/g, '');
            return pattern.replace(/#/g, () => v[i++] || '');
        };

        function telefone_js(value) {
            const formatado = maskJs(value, '(##)#####-####');
            document.getElementById('telefone').value = formatado;
        }
    </script>
</body>

</html>