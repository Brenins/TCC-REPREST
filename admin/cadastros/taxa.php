<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }
    if(!empty($id)){
        $sql = "select id, descricao,valor from taxa where  id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        
        $idTaxa = $dados->id ?? NULL;
        $descricao = $dados->descricao ?? NULL;
        $valor = $dados->valor ?? NULL;
    }
    
?>
<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Alteração de Taxa</h2>
    </div>
    <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/taxas" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            
            <label for="taxa">Tipo de Taxa:</label>
            <input type="text" readonly name="taxa" id="taxa" class="form-control" maxlength="25" required 
            data-parsley-required-message="Preencha o campo" value="<?=$descricao?>" autocomplete="nope">
            
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" class="form-control" min="0" max="100" required 
            data-parsley-required-message="Preencha o campo" value="<?=$valor?>" autocomplete="nope">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>
