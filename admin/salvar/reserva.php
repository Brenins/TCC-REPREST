<?php
    if(!isset($page))exit;

    if($_POST){
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        $sql = "select id from reserva 
            where dtinicio = :dtinicio or dtfim = :dtfim and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":dtinicio", $dtInicio);
        $consulta->bindParam(":dtfim", $dtFim);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Já existe uma reserva para as datas informadas, escolha outra data.");
        }
        
        $sql = "select id, valor from taxa 
            where descricao = 'LIMPEZA' 
            limit 1";

        $cTaxa = $pdo->prepare($sql);
        $cTaxa->execute();
        $dadosTax = $cTaxa->fetch(PDO::FETCH_OBJ);
        

        if(empty($id)){

            $cu = 1;
            $sql = "insert into reserva (descricao, dtinicio, dtfim, obs, vltaxa, criado,idstatus, idlocal, idapartamento) 
            values (:descricao, :dtinicio, :dtfim, :obs, :vltaxa, :criado,:idstatus, :idlocal, :idapartamento)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
            $consulta->bindParam(":dtinicio", $dtInicio);
            $consulta->bindParam(":dtfim", $dtFim);
            $consulta->bindParam(":obs", $obs);
            $consulta->bindParam(":vltaxa", $dadosTax->valor);
            $consulta->bindParam(":criado", $_SESSION['usuario']['login']);
            $consulta->bindParam(":idstatus", $cu);
            $consulta->bindParam(":idlocal", $local);
            $consulta->bindParam(":idapartamento", $apartamento);
        }
        
        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        mensagemSucesso("cadastros/reserva");




    }

?>