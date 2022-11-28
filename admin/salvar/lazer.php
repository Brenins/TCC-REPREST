<?php 
    if(!isset ($page)) exit;
    
    if($_POST){
        $id = trim($_POST["id"] ?? NULL);
        $nome = trim($_POST["nome"] ?? NUll);
        
        //verificar se o nome não esta em branco.
        if(empty($nome)){
            mensagemErro("Preencha o campo corretamente.");
        }

        //verificar se a categoria não esta cadastrada
        $sql = "select id from local 
            where nome = :nome and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);


        //Verificar se trouxe algo
        if(!empty($dados->id)){
            mensagemErro("Ja existe o local informado.");
        }

        //Verificar se ira inserir ou se ira atualizar
        if(empty($id)){
            $sql = "insert into local(nome) values (:nome)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
        }else{
            $sql = "update local set nome = :nome where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome",$nome);
            $consulta->bindParam(":id",$id);
        }

        if($consulta->execute()){
           mensagemSucesso("listar/lazer");
        }
        mensagemErro("Erro ao salvar os dados.");
    }
?>
