<?php
    date_default_timezone_set('america/sao_paulo');
    if(!isset($page))exit;
    if($_POST){
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        $sql = "select id from emprestimo 
            where dtemprestimo = :retirada or dtdevolucao = :devolucao and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":retirada", $retirada);
        $consulta->bindParam(":devolucao", $devolucao);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //VALIDA SE JÁ NÃO EXISTE UMA RESERVA NA MESMA DATA
        if(!empty($dados->id)){
            mensagemErro("Já existe um empréstimo para as datas informadas, escolha outra data.");
        }

        if(!empty($id)){
            NULL;
        }elseif($retirada == date("Y-m-d") && $devolucao == date("Y-m-d")){
            $statusDefault = 1;
        }elseif($retirada < date("Y-m-d")){
            mensagemErro("A data de retirada informada é menor que a data de hoje.");
        }elseif($devolucao < date("Y-m-d")){
            mensagemErro("A data de devolução informada é menor que a data de hoje.");
        }
       
        $statusDefault = 1; // arrumar isso daqui dps

        if(empty($id)){
            $sql = "insert into emprestimo (dtemprestimo, dtdevolucao, obs, criado, iditem, idstatus, idapartamento) 
            values (:dtemprestimo, :dtdevolucao, :obs, :criado, :iditem, :idstatus, :idapartamento)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":dtemprestimo", $retirada);
            $consulta->bindParam(":dtdevolucao", $devolucao);
            $consulta->bindParam(":obs", $obs);
            $consulta->bindParam(":criado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $statusDefault);
            $consulta->bindParam(":iditem", $item);
            $consulta->bindParam(":idapartamento", $apartamento);
        }elseif(empty($obs)){
            $sql = "update emprestimo set idstatus = :idstatus, modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":modificado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $status);
            $consulta->bindParam(":id", $id);
        }else{
            $sql = "update emprestimo set idstatus = :idstatus, obs = :obs , modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":modificado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $status);
            $consulta->bindParam(":obs", $obs);
            $consulta->bindParam(":id", $id);
        }

        if($consulta->execute()){
            mensagemSucesso("listar/emprestimos");
        }else{
            mensagemErro("Não foi possível salvar os dados.");
        }
    }
?>
