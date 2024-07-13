<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';
require_once 'conexao.php';


$email = mysqli_escape_string($mysqli, $_POST['email']);
// Checando se o email foi providenciado
if ($email=="" || $email==null) {
    echo '<script> alert ("Email Necessário!")';
    exit();
}

// // Checando a conexão com o banco.
// if ($mysqli->connect_error) {
//     echo "Falha na conexão: " . $mysqli->connect_error;
//     exit();
// }

// Checando se o email existe no banco.
$result = mysqli_query($mysqli, "SELECT * FROM tb_usuario WHERE usu_email='$email'");
if (mysqli_num_rows($result) === 0) {
    echo '<script> alert ("Usuário não encontrado!")';
    exit();
}

// Generate a unique token
//$token = bin2hex(random_bytes(20));

// // Faz um update do email do usuário no banco para o token previamente criado.
// $sql = "UPDATE tb_usuario SET reset_token='$token' WHERE usu_email='$email'";
// $mysqli->query($sql);

// Envia o email para o re-cadastro da senha.

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'ssl://smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'no.reply.growerauto@gmail.com';
$mail->Password = 'dbkihjtunlkocsru';           //senha de app:     wuablbuaxcxqrxqo   //senha da conta: x8d18YhinH0%
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom('no.reply.growerauto@gmail.com', 'no-reply grower auto support');
$mail->addAddress($email);

$mail->isHTML(true);
$mail->Subject = 'Password Reset Request';
$mail->Body = "Please click on the following link to reset your password: http://localhost/projeto/alterar-senha.php";
if ($mail->send()) {
    echo 'Password reset email sent';
} else {
    echo "Error sending email: {$mail->ErrorInfo}";
}


$mysqli->close();

 ?>
