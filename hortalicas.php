<?php

require_once('conexao.php');
session_start();


if (isset($_SESSION['usu_id'])) {

    $sql = "SELECT usu_nome, usu_id FROM tb_usuario WHERE usu_id = '$_SESSION[usu_id]'";
    $sqlQuery = $mysqli->query($sql);

    $dadosArray = mysqli_fetch_array($sqlQuery);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <title>Grower Auto</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        body {
            overflow: hidden;
        }

        /* menu */
        .navigation-wrap {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            transform: translateY(0);
            -webkit-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
            box-shadow: 0px 20px 20px 0 rgb(200, 200, 200, 0.2);
        }

        .navbar {
            padding: 10px;
        }

        .nav-link {
            color: #212121 !important;
            font-weight: 500;
            transition: all 200ms linear;
        }

        .nav-item:hover .nav-link {
            color: #58ce34 !important;
        }

        .nav-item.active .nav-link {
            color: #58ce34 !important;
        }

        .nav-link {
            position: relative;
            padding: 5px 0 !important;
            display: inline-block;
        }

        .nav-item:after {
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            content: '';
            background-color: #58ce34;
            opacity: 0;
            transition: all 200ms linear;
        }

        .nav-item:hover:after {
            bottom: 0;
            opacity: 1;
        }

        .nav-item.active:hover:after {
            opacity: 0;
        }

        .nav-item {
            position: relative;
            transition: all 200ms linear;
            font-size: 16.5px;
        }

        .nav-item .dropdown-menu {
            transform: translate3d(0, 10px, 0);
            visibility: hidden;
            opacity: 0;
            max-height: 0;
            display: block;
            padding: 0;
            margin: 0;
            transition: all 200ms linear;
        }

        .nav-item.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            max-height: 999px;
            transform: translate3d(0, 0px, 0);
        }

        /* dropdown menu */
        .dropdown-menu {
            padding: 10px !important;
            margin: 0;
            font-size: 13px;
            letter-spacing: 1px;
            color: #212121;
            background-color: #fcfaff;
            border: none;
            border-radius: 3px;
            box-shadow: 0 5px 10px 0 rgba(138, 155, 165, 0.15);
            transition: all 200ms linear;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-item {
            padding: 3px 15px;
            color: #212121;
            border-radius: 2px;
            transition: all 200ms linear;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            color: #fff;
            background-color: #458233;
        }

        .nav-item.show .dropdown-menu {
            opacity: 1;
            visibility: visible;
            max-height: 999px;
            transform: translate3d(0, 0px, 0);
        }

        #usuario {
            font-size: 20px;
            padding-left: 5px;
            text-decoration: none;
            color: black;
        }

        .texto {
            text-align: center;
            position: absolute;
            top: 53%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 32px;
            color: #FFFFFF;
            z-index: 999;
            text-shadow: 2px 2px 3px rgba(0, 0, 0);
            line-height: 35px;
        }

        .img {
            opacity: 0.9;
        }

        label {
            background: #444;
            color: #fff;
            transition: transform 400ms ease-out;
            display: inline-block;
            min-height: 100%;
            width: 100vw;
            height: 100vh;
            position: relative;
            z-index: 1;
            text-align: center;
            line-height: 100vh;
        }

        form {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            white-space: nowrap;
        }

        input {
            position: absolute;
        }

        .keys {
            position: fixed;
            z-index: 10;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            color: #fff;
            text-align: center;
            transition: all 300ms linear;
            opacity: 0;
            text-shadow: 2px 2px #212121;
            font-size: 18px;
        }

        .keys2 {
            position: fixed;
            z-index: 10;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            color: #fff;
            text-align: center;
            transition: all 300ms linear;
            opacity: 0;
        }

        input:focus~.keys {
            opacity: 0.8;
        }

        input:nth-of-type(1):checked~label:nth-of-type(1),
        input:nth-of-type(2):checked~label:nth-of-type(2),
        input:nth-of-type(3):checked~label:nth-of-type(3),
        input:nth-of-type(4):checked~label:nth-of-type(4) {
            z-index: 0;
        }

        input:nth-of-type(1):checked~label {
            transform: translate3d(0, 0, 0);
        }

        input:nth-of-type(2):checked~label {
            transform: translate3d(-100%, 0, 0);
        }

        input:nth-of-type(3):checked~label {
            transform: translate3d(-200%, 0, 0);
        }

        input:nth-of-type(4):checked~label {
            transform: translate3d(-300%, 0, 0);
        }

        label {
            background: #444;
            background-size: cover;
            font-size: 3rem;
        }

        label[for="spades"] {
            background-image: url(images/tuberosas.jpg);
        }


        label[for="hearts"] {
            background-image: url(images/couves_186907106.jpg);
        }

        label[for="clubs"] {
            background-image: url(images/background.jpg);
        }

        label:before,
        label:after {
            color: white;
            display: block;
            background: rgba(255, 255, 255, 0.2);
            position: absolute;
            padding: 1rem;
            font-size: 3rem;
            height: 10rem;
            vertical-align: middle;
            line-height: 10rem;
            top: 50%;
            transform: translate3d(0, -50%, 0);
            cursor: pointer;
        }

        label:before {
            content: "\276D";
            right: 100%;
            border-top-left-radius: 50%;
            border-bottom-left-radius: 50%;
        }

        label:after {
            content: "\276C";
            left: 100%;
            border-top-right-radius: 50%;
            border-bottom-right-radius: 50%;
        }
    </style>
