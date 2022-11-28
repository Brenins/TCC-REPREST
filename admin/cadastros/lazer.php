<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if(!empty($id)){
        //Busca informações sobre o local
        $sql = "select id, nome from local where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();
        
        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        //variaveis
        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
    }
?>
<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastrar área de lazer</h2>
        <div class="float-right"></div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/lazer" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">
            <label for="nome">Nome do local de lazer:</label>
            <input type="text" name="nome" id="nome"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$nome?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Cadastrar
            </button>
        </form>
    </div>
</div>