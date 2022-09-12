<?php
    if ( !isset ( $page ) ) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Funcionários</h2>
        <div class="float-right">
            <a href="cadastros/funcionarios" title="Cadastrar Funcionário" class="btn btn-primary">
                Cadastrar Funcionário
            </a>
        </div>
    </div>
    <div class="card-body">

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Funcionário</td>
                    <td>Funcao</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".table").dataTable();
    function excluir(id) {
        Swal.fire({
            title: 'Você deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                location.href='excluir/produtos/'+id;
            } 
        })
    }
</script>