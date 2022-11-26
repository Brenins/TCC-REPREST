<?php 
    //se n existir variavel page
    if(!isset($page)) exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Gestão de Reservas</h2>
    </div>
    <div class="card-body">
        <ul class="nav nav-pills w-auto p-3">
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/reserva"><i class="fas fa-calendar-plus"></i> Nova Reserva</a>
            </li>
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/pessoas"><i class="fas fa-list-alt"></i> Lista de Reservas</a>
            </li>
            <li class="nav-item m-3">
                <a class="nav-link active" href="cadastros/pessoas"><i class="fas fa-map-marker-alt"></i> Locais disponiveis</a>
            </li>
        </ul>
    </div>
</div>