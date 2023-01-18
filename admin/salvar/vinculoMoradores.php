<?php
    if(!isset($page))exit;

    if($_POST){
        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        if(empty($id)){ //INSERIR DADOS NO BANCO.
            $sql = "update apartamento set idmorador = :idmorador where id = :idApartamento limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":idApartamento", $idApartamento);
            $insert->bindParam(":idmorador", $morador);
        }elseif(!empty($id)){
            $sql = "update apartamento set idmorador = :idmorador where id = :id and numeroap = :apartamento limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":apartamento", $idApartamento);
            $insert->bindParam(":idmorador", $morador);
        }

        if($insert->execute()){
            mensagemSucesso('listar/apartamentos');
        }else{
            mensagemErro("Requisição inválida");
        }
    }
?>
