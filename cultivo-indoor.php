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

        /* apresentacao */

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

        /* beneficios */
        #slide2 {
            background-color: rgb(255, 255, 255);
            height: 800px;
        }

        #cards-section {
            padding-top: 225px;
        }

        #cards-section .card .text-container {
            padding: 2px 25px;
            text-align: center;
        }

        #cards-section .card {
            background: #FFFFFF;
            -webkit-transition: all 0.3s ease-in;
            -moz-transition: all 0.3s ease-in;
            -ms-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            box-shadow: 0px 5px 13px rgba(0, 0, 0, 0.40);
            border-radius: 7px;
            overflow: hidden;
            height: 500px;
        }

        #cards-section .card {
            box-shadow: 0px 9px 9px rgba(193, 196, 194, 0.7);
            -webkit-transition: all 0.3s ease-in;
            -moz-transition: all 0.3s ease-in;
            -ms-transition: all 0.3s ease-in;
            -o-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
            margin-top: 0px;
            cursor: pointer;
        }

        #cards-section .card .image-container {
            text-align: center;
            padding: 25px;
        }

        .image-container img {
            width: 110px;
            display: inline-block;
            position: relative;
            overflow: hidden;
            z-index: 99;
            -webkit-transition: all 0.5s ease-in;
            -moz-transition: all 0.5s ease-in;
            -o-transition: all 0.5s ease-in;
            -ms-transition: all 0.5s ease-in;
            transition: all 0.5s ease-in;
            padding-top: 20px;

        }

        #cards-section .card .image-container {
            height: 210px;
            width: auto;

        }

        #cards-section .card p {
            font-size: 23px;
            color: black;
            font-family: "Lato";
            margin: 20px 0px 0px 0px;
            line-height: 25px;
            max-width: 25em;
        }

        #cards-section .card span {
            font-size: 16px;
            color: #92d593;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        #cards-section .card h6 {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            font-family: 'Lato', sans-serif;
            color: black;
            line-height: 35px;
        }

        .image-container {
            position: relative;
        }

        .image-container:after {
            position: absolute;
            content: "";
            opacity: 0.7;
        }

        #cards-section .card:hover .image-container:after {
            -webkit-transition: all 0.5s ease-in;
            -moz-transition: all 0.5s ease-in;
            -o-transition: all 0.5s ease-in;
            -ms-transition: all 0.5s ease-in;
            transition: all 0.5s ease-in;
            width: 150%;
            top: -90px;
            height: 290px;
            border-radius: 1%;
            background-color: #8fd781;
            z-index: 1;
            left: -10%;
        }

        /* sobre nos */
        #slide3 {
            /* background-color: #48B752; */
            height: 700px;
        }

        #about {
            padding-top: 255px;
        }

        .about-text {
            border-left: 2px solid;
            padding-left: 2.2em;
            margin-bottom: 1em;
            max-width: 25em;
            font-size: 30px;
        }

        /* footer */

        #contato:hover {
            transform: scale(1.1);
            transition: 0.5s;
        }

        p {
            font-size: 25px;
        }

        #talk {
            padding-top: 90px;
            padding-bottom: 100px;
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
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3 active">
                                    <a class="nav-link" href="cultivo-indoor.php">Cultivo Indoor</a>
                                </li>
                                <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 px-3">
                                    <a class="nav-link" href="hortalicas.php" role="button" aria-haspopup="true"
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
    <!-- apresentacao -->
    <div>
        <img class="img d-block w-100 pt-5" src="images/background.jpg" alt="">
        <div class="texto">
            <p>
            <h1>Cultivo Indoor e seus benefícios</h1>
            O Cultivo Indoor é uma prática que vem se tornando comum. Para<br>que
            possa ser extraído todo o potêncial dessa prática, descubra seus benefícios.<br></p>

        </div>
    </div>
    <!-- sobre cultivo indoor -->
    <div id="section3">
        <div id="slide3">
            <div class="about container justify-content-center" id="about">
                <div class="row">
                    <div class="col">
                        <p class="about-text">
                            O cultivo indoor, ou home growing, como também é conhecido, é um cultivo em um espaço
                            fechado que utiliza
                            luzes artificiais e temperaturas reguladas que criam o ambiente perfeito para o
                            desenvolvimento adequado das culturas.
                            Com o cultivo indoor, é possível manter um ambiente que permite controlar esses fatores de
                            maneira adequada para as
                            plantações sem depender dos fatores climáticos externos.<br>
                        </p>
                    </div>
                    <div class="col">
                        <img src="logo.png" alt="" width="600px" style="padding-left: 20%">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- beneficios -->
    <div id="slide2">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div id="cards-section">
                        <div class="card">
                            <div class="image-container">
                                <img src="images/cabbage.png" alt="" />
                            </div>
                            <div class="text-container">
                                <h6>Aumento no rendimento do plantio</h6>
                                <p>Com um maior controle da temperatura, ventilação e luminosidade, as plantas
                                    recebem a quantidade necessária desses elementos. Além disso, o controle de pragas
                                    também contribui para aumentar a qualidade das
                                    plantas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="cards-section">
                        <div class="card">
                            <div class="image-container">
                                <img src="images/adubacao.png" alt="" />
                            </div>
                            <div class="text-container">
                                <h6>Controle das condições climáticas</h6>
                                <p>Ao contrário da modalidade outdoor, o cultivo indoor permite que o responsável
                                    pela plantação tenha controle sobre alguns fatores climáticos, como: temperatura,
                                    ventilação e luminosidade.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="cards-section">
                        <div class="card">
                            <div class="image-container">
                                <img src="images/solo.png" alt="" />
                            </div>
                            <div class="text-container">
                                <h6>Diminuição e prevenção de pragas </h6>
                                <p>No cultivo indoor, o ambiente fechado proporciona uma exposição consideravelmente
                                    menor às pragas que são encontradas com grande frequência no modelo outdoor.
                                    <br>Com isso, a qualidade dos alimentos produzidos também cresce.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer -->
    <hr class="mx-0 px-0">
    <footer>
        <div class="container p-3">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <h3><img src="logo.png" width="60px"><b class="text-dark"> Grower<span class="text-muted">
                                Auto</span></b></h3>
                    <small class="copy-rights cursor-pointer">&#9400; 2023 Grower Auto Projects</small><br>
                    <small>Copyright All Rights Reserved</small>
                </div>
                <div class="col-sm-3">
                    <ul class="list-unstyled">
                        <li><a href="#section1" style="color:black; text-decoration:none;">Home</a></li>
                        <li><a href="#section2" style="color:black; text-decoration:none;">Projeto</a></li>
                        <li><a href="#section3" style="color:black; text-decoration:none;">Sobre Nós</a></li>
                        <li><a href="cultivo-indoor.php" style="color:black; text-decoration:none;">Cultivo Indoor</a>
                        </li>
                        <li><a href="hortalicas.php" style="color:black; text-decoration:none;">Hortaliças</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    </div>
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