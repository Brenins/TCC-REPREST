<?php
    if(!isset($page)) exit;

    foreach($_POST as $key => $value){
        $$key = trim($value ?? NULL);
    }

    if(empty($vlitem)){
        mensagemErro("Preencha o Valor!");
    }else if (empty($categoria)){
        mensagemErro("Selecione uma Categoria!!!");
    }else if (empty($nome)){
        mensagemErro("Digite o nome do produto!!!");
    }else if((empty($ativo))){
        mensagemErro("Informe a disponibilicade do Item!!!");
    }

    $vlitem = str_replace(".","",$vlitem);
    $vlitem = str_replace(",",".",$vlitem);

    if(empty($id)){
        $sql = "insert into item (nome, ativo, vlitem, idcategoria) values (:nome, :ativo, :vlitem, :idcategoria)";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":vlitem", $vlitem);
        $consulta->bindParam(":idcategoria", $categoria);
    }else{
        $sql = "update item set nome = :nome, ativo = :ativo, vlitem = :vlitem, idcategoria = :idcategoria where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":vlitem", $vlitem);
        $consulta->bindParam(":idcategoria", $categoria);
    }

    if($consulta->execute()){
        mensagemSucesso('listar/itens');

    }else{
        mensagemErro("Erro ao salvar os dados");
    }

?>

