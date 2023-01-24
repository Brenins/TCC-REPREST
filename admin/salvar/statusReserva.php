<?php
    date_default_timezone_set('america/sao_paulo');

    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if($_POST){

        $sql = "update reserva set idstatus = :status, 
        modificado = :modificado where id = :id limit 1";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":id", $idreserva);
        $insert->bindParam(":status", $status);
        $insert->bindParam(":modificado", $_SESSION['usuario']['login']);

        if($insert->execute()){
            mensagemSucesso("listar/reservas");
        }else{
            mensagemErro("Erro ao atualizar.");
        }
    }

?>