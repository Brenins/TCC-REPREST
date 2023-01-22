<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }


    if($_POST){

        $sql = "update emprestimo set idstatus = :idstatus, modificado = :modificado where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":modificado", $_SESSION['usuario']['login']);
        $consulta->bindParam(":idstatus", $idstatus);
        $consulta->bindParam(":id", $idemprestimo);

        if($idstatus=2){
            $teste = $iditem;
            $sql = "update item set ativo = 'S' where id = :id limit 1";
            $item = $pdo->prepare($sql);
            $item->bindParam(":id", $teste);
            $item->execute();
        }

    }


    if($consulta->execute()){
        mensagemSucesso("listar/emprestimos");
    }else{
        mensagemErro("Não foi possível salvar os dados.");
    }
?>

