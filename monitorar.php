<?php

require_once('conexao.php');
session_start();

if (isset($_SESSION['usu_id'])) {

    $sql = "SELECT usu_nome, usu_id FROM tb_usuario WHERE usu_id = '{$_SESSION['usu_id']}'";

    $sqlQuery = mysqli_query($mysqli, $sql);

    $dadosArray = mysqli_fetch_array($sqlQuery);
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.0/circle-progress.min.js"></script>
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

        #usuario {
            font-size: 20px;
            padding-left: 5px;
            text-decoration: none;
            color: black;
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

        /* header - apresentacao */

        .header {
            position: absolute;
            z-index: 999;
            text-align: center;
            position: absolute;
            top: 53%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 35px;
            color: white;
            text-shadow: 2px 2px 3px rgba(0, 0, 0);
            line-height: 35px;
        }

        /* footer */

        #links a:link {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* modal */
        .modal_sucesso {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 9999;
            background-color: #fff;
            padding: 20px;
        }

        /* fim modal */

        @media (min-width: 320px) and (max-width: 479px) {}

        @media (min-width: 480px) and (max-width: 599px) {}

        @media (min-width: 600px) and (max-width: 767px) {}

        @media (min-width: 768px) and (max-width: 1023px) {}
    </style>
</head>

<body>

    <?php
    if (isset($_GET['sucesso'])) {
        ?>
        <div class="modal_sucesso" id="sucesso">
            <p>Foi enviado com sucesso!</p>
            <button onclick="fechar()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x-lg" viewBox="0 0 16 16">
                    <path
                        d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                </svg>
            </button>
        </div>
        <?php

    } else if (isset($_GET['no'])) {
        ?>
            <div class="modal_sucesso" id="sucesso">
                <p>Não foi possivel enviar<br>Por favor selecione uma hortaliça</p>
                <button onclick="fechar()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                    </svg>
                </button>
            </div>
        <?php
    }
    ?>
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
                                    <a class="nav-link" href="monitorar.php">Monitorar</a>
                                </li>
                                <?php if (isset($_SESSION['usu_id'])) { ?>

                                    <li class="nav-item active">
                                        <img src="images/user.png" alt="" width="31px">
                                        <a class="m-1 dropdown-toggle" id="usuario" data-toggle="dropdown" role="button"
                                            aria-haspopup="true" aria-expanded="false" href="">
                                            <?php echo $dadosArray['usu_nome'] ?>
                                        </a>
                                        <div class="dropdown-menu">
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
    <form action="inserir-data.php" method="POST">
        <section>
            <img class="img d-block w-100 pt-5" src="images/monitorar.jpg" alt="">
            <div class="header">
                <h1>Monitoramento da Horta</h1>
                <p>Monitore e cuide da sua horta de um modo fácil e simples<br>sem que seja necessário atenção constante
                </p>
                <!-- puxando plantas do banco -->
                <?php
                $query = "SELECT * FROM tb_planta";
                $result = $mysqli->query($query);
                ?>
                <select name="hortalicas" class="btn btn-success p-2" name="select" id="select">
                    <option selected disabled>Hortaliças</option>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <option value='<?php echo $row['pla_id']; ?>'><?php echo $row['pla_nome']; ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </section>
        <!-- iframe -->
        <iframe src="http://10.87.232.135" frameborder="0" width="100%" height="500px"
            style="scrollig:no; padding-top: 10px;"></iframe>
        <!-- historico -->
        <center>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-2">
                        <input type="hidden" name="id" value="<?php echo $dadosArray['usu_id'] ?>">
                        <input type="submit" class="btn btn-outline-success m-3" name="cadastro" id="cadastro">

                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-outline-success m-3" type="button" data-toggle="modal"
                            data-target="#myModal">Histórico</button>
                    </div>
                </div>
            </div>
        </center>
    </form>
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
    <div class="modal" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Suas Hortaliças</h4>
                    <button type="button" class="close btn btn-light border" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <?php
                        $sql = "SELECT * FROM tb_historico h JOIN tb_usuario u on h.usu_id = u.usu_id JOIN tb_planta p on p.pla_id = h.pla_id WHERE h.usu_id = $_SESSION[usu_id]";
                        $dados = mysqli_query($mysqli, $sql);
                        while ($row = mysqli_fetch_array($dados)) {
                            ?>
                            <div class="row mt-3 mb-3">
                                <div class="col-sm border">
                                    <p>
                                        <?php echo $row['usu_nome'] ?>
                                    </p>
                                </div>
                                <div class="col-sm border">
                                    <?php echo $row['pla_nome'] ?>
                                </div>
                                <div class="col-sm border">
                                    <?php echo $row['his_data'] ?>
                                </div>
                                <div class="col-sm justify-content-center">
                                <button type="button" class="btn btn-light border" style="padding:4px">Apagar</button>
                                </div>
                            <?php }
                        ; ?>
                        </div>

                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
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
        function fechar() {
            let button = document.getElementById("sucesso");

            button.style.display = 'none';
            window.location.href = "monitorar.php";
        }
    </script>
</body>

</html>