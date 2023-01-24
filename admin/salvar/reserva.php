<?php
    date_default_timezone_set('america/sao_paulo');
    
    if(!isset($page))exit;

    if($_POST){
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }



        $sql = "select id, idlocal from reserva 
            where dtinicio = :dtinicio or dtfim = :dtfim and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":dtinicio", $dtInicio);
        $consulta->bindParam(":dtfim", $dtFim);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //VALIDA SE JÁ NÃO EXISTE UMA RESERVA NA MESMA DATA
        if(!empty($dados->id)){
            if($dados->idlocal == $local){
                mensagemErro("O local informado possuí uma reserva para as datas informadas, escolha outra data.");
            }
        }
        
        //VALIDAÇÕES DE DATA E HORA
        if(!empty($id)){
            NULL;
        }elseif($dtInicio == date("Y-m-d") && $dtFim == date("Y-m-d")){
            $statusDefault = 1;
        }elseif($dtInicio < date("Y-m-d")){
            mensagemErro("A data inicial informada é menor que a data de hoje.");
        }elseif($dtFim < date("Y-m-d")){
            mensagemErro("A data final informada é menor que a data de hoje.");
        }
        
        $statusDefault = 5;

        if(empty($id)){
            $sql = "insert into reserva (descricao, dtinicio, dtfim, obs, criado,idstatus, idlocal, idapartamento) 
            values (:descricao, :dtinicio, :dtfim, :obs, :criado,:idstatus, :idlocal, :idapartamento)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":dtinicio", $dtInicio);
            $consulta->bindParam(":dtfim", $dtFim);
            $consulta->bindParam(":obs", $obs);
            $consulta->bindParam(":criado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $statusDefault);
            $consulta->bindParam(":idlocal", $local);
            $consulta->bindParam(":idapartamento", $apartamento);
        }elseif(empty($obs)){
            $sql = "update reserva set idstatus = :idstatus, modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":modificado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $status);
            $consulta->bindParam(":id", $id);
        }else{
            $sql = "update reserva set idstatus = :idstatus, obs = :obs , modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":modificado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $status);
            $consulta->bindParam(":obs", $obs);
            $consulta->bindParam(":id", $id);
        }

        if($consulta->execute()){
            mensagemSucesso("listar/reservas");
        }else{
            mensagemErro("Não foi possível salvar os dados.");
        }   
    }
?>