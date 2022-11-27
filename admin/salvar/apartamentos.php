<?php
    if(!isset($page))exit;

    //Armazena Valores
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if($_POST){
        $sql ="select id from apartamento where numeroap = :numeroap AND id <> :id limit 1";
    
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":numeroap", $numeroap);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
    
        if(!empty($dados->id)){
            mensagemErro("Já existe um apartamento com este número");
        }
    
        if(empty($id)){
            $sql = "insert into apartamento (numeroap, idbloco) values (:numeroap, :idbloco)";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":numeroap", $numeroap);
            $insert->bindParam(":idbloco", $idbloco);
        }else{
            $sql = "update apartamento set nome = :nome  where id = :id limit 1";
            $insert = $pdo->prepare($sql);
            $insert->bindParam(":id", $id);
            $insert->bindParam(":nome", $nomeBloco);
        }
        
        if(!$insert->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }mensagemSucesso("listar/apartamentos");
    }
?>