<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        $senha = $senha2 = NULL;
        
        if($senha != $senha2){
            mensagemErro("As senhas nao conferem.");
        }

        //se ja existe um usuario cadastrado com este login

        $sql ="select id from funcionario where login = :login AND id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":login", $login);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Usuario cadastrado no sistema, por favor insira outro usuario.");

        }
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

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "insert into funcionario (login, senha, ativo, idpessoa, criado) values (:login, :senha, :ativo,:idpessoa, :criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":login", $login);
            $consulta->bindParam(":senha", $senha);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":idpessoa", $idpessoa);
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