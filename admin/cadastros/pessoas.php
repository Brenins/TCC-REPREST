<?php
    if(!isset($page)) exit;

    $nome = $cpf = $rg = $dataNascimento = NULL;

    if(!empty($id)){
        $sql = "select id, nome,cpf ,rg , dtnascimento from pessoa where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id;
        $nome = $dados->nome;
        $cpf = $dados->cpf;
        $rg = $dados->rg;
        $dataNascimento = $dados->dtnascimento;
    }
?>


<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Pessoas</h2>
        <div class="float-right">
            <a href="listar/pessoas" 
            title="Listar Pessoas" 
            class="btn btn-primary">Listar Pessoas</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/pessoas" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" class="form-control" required 
            data-parsley-required-message="Preencha o nome completo" value="<?=$nome?>" autocomplete="nope">
            
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" class="form-control" data-inputmask="'mask': '999.999.999-99'" required 
            data-parsley-required-message="Preencha o cpf" value="<?=$cpf?>" autocomplete="nope">
            
            <label for="rg">RG:</label>
            <input type="text" name="rg" id="rg" class="form-control"  maxlength="16" required 
            data-parsley-required-message="Preencha o RG" value="<?=$rg?>" autocomplete="nope">

            <label for="dataNascimento">Data de Nascimento:</label>
            <input type="date" name="dataNascimento" id="dataNascimento" class="form-control" required 
            data-parsley-required-message="Preencha a data de nascimento" value="<?=$dataNascimento?>" autocomplete="nope">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>