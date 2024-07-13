<?php 

require_once('conexao.php');

if (isset($_POST['cadastro'])) {

    $id = $_POST['id'];
    $idPlanta = $_POST['hortalicas'];

    if($idPlanta == 0){

        echo 'Algo deu errado. Selecione uma hortaliça';
        header('Location: monitorar.php?no');

    }else{

    $sql = "INSERT INTO tb_historico(usu_id, pla_id) VALUES ('$id', '$idPlanta')";
        
            if (mysqli_query($mysqli, $sql)) {
            
                header('Location: monitorar.php?sucesso');
                exit();
            } else {
                echo '<script>alert("Erro ao cadastrar!");</script>';
            }
        }
    }

?>
