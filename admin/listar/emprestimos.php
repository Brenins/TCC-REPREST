<?php
    if ( !isset ( $page ) ) exit; 
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Emprestimos</h2>
        <div class="float-right">
            <a href="cadastros/reserva" title="Novo Empréstimo" class="btn btn-primary">
                Nova Empréstimo
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Retirada</td>
                    <td>Devolução</td>
                    <td>Item</td>
                    <td>Status</td>
                    <td>Reservado para:</td>
                    <td>Obs</td>
                    <td>Criado</td>
                    <td>Modificado</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select
                        e.id as id,
                        e.dtemprestimo as retirada,
                        e.dtdevolucao as devolucao,
                        e.obs as obs,
                        i.nome as item,
                        e.criado as criado,
                        e.modificado as modificado,
                        p.nome as morador,
                        s.status as status
                    from
                        emprestimo e
                    join item i on
                        e.iditem = i.id
                    join status s on
                        e.idstatus = s.id
                    join apartamento a on
                        e.idapartamento = a.id
                    join morador m on
                        a.idmorador = m.id
                    join pessoa p on
                        m.idpessoa = p.id");
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        $retir = minhaData($dados->retirada);
                        $devol = minhaData($dados->devolucao);
                        ?>
                            <tr>
                                <td width="50px"><?=$dados->id?></td>
                                <td><?=$retir?></td>
                                <td><?=$devol?></td>
                                <td><?=$dados->item?></td>
                                <td><?=$dados->status?></td>
                                <td><?=$dados->morador?></td>
                                <td><?=$dados->obs?></td>
                                <td><?=$dados->criado?></td>
                                <td><?=$dados->modificado?></td>
                                <td width="100px" class="text-center">
                                    <a href="cadastros/emprestimos/<?=$dados->id?>" 
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
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
        },
    });
</script>