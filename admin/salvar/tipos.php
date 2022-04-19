<?php
    if(!isset($page)) exit;
    if($_POST){
        $id = trim($_POST["id"] ?? NULL);
        $tipo = trim($_POST["tipos"] ?? NULL);

        if(empty($tipo)){
            mensagemErro("Preencha o tipo de usuario corretamente.");   
        }

        $sql = "select * from tipo where tipo= :tipos and id <> :id limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":tipos", $tipo);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Ja existe o tipo informado.");
        }

        if(empty($id)){
            $sql = "insert into tipo(tipo) values (:tipos)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":tipos",$tipo);
            $consulta->bindParam(":id",$id);
        }

        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    }
    mensagemErro("Requisição Inválida");
?>