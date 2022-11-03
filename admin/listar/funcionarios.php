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
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select f.id as id, p.nome as nome, fc.nome as funcao from pessoa p join funcionario f on p.id = f.idpessoa join funcao fc on f.idfuncao = fc.id");
                    
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ){
                        ?>
                        <tr>
                            <td><?=$dados->id?></td>
                            <td><?=$dados->nome?></td>
                            <td><?=$dados->funcao?></td>
                        </tr>
                        <?php
                    }

                ?>
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