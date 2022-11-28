<?php 
    //se n existir variavel page
    if(!isset($page)) exit;  
?>
<div class="card">
    <div class="card-header">
        <h2 class="float-left">Gestão do Edifício</h2>
    </div>
    <div class="card-body">
        <div class="alert alert-primary" role="alert">
            Nesta tela você poderá gerenciar toda a parte de setorização do edifício e vínculo de moradores.
        </div>
        <ul class="nav nav-pills w-auto p-3 ">
            <li class="nav-item dropdown m-3">
                <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="bi bi-building"></i> Cadastramento de Setores</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="cadastros/blocos">Cadastrar blocos habitacionais</a>
                    <a class="dropdown-item" href="cadastros/apartamentos">Cadastrar apartamento</a>
                    <a class="dropdown-item" href="cadastros/lazer">Cadastrar area de lazer</a>
                    <a class="dropdown-item" href="listar/blocos">Listar blocos habitacionais</a>
                    <a class="dropdown-item" href="listar/apartamentos">Listar apartamentos</a>
                    <a class="dropdown-item" href="listar/lazer">Listar areas de lazer</a>

                </div>
            </li>
            <li class="nav-item m-3" >
                <a class="nav-link active" href="cadastros/vinculoMoradores"><i class="bi bi-person-plus-fill"></i> Vínculo de moradores</a>
            </li>
        </ul>
        
    </div>
</div>