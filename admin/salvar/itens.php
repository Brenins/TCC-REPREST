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
    } /* else{
        $sql = "update";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":nome", $nome);
        $consulta->bindParam(":categoria_id", $categoria_id);
        $consulta->bindParam(":valor", $valor);
        $consulta->bindParam(":descricao", $descricao);
        $consulta->bindParam(":imagem1", $imagem1);
        $consulta->bindParam(":imagem2", $imagem2);
        $consulta->bindParam(":id", $id);
    } */


    if($consulta->execute()){
        mensagemSucesso('paginas/home');

    }else{
        mensagemErro("Erro ao salvar os dados");
    }



?>

