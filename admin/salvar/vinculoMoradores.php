<?php
    if(!isset($page))exit;

    if($_POST){
        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        $sql = "update apartamento set idmorador = :idmorador where id = :apartamento limit 1";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":apartamento", $idApartamento);
        $insert->bindParam(":idmorador", $morador);

        // if(!empty($id)){ //INSERIR DADOS NO BANCO.
            
        // }else{
        //     $sql = "update apartamento set idmorador = :idmorador where id = :idApartamento limit 1";
        //     $insert = $pdo->prepare($sql);
        //     $insert->bindParam(":idApartamento", $idApartamento);
        //     $insert->bindParam(":idmorador", $morador);
            
        // }

        if($insert->execute()){
            mensagemSucesso('listar/apartamentos');
        }else{
            mensagemErro("Requisição inválida");
        }
    }
?>
