<?php
    include 'conexao.php';
    $query ="SELECT pla_nome FROM tb_planta";
    $result = $mysqli->query($query);
    if($result->num_rows > 0){
      $options = mysqli_fetch_array($result);
    }
?>