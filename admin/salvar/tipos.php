<?php 
    if(!isset ($page)) exit;    
    if($_POST){
        $id = trim($_POST["id"] ?? NULL);
        $tipo = trim($_POST["tipo"] ?? NUll);
        
        if(empty($tipo)){
            mensagemErro("Preencha o nome do tipo corretamente.");
        }

        $sql = "select id from tipo 
            where tipo = :tipo and id <> :id 
            limit 1";

        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":tipo", $tipo);
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if(!empty($dados->id)){
            mensagemErro("Ja existe o tipo informado.");
        }

        if(empty($id)){
            $sql = "insert into tipo(tipo) values (:tipo)";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":tipo", $tipo);
        }
        else{
            $sql = "update tipo set tipo = :tipo where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":tipo",$tipo);
            $consulta->bindParam(":id",$id);
        }
        if(!$consulta->execute()){
            mensagemErro("Não foi possível salvar os dados.");
        }
        echo "<script>location.href='listar/tipos';</script>";
        exit;
    }
    mensagemErro("Requisição Inválida")
?>
