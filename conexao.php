<?php

$hostname = "localhost";
$bancodedados = "horta";
$username = "root";
$password = "";

$mysqli = mysqli_connect($hostname, $username, $password, $bancodedados) or die('Não foi possível conectar');
?>