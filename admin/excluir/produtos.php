<?php 
    if(!isset($page)) exit;
    $sql = "delete from produto  where id = :id limit 1";
    $consultaCategoria = $pdo->prepare($sql);
    $consultaCategoria->bindParam(":id", $id);

    if($consultaCategoria->execute()){
        echo "<script>location.href='listar/produtos';</script>";
        exit;
    }mensagemErro("Nao foi possivel excluir.");
