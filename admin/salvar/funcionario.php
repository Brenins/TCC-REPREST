<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        
        //se ja existe um usuario cadastrado com este login

        $sql ="select id from funcionario where id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        //se ja existe um usuario cadastrado com este login

        $sql ="select idpessoa from funcionario where idpessoa = :idpessoa AND id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":idpessoa", $idpessoa);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->idpessoa)){
            mensagemErro("Esta pessoa já é um Funcionário, por favor selecione outra pessoa.");

        }
        
        if ( empty ( $id ) ) {
            
            //inserir no banco

            $sql = "insert into funcionario (ativo, idpessoa,idfuncao, criado) values (:ativo,:idpessoa,:idfuncao, :criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":idpessoa", $idpessoa);
            $consulta->bindParam(":idfuncao", $idfuncao);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login']);

        }/* } else if ( empty ($senha ) ) {

            //fazer o update, mas sem a senha

            $sql = "update funcionario set  login = :login, ativo = :ativo, modificado = :modificado  where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":login", $login);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);

        } else {

            //fazer update com a senha

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "update funcionario set login = :login,senha = :senha, ativo = :ativo, modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":login", $login);
            $consulta->bindParam(":senha", $senha);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);

        } */

        if($consulta->execute()){
            echo "<script>location.href='listar/usuarios';</script>";
        }else{

        }
    }
?>