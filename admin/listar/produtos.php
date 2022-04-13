<?php
    if(!isset($page))exit;
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Listar Produtos</h2>
        <div class="float-right">
            <a href="cadastros/produtos" title="Cadastrar Novo Produto" 
            class="btn btn-primary">Listar Produtos</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Protudo</td>
                    <td>Categoria</td>
                    <td>Valor</td>
                    <td>Opções</td>
                </tr>
            </thead>
        </table>
    </div>
</div>