<?php
    if ( !isset ( $page ) ) exit; 
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Reservas</h2>
        <div class="float-right">
            <a href="cadastros/reserva" title="Nova Reserva" class="btn btn-primary">
                Nova Reserva
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Descrição</td>
                    <td>Inicio Reserva</td>
                    <td>Fim Reserva</td>
                    <td>Status</td>
                    <td>Reservado para</td>
                    <td>Local Reservado</td>
                    <td>Obs</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select
                        r.id as id ,
                        r.descricao as descricao ,
                        r.dtinicio as inicio ,
                        r.dtfim as fim,
                        s.status as status,
                        l.nome as local,
                        p.nome as morador,
                        r.obs as obs
                    from
                        reserva r
                    join apartamento a on
                        r.idapartamento = a.id
                    join morador m on
                        a.idmorador = m.id
                    join pessoa p on
                        m.idpessoa = p.id
                    join `local` l on
                        r.idlocal = l.id
                    join status s on
                        r.idstatus = s.id
                    order by
                    r.id");
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        $dataInicio = minhaData($dados->inicio);
                        $dataFim = minhaData($dados->fim);
                        ?>
                            <tr>
                                <td width="50px"><?=$dados->id?></td>
                                <td><?=$dados->descricao?></td>
                                <td><?=$dataInicio?></td>
                                <td><?=$dataFim?></td>
                                <td><?=$dados->status?></td>
                                <td><?=$dados->morador?></td>
                                <td><?=$dados->local?></td>
                                <td><?=$dados->obs?></td>
                                <td width="100px" class="text-center">
                                    <a href="cadastros/statusReserva/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                </a>
                                    <!--  <a href="javascript:excluir(PASSAR O ID)" 
                                    title="Excluir" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
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