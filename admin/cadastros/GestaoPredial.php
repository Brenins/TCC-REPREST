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
        <h2 class="float-left">Gestão do Edifício</h2>
    </div>
    <div class="card-body">
        <div class="alert alert-primary" role="alert">
            Nesta tela você poderá gerenciar toda a parte de setorização do edifício e vínculo de moradores.
        </div>
        <ul class="nav nav-pills w-auto p-3">
            <li class="nav-item dropdown mx-3">
                <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-building"></i> Cadastramento de Setores</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Cadastrar blocos habitacionais</a>
                    <a class="dropdown-item" href="#">Cadastrar apartamento</a>
                    <a class="dropdown-item" href="#">Cadastrar areas de lazer</a>
                    <a class="dropdown-item" href="#">Listar blocos habitacionais</a>
                    <a class="dropdown-item" href="#">Listar Apartamentos</a>
                    <a class="dropdown-item" href="#">Listar areas de lazer</a>

                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="bi bi-person-plus-fill"></i> Vínculo de moradores</a>
            </li>
        </ul>
        
    </div>
</div>