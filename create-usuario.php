<?php

require_once "conexao.php";

if (isset($_POST['btn-usuario'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $confirmesenha = $_POST['confirmesenha'];
    $email = $_POST['email'];
    $verifica = mysqli_query($mysqli, "SELECT usu_email FROM tb_usuario WHERE usu_email = '$email'");
    $count = mysqli_num_rows($verifica);
    if ($nome == "" || $nome == null || $senha == "" || $senha == null || $email == "" || $email == null) {
        echo '<script> alert ("Todos os campos devem ser preenchidos!"); location.href=("login-cadastro.php")</script>';
    } else if ($senha != $confirmesenha) {
        echo '<script> alert ("As senhas não correspondem. Digite novamente!"); location.href=("login-cadastro.php")</script>';
    } else {
        if ($count != 0) {
            echo '<script> alert ("Esse login já existe."); location.href=("login-cadastro.php")</script>';
        } else {
            $sql = "INSERT INTO tb_usuario(usu_nome, usu_senha, usu_email) VALUES ('$nome', md5('$senha'), '$email')";
            if (mysqli_query($mysqli, $sql)) {
                $idQuery = "SELECT usu_id FROM tb_usuario WHERE usu_email = '$email'";
                $id = mysqli_query($mysqli, $idQuery);
                $usu_id = mysqli_fetch_row($id);
                $usu_id = intval($usu_id[0]);
                $sql = "INSERT INTO tb_telefone(usu_id, tel_numero) VALUES ($usu_id, '$telefone')";
                if (mysqli_query($mysqli, $sql)) {
                    echo '<script> alert ("Usuário cadastrado com sucesso!"); location.href=("login-cadastro.php")</script>';
                } else {
                    echo '<script> alert ("Não foi possível concluir o cadastro."); location.href=("login-cadastro.php")</script>';
                }
            } else {
                echo '<script> alert ("Não foi possível concluir o cadastro."); location.href=("login-cadastro.php")</script>';
            }

        }
    }
}