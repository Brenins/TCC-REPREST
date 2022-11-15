<?php 
    //se n existir variavel page
    if(!isset($page)) exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Gestão de Emprestimos de Itens</h2>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills w-auto p-3">
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/pessoas"><i class="fas fa-handshake"></i> Nova Empréstimo</a>
            </li>
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/pessoas"><i class="fas fa-list-alt"></i> Lista de Empréstimos</a>
            </li>
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/pessoas"><i class="fas fa-toolbox"></i> Itens disponiveis</a>
            </li>
        </ul>
    </div>
</div>