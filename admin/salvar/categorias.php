<?php 
    if(!isset ($page)) exit;
    
    if($_POST){
        $id = trim($_POST["id"] ?? NULL);
        $descricao = trim($_POST["descricao"] ?? NUll);
        
        //verificar se o nome não esta em branco.
        if(empty($descricao)){
            mensagemErro("Preencha o nome da categoria corretamente.");
        }

        //verificar se a categoria não esta cadastrada
        $sql = "select id from categoria 
            where descricao = :descricao and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":descricao", $descricao);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);


        //Verificar se trouxe algo
        if(!empty($dados->id)){
            mensagemErro("Ja existe a categoria informada.");
        }

        //Verificar se ira inserir ou se ira atualizar
        if(empty($id)){
            $sql = "insert into categoria(descricao) values (:descricao)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao", $descricao);
        }else{
            $sql = "update categoria set descricao = :descricao where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":descricao",$descricao);
            $consulta->bindParam(":id",$id);
        }

        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }else{
            mensagemSucesso('listar/categorias');
        }
        

        exit;
    }

    //mostrar uma mensagem de rro
    mensagemErro("Requisição Inválida");
?>
