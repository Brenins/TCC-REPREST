<?php
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }
    

        $sql ="select ativo from morador where  id = :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(empty($id)){
            mensagemErro("Requisição Inválida");
        }elseif($dados->ativo == "S"){
            $ativo = "N";
            $sql ="update morador set ativo = :ativo, modificado = :modificado where  id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);
        }elseif($dados->ativo == "N"){
            $ativo = "S";
            $sql ="update morador set ativo = :ativo, modificado = :modificado where  id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);
        }


        if($consulta->execute()){
            mensagemSucesso('listar/moradores');
        }else{
            mensagemErro("Erro ao salvar os dados");
        }



?>