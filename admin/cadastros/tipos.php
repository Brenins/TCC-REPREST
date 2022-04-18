<?php
    if(!isset($page)) exit;
    $tipo = NULL;
    if(!empty($id)){
        $sql = "select * from tipo where id = :id limit 1";
        $consultaTipo = $pdo->prepare($sql);
        $consultaTipo->bindParam(":id",$id);
        $consulta->execute();
        $dadosTipo = $consultaTipo->fetch(PDO::FETCH_OBJ);
        $id = $dadosTipo->id ?? NULL;
        $tipo = $dadosTipo->tipo ?? NUll;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Tipo de Usuario</h2>
        <div class="float-right">
            <a href="listar/tipos" title="Listar Tipos Usuario"
            class="btn btn-primary">Listar Tipos</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/tipos" data-parsley-validate="">
            <label for="id">Id do Tipo:</label>
            <input type="text" readonly name="id"
            class="form-control" value="<?=$id?>">
            <label for="tipo">Tipo de Usuario:</label>
            <input type="text" name="tipo" id="tipo"
            class="form-control"  required 
            data-parsley-required-message="Por Favor, preencha o tipo de usuario"
            value="<?=@$nome?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i>
            </button>
        </form>
    </div>
</div>