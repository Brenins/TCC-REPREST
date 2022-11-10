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
        <h2 class="float-left">Gestão de pessoas</h2>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills w-auto p-3">
            <li class="nav-item">
                <a class="nav-link active" href="cadastros/pessoas"><i class="bi bi-person-plus-fill"></i> Cadastrar nova pessoa</a>
            </li>
            <li class="nav-item dropdown mx-3">
                <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-building"></i>  Gestão de moradores</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cadastros/morador">Cadastrar morador</a>
                    <a class="dropdown-item" href="listar/moradores">Lista de moradores</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-file-person"></i>  Gestão de funcionários</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cadastros/funcionario">Cadastrar funcionário</a>
                    <a class="dropdown-item" href="listar/funcionarios">Lista de funcionários</a>
                    <a class="dropdown-item" href="cadastros/funcao">Cadastro de função</a>
                    <a class="dropdown-item" href="cadastros/usuarios">Definir login de funcionário</a>
                </div>
            </li>
        </ul>
        
    </div>
</div>