<?php
    if(!isset($page)) exit;

    if(!empty($id)){
        $sql = "select ativo from funcionario where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id", $id);
        $consulta->execute();
        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        if($dados->ativo == "N"){
            $sql = "update funcionario set ativo = 'S', modificado = :modificado where id = :id limit 1";
            $aaa = $pdo->prepare($sql);
            $aaa->bindParam(":id", $id);
            $aaa->bindParam(":modificado",$_SESSION['usuario']['login']);
            $aaa->execute();
            mensagemSucesso('listar/funcionarios');

        }elseif($dados->ativo == "S"){
            $sql = "update funcionario set ativo = 'N', modificado = :modificado where id = :id limit 1";
            $bbb = $pdo->prepare($sql);
            $bbb->bindParam(":id", $id);
            $bbb->bindParam(":modificado",$_SESSION['usuario']['login']);
            $bbb->execute();
            mensagemSucesso('listar/funcionarios');
        }

    }else{
        mensagemErro("Requisição Inválida");
    }

?>
