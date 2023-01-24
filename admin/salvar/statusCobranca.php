<?php
    date_default_timezone_set('america/sao_paulo');

    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if($_POST){
            
        $data_mod = date("Y-m-d");

        $sql = "update cobranca set idstatus = :status, 
        data_atualizacao = :data where id = :id limit 1";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":id", $idcobranca);
        $insert->bindParam(":status", $status);
        $insert->bindParam(":data", $data_mod);

        if($insert->execute()){
            mensagemSucesso("listar/cobrancas");
        }else{
            mensagemErro("Erro ao atualizar.");
        }





        
    }

?>