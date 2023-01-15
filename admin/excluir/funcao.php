<?php 
    if(!isset($page)) exit;

    //verificar se existe um produto cadastrado

    $sql = "select id from funcionario where idfuncao = :id limit 1";

    //preparar o sql para execucao com o banco
    $consultaItem = $pdo->prepare($sql);

    $consultaItem->bindParam(":id", $id);

    $consultaItem->execute();

    $item = $consultaItem->fetch(PDO::FETCH_OBJ);
    
    //verificar se existe um produto.
    if(!empty($item->id)){
        mensagemErro('Não é possivel excluir o item! Existem funcionários que utilizam a função selecionada.');
    }

    //SQL EXCLUIR

    $sql = "delete from funcao where id = :id limit 1";

    $consultaCategoria = $pdo->prepare($sql);

    $consultaCategoria->bindParam(":id", $id);

    //verificar se consegue executar

    if($consultaCategoria->execute()){
        //encaminhar para a tela de listagem
        mensagemSucesso("cadastros/funcao");
        exit;
    }mensagemErro("Nao foi possivel excluir.");
