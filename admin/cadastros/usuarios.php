<?php
    if(!isset($page)) exit;

    $nome = $login = $senha = $ativo = $email = NULL;

    if(!empty($id)){
        $sql = "select * from usuario where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id;
        $nome = $dados->nome;
        $login = $dados->login;
        $email = $dados->email;
        $ativo = $dados->ativo;
    }
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Usuarios</h2>
        <div class="float-right">
            <a href="listar/usuarios" 
            title="Listar Usuarios" 
            class="btn btn-primary">Listar Usuarios</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/usuarios" data-parsley-valdiate="">
            <label for="id">ID:</label>
            <input type="text" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            
            <label for="nome">Nome do Usuario:</label>
            <input type="text" name="nome" id="nome" class="form-control" required
            data-parsley-required-message="Preencha este campo" value="<?=$nome?>" autocomplete="nope">

            <label for="login">Login do Usuario:</label>
            <input type="text" name="login" id="login" class="form-control" required 
            data-parsley-required-message="Preencha Este Campo" value="<?=$login?>" autocomplete="nope">
            
            <label for="email">Email do Usuario:</label>
            <input type="email" name="email" id="email" class="form-control" required 
            data-parsley-required-message="Digite um emial valido" value="<?=$email?>" autocomplete="nope">

            <label for="senha">Digite sua senha:</label>
            <input type="password" name="senha" id="senha" class="form-control" required 
            data-parsley-required-message="Digite a sua senha" autocomplete="off">
            
            <label for="senha2">Confirme sua senha:</label>
            <input type="password" name="senha2" id="senha2" class="form-control" required 
            data-parsley-required-message="Digite a sua senha" autocomplete="off">

            <label for="ativo">Ativo:</label>
            <select name="ativo" id="ativo" class="form-control" 
            required data-parsley-required-message="Selecione uma Opcao">
                <option value=""></option>
                <option value="S">Sim</option>
                <option value="N">Nao</option>
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>
<script>
    $("#ativo").val("<?=$ativo?>");
</script>