</head>

<body>
    <!-- menu -->
    <div class="nav navigation-wrap bg-white">
        <div class="container justify-content-end">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="index.php"><img src="logo.png" alt="" width="75px"></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3">
                                    <a class="nav-link" href="index.php">Home</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3">
                                    <a class="nav-link" href="cultivo-indoor.php">Cultivo Indoor</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3 active">
                                    <a class="nav-link" href="#section3" role="button" aria-haspopup="true"
                                        aria-expanded="false">Hortaliças</a>
                                </li>

                                <?php if (isset($_SESSION['usu_id'])) { ?>

                                    <li class="nav-item active">
                                        <img src="images/user.png" alt="" width="31px">
                                        <a class="m-1 dropdown-toggle" id="usuario" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false" href="">
                                            <?php echo $dadosArray['usu_nome'] ?></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="monitorar.php">Monitorar</a>
                                            <a class="dropdown-item" href="log-out.php">Sair</a>
                                        </div>
                                    </li>
                                <?php } else { ?>

                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3">
                                        <img src="images/user.png" alt="" width="35px"></a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="login-cadastro.php">Logar</a>
                                        </div>
                                    </li>

                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <form>
        <input type="radio" name="fancy" autofocus value="clubs" id="clubs" />
        <input type="radio" name="fancy" value="hearts" id="hearts" />
        <input type="radio" name="fancy" value="spades" id="spades" />
        <label for="clubs"> Hortaliças Frutos</label>
        <div class="keys">As hortaliças-fruto são os cultivos em que o foco da produção é o consumo do fruto, seja verde
            ou maduro, todo ou em parte, a depender do tipo de vegetal.
            <br>
            Alguns exemplos de hortaliças-fruto conhecidas e muito consumidas no Brasil são pimentão, quiabo,
            couve-flor, berinjela, melancia, tomate, ervilha, jiló e abóbora.
            <br>
            <hr>
            Hortaliças herbáceas - aquelas cujas partes aproveitáveis situam-se acima do solo, sendo tenras e
            suculentas:
            <br>
            folhas (alface, taioba, repolho, espinafre), talos e hastes (aspargo, funcho, aipo), flores e inflores-
            cências (couve-flor, brócoli, alcachofra).
            <br>
            <hr>
            As tuberosas agrupam as raízes, os tubérculos e os bulbos. No primeiro estão, por exemplo, cenoura,
            beterraba e batata-doce.
        </div>
        <label for="hearts"> Hortaliças Herbáceas</label>
        <label for="spades"> Hortaliças Tuberosas</label>
    </form>
    <script>
        // dropdown menu mostrar opcao sem que seja necessario clicar
        $('body').on('mouseenter mouseleave', '.nav-item', function (e) {
            if ($(window).width() > 750) {
                var _d = $(e.target).closest('.nav-item');
                _d.addClass('show');
                setTimeout(function () {
                    _d[_d.is(':hover') ? 'addClass' : 'removeClass']('show');
                }, 1);
            }
        });
    </script>
</body>

</html>