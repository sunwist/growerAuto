<?php
session_start();
require_once "conexao.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

if (isset($_POST['btn-entrar'])) {
    if (strlen($_POST['email']) == 0 || strlen($_POST['senha']) == 0) {
        echo '<script> alert ("Preencha todos os campos!"); location.href=("login-cadastro.php")</script>';
    } else {
        $result = mysqli_query($mysqli, "SELECT usu_id, usu_email, usu_senha FROM tb_usuario WHERE usu_email = '$email'");
        $qtd = mysqli_num_rows($result);
        if ($qtd == 1) {
            $dadosArray = mysqli_fetch_array($result);
            $_SESSION['usu_id'] = $dadosArray['usu_id'];
            header("Location: index.php");
        } else {
            echo '<script> alert ("Falha ao logar! E-mail ou senha incorretos."); location.href=("login-cadastro.php")</script>';
        }
    }
}
