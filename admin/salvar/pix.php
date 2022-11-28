<?php 
    if(!isset($page))exit;

    if($_POST){
        foreach($_POST as $key => $value){
            $$key = trim ($value ?? NULL);
        }
        
        print_r($_POST);

    

        $sql = "update pix set chave = :chave, 
        recebedor = :recebedor, cidade_rec = :cidade where id = :id limit 1";
        $insert = $pdo->prepare($sql);
        $insert->bindParam(":id", $id);
        $insert->bindParam(":chave", $chave);
        $insert->bindParam(":recebedor", $recebedor);
        $insert->bindParam(":cidade", $cidade);

        if($insert->execute()){
            mensagemSucesso("cadastros/pix");
        }else{
            mensagemErro("Erro ao atualizar.");
        }
    }
?>