<?php
    if(!isset($page)) exit;

    foreach($_POST as $key => $value){
        $$key = trim($value ?? NULL);
    }

    if(empty($valor)){
        mensagemErro("Preencha o Valor!");
    }else if (empty($categoria)){
        mensagemErro("Selecione uma Categoria!!!");
    }else if (empty($nome)){
        mensagemErro("Digite o nome do produto!!!");
    }

    $valor = str_replace(".","",$valor);
    $valor = str_replace(",",".",$valor);

    if(empty($id)){
        $sql = "insert into item (nome, ativo, vlitem, idcategoria) values (:nome, :ativo, :vlitem, :idcategoria)";
        $ativo = 'S';
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":vlitem", $valor);
        $consulta->bindParam(":idcategoria", $categoria);
    }else{
        $sql = "update item set nome = :nome, ativo = :ativo, vlitem = :vlitem, idcategoria = :idcategoria where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":ativo", $ativo);
        $consulta->bindParam(":vlitem", $valor);
        $consulta->bindParam(":idcategoria", $categoria);
    }

    if($consulta->execute()){
        mensagemSucesso('listar/itens');

    }else{
        mensagemErro("Erro ao salvar os dados");
    }

?>

