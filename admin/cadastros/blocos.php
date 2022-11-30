<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

    if(!empty($id)){
        $sql = "select id, nome, sigla from bloco where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);

        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
        $sigla = $dados->sigla ?? NULL;
    }
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Blocos</h2>
        <div class="float-right">
            <ul class="nav nav-pills w-auto p-3 ">
                <li class="nav-item dropdown m-3">
                    <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i> Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/blocos">Cadastrar blocos habitacionais</a>
                        <a class="dropdown-item" href="cadastros/apartamentos">Cadastrar apartamento</a>
                        <a class="dropdown-item" href="cadastros/lazer">Cadastrar area de lazer</a>
                        <a class="dropdown-item" href="listar/blocos">Listar blocos habitacionais</a>
                        <a class="dropdown-item" href="listar/apartamentos">Listar apartamentos</a>
                        <a class="dropdown-item" href="listar/lazer">Listar areas de lazer</a>

                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/blocos" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="nomeBloco">Nome do Bloco:</label>
            <input type="text" name="nomeBloco" id="nomeBloco"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$nome?>">
            
            <label for="sigla">Sigla de Identificação (Máximo de 3 caracteres):</label>
            <input type="text" name="sigla" id="sigla" maxlength="3"
            class="form-control"  required 
            data-parsley-required-message="Por favor, preencha este campo"
            value="<?=@$sigla?>">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>