<?php
    if(!isset($page)) exit;

    if($_POST){
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
           
        $sql = "select i.id as id from item i where nome = :nome and id <> :id";
        $validaNome = $pdo->prepare($sql);
        $validaNome->bindParam(":nome", $nome);
        $validaNome->bindParam(":id", $id);
        $validaNome -> execute();
    
        $dadosItem = $validaNome->fetch(PDO::FETCH_OBJ);
        
        if(!empty($dadosItem->id)){
            mensagemErro("Ja existe um item com este nome no banco, insira outro nome!");
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
            $sql = "update item set nome = :nome, vlitem = :vlitem, idcategoria = :idcategoria where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":id", $id);
            $consulta->bindParam(":nome", $nome);
            $consulta->bindParam(":vlitem", $valor);
            $consulta->bindParam(":idcategoria", $categoria);
        }
    
        if($consulta->execute()){
            mensagemSucesso('listar/itens');
    
        }else{
            mensagemErro("Erro ao salvar os dados");
        }
    }

?>

