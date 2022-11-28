<?php 
    //se n existir variavel page
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if(!empty($id)){
        $sql = "select id, descricao from categoria where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $descricao = $dados->descricao ?? NULL;
    }
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Categoria</h2>
        <div class="float-right">
            <a href="listar/categorias" 
            title="Listar Categorias" 
            class="btn btn-primary">Listar Categorias</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/categorias" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">
            <label for="descricao">Nome da Categoria:</label>
            <input type="text" name="descricao" id="descricao"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$descricao?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Cadastrar
            </button>
        </form>
    </div>
</div>