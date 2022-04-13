<?php 
    if(!isset($page)) exit;

    //verificar se existe um produto cadastrado

    $sql = "select id from produto where categoria_id = :id limit 1";

    //preparar o sql para execucao com o banco
    $consultaProduto = $pdo->prepare($sql);

    $consultaProduto->bindParam(":id", $id);

    $consultaProduto->execute();

    $produto = $consultaProduto->fetch(PDO::FETCH_OBJ);
    
    //verificar se existe um produto.
    if(!empty($produto->id)){
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
