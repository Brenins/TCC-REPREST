<?php
    if(!isset($page)) exit;

    $login = $senha = $ativo = NULL;

    if(!empty($id)){
        $sql = "select id, login, ativo, criado from funcionario where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id;
        $login = $dados->login;
        $ativo = $dados->ativo;
        $criado = $dados->criado;
    }
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Habilitação de Usuarios</h2>
        <div class="float-right">
            <a href="listar/usuarios" 
            title="Listar Usuarios" 
            class="btn btn-primary rounded-pill">Listar Usuarios</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/usuarios" data-parsley-valdiate="">
            

            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <label for="login">Login do Usuario:</label>
            <input type="text" readonly name="login" id="login" class="form-control" required 
            data-parsley-required-message="Preencha Este Campo" value="<?=$login?>" autocomplete="nope">

            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" 
            required data-parsley-required-message="Selecione uma Opcao">
                <option value=""></option>
                <option value="S">Sim</option>
                <option value="N">Nao</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success rounded-pill">
                <i class="fas fa-check "></i> Salvar
            </button>
        </form>
    </div>
</div>
<script>
    $("#ativo").val("<?=$ativo?>");
</script>