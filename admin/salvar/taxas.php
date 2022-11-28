<?php
    if(!isset($page)) exit;
    
    if($_POST){
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }

        if(!empty($id)){
            $sql = "update taxa set valor = :valor where id = :id limit 1";
            $consulta = $pdo->prepare($sql);
            $consulta->bindParam(":valor",$valor);
            $consulta->bindParam(":id",$id);     

        }
        if($consulta->execute()){
            mensagemSucesso('listar/taxas');
        }else{
            mensagemErro("Erro ao salvar os dados");
        }
    }
?>
