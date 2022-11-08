<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }


    if(!empty($id)){
        $sql = "select id, nome from funcao where id = :id limit 1";
        $consulta = $pdo->prepare($sql);
        $consulta->bindParam(":id",$id);
        $consulta->bindParam(":nome",$nome);
        $consulta->execute();

        $dados = $consulta->fetch(PDO::FETCH_OBJ);
        $id = $dados->id ?? NULL;
        $nome = $dados->nome ?? NULL;
    }

?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastro de Função</h2>
        <div class="float-right">
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-bars"></i>  Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/funcionario">Cadastrar Funcionário</a>
                        <a class="dropdown-item" href="listar/funcionarios">Lista de Funcionários</a>
                        <a class="dropdown-item" href="cadastros/usuarios">Definir Login de Funcionário</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/funcao" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">
            <label for="nome">Nome da Funcao:</label>
            <input type="text" name="nome" id="nome" class="form-control" required 
            data-parsley-required-message="Preencha o nome completo da função" value="<?=@$nome?>" autocomplete="nope">
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>