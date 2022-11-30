<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        //se ja existe uma pessoa cadastrada como morador

        $sql ="select idpessoa from morador where idpessoa = :idpessoa AND id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idpessoa", $idpessoa);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->idpessoa)){
            mensagemErro("Esta pessoa já é um Morador!");
        }
        
        if ( empty ( $id ) ) {
            
            //inserir no banco

            $ativoSim = 'S';

            $sql = "insert into morador (criado, idpessoa, ativo) values (:criado,:idpessoa, :ativo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":idpessoa", $idpessoa);
            $consulta->bindParam(":ativo", $ativoSim);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login']);
        }

        if($consulta->execute()){
            mensagemSucesso('listar/moradores');
        }else{

        }
    }
?>