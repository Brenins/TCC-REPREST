<?php
    if(!isset($page)) exit;

    if(!empty($id)){
        $sql = "select ativo from item where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);


        if($dados->ativo == "N"){
            $sql = "update item set ativo = 'S' where id = :id limit 1";
            $aaa = $pdo->prepare($sql);
            $aaa->bindParam(":id", $id);
            $aaa->execute();
            mensagemSucesso('listar/itens');

        }elseif($dados->ativo == "S"){
            $sql = "update item set ativo = 'N' where id = :id limit 1";
            $bbb = $pdo->prepare($sql);
            $bbb->bindParam(":id", $id);
            $bbb->execute();
            mensagemSucesso('listar/itens');
        }


    }else{
        mensagemErro("Requisição Inválida");
    }


?>
