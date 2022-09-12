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
        <h2 class="float-left">Gestão de Pessoas</h2>
        <div class="float-right">
        </div>
    </div>
    <div class="card-body">
        <div class="float-left">
            <ul class="nav nav-pills mr-2">
                <li class="nav-item mr-2">
                    <a class="nav-link active rounded-pill" href="cadastros/pessoas"><i class="bi bi-person-plus-fill"></i> Cadastrar Pessoa</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle rounded-pill" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-building"></i> Moradores</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/morador">Cadastrar Morador</a>
                        <a class="dropdown-item" href="#">Lista de Moradores</a>
                    </div>
                </li>
            </div>
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle rounded-pill" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-file-person"></i> Funcionários</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Cadastrar Funcionário</a>
                        <a class="dropdown-item" href="listar/funcionarios">Lista de Funcionários</a>
                        <a class="dropdown-item" href="cadastros/funcao">Cadastro de Função</a>
                    </div>
                </li>
            </div>
        </div>
    </div>
</div>