<?php 
    if(!isset($page)) exit;

    //verificar se existe um produto cadastrado

    $sql = "select id from item where idcategoria = :id limit 1";

    //preparar o sql para execucao com o banco
    $consultaItem = $pdo->prepare($sql);

    $consultaItem->bindParam(":id", $id);

    $consultaItem->execute();

    $item = $consultaItem->fetch(PDO::FETCH_OBJ);
    
    //verificar se existe um produto.
    if(!empty($item->id)){
        mensagemErro('Impossivel exlcluir a categoria selecionada, pois existem produtos relacionados a mesma.');
    }

    //SQL EXCLUIR

    $sql = "delete from categoria where id = :id limit 1";

    $consultaCategoria = $pdo->prepare($sql);

    $consultaCategoria->bindParam(":id", $id);

    //verificar se consegue executar

    if($consultaCategoria->execute()){
        //encaminhar para a tela de listagem
        echo "<script>location.href='listar/categorias';</script>";
        exit;
    }mensagemErro("Nao foi possivel excluir.");
