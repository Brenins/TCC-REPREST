<?php
    if(!isset($page)) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Apartamentos</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Apartamento</td>
                    <td>Bloco</td>
                    <td>Morador</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select
                        a.id as id,
                        a.numeroap as apartamento,
                        b.nome as bloco,
                        p.nome as morador
                    from
                        apartamento a
                    join bloco b on
                        a.idbloco = b.id
                    left join morador m on
                        a.idmorador = m.id
                    left join pessoa p on
                        m.idpessoa = p.id");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td width="15px"><?=$dados->id?></td>
                            <td><?=$dados->apartamento?></td>
                            <td><?=$dados->bloco?></td>
                            <td><?=$dados->morador?></td>
                            <td width="200px" class="text-center">
                                <a href="cadastros/vinculoMoradores/<?=$dados->id?>" title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>Alterar Morador</a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(".table").dataTable({
        language: {
            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "loadingRecords": "Carregando...",
            "zeroRecords": "Nenhum registro encontrado",
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "lengthMenu": "Exibir _MENU_ resultados por página",
            "infoEmpty": "Mostrando 0 até 0 de 0 registro(s)",
        },
    });
</script>