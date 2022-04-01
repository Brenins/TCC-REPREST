<?php 
    if(!isset ($page)) exit;
    
    if($_POST){
        $id = trim($_POST["id"] ?? NULL);
        $nome = trim($_POST["nome"] ?? NUll);
        
        //verificar se o nome não esta em branco.
        if(empty($nome)){
            mensagemErro("Preencha o nome da categoria corretamente.");
        }

        //verificar se a categoria não esta cadastrada
        $sql = "select id from categoria 
            where nome = :nome and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);


        //Verificar se trouxe algo
        if(!empty($dados->id)){
            mensagemErro("Ja existe a categoria informada.");
        }

        //Verificar se ira inserir ou se ira atualizar
        if(empty($id)){
            $sql = "insert into categoria(nome) values (:nome)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome", $nome);
        }else{
            $sql = "update categoria set nome = :nome where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":nome",$nome);
            $consulta->bindParam(":id",$id);
        }

        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        echo "<script>location.href='listar/categorias';</script>";

        exit;
    }

    //mostrar uma mensagem de rro
    mensagemErro("Requisição Inválida")
?>
