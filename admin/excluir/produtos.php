<?php 
    if(!isset($page)) exit;

    //Selecionar Imagens
    $sql = "select imagem1, imagem2 from produto where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id",$id);
    $consulta->execute();

    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    $imagem1 = "../produtos/{$dados->imagem1}";
    $imagem2 = "../produtos/{$dados->imagem2}";



    $sql = "delete from produto  where id = :id limit 1";
    $consultaCategoria = $pdo->prepare($sql);
    $consultaCategoria->bindParam(":id", $id);

    if($consultaCategoria->execute()){
        if(file_exists($imagem1)){
            unlink($imagem1);
        }
        if(file_exists($imagem2)){
            unlink($imagem2);
        }

        echo "<script>location.href='listar/produtos';</script>";
        exit;
    }mensagemErro("Nao foi possivel excluir.");
