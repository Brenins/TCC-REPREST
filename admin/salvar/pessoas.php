<?php
    //Se nao existir a pagina
    if(!isset($page))exit;

    if($_POST){

        //Recuperar os dados enviados
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        print_r(($_POST));
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

        if ( empty ( $id ) ) {
            
            //inserir no banco
            $sql = "insert into  pessoa (nome,cpf,rg,dtnascimento,telefone ,criado) values (:nome,:cpf,:rg,:dtnascimento, :telefone,:criado)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":telefone", $celular);
            $consulta->bindParam(":criado",$_SESSION['usuario']['login']);

        }else{

            $cpf = teste($cpf);
            //fazer o update, mas sem a senha
            $sql = "update pessoa set  nome = :nome, cpf = :cpf, rg = :rg, dtnascimento = :dtnascimento, telefone = :telefone, modificado = :modificado  where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":cpf", $cpf);
            $consulta->bindParam(":rg", $rg);
            $consulta->bindParam(":dtnascimento", $dataNascimento);
            $consulta->bindParam(":telefone", $celular);
            $consulta->bindParam(":modificado",$_SESSION['usuario']['login']);
            $consulta->bindParam(":id", $id);
        }

        if(!$consulta->execute()){
            mensagemErro("Nao foi possivel salvar o registro.");
        }else{
            mensagemSucesso("listar/pessoas");
        }
    }
?>