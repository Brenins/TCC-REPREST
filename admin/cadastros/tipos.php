<?php
    if(!isset($page)) exit;
    $tipo = NULL;
    if(!empty($id)){
  $sql = "select * from tipo where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $tipo = $dados->tipo ?? NULL;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro Tipo de Usuario</h2>
        <div class="float-right">
            <a href="listar/tipos" title="Listar Tipos"
            class="btn btn-success">Listar Tipos</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/tipos" data-parsley-validate="">
            <input type="text" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">
            <label for="nome">Nome do Tipo:</label>
            <input type="text" name="tipo" id="tipo"
            class="form-control" required
            data-parsley-required-message="Insira o nome do tipo corretamente."
            value="<?=$tipo?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i>
            </button>
        </form>
</div>