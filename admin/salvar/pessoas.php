<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
       
       
        //se ja existe um cpf cadastrado com este login

        $sql ="select id from pessoa where cpf = :cpf AND id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":cpf", $cpf);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("CPF registrado no sistema,por favor insira outro CPF.");
            
        }

        echo $today = date("d.m.Y");

        if ( empty ( $id ) ) {
            if($today = date("d.m.Y") < $dataNascimento){
                echo "<script>href='www.google.com.br';</script>";
                
            }
            
            //inserir no banco

            $sql = "insert into  pessoa (nome,cpf,rg,dtnascimento,criado) values (:nome,:cpf,:rg,:dtnascimento,:criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login']);

        }/* else if ( empty ($senha ) ) {

            //fazer o update, mas sem a senha

            $sql = "update usuario set  login = :login, ativo = :ativo, modificado = :modificado  where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":login", $login);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);

        } else {

            //fazer update com a senha

            $senha = password_hash($senha, PASSWORD_DEFAULT);

            $sql = "update usuario set login = :login, ativo = :ativo, senha = :senha, modificado = :modificado where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":login", $login);
            $consulta->bindParam(":ativo", $ativo);
            $consulta->bindParam(":senha", $senha);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);

        }*/

        if($consulta->execute()){
            echo "<script>location.href='listar/pessoas';</script>";
        }else{
            mensagemErro("Nao foi possivel salvar o registro.");
        }
    }
?>