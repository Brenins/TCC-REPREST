<?php
    if ( !isset ( $page ) ) exit;

    

?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">
            Lista de Cobranças
        </h2>  
        <a href="cadastros/cobranca" class="float-right btn btn-primary">Gerar Cobrança</a>
    </div>
    <div class="card-body">

        <table class="table table-bordered table-hover table-striped ">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Valor</td>
                    <td>Tipo</td>
                    <td>Data de Cobrança</td>
                    <td>Data Atualização</td>
                    <td>Morador</td>
                    <td>Status</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Selecionar todas as categorias
                    
                    $consulta = $pdo->prepare("
                        select
                            c.id,
                            c.valor,
                            c.tipo,
                            c.data_cobranca as dataC,
                            c.data_atualizacao as dataA,
                            c.pix_cc as pix,
                            p.NOME as morador,
                            s.status as status_name,
                            p.telefone as celular
                        from
                            cobranca c
                        left join apartamento a 
                            on c.IDAPARTAMENTO = a.ID 
                        left join morador m
                            on m.ID = a.IDMORADOR 
                        left join status s
                            on s.id = c.idstatus
                        left join pessoa p
                            on p.id = m.IDPESSOA ;
                    ");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        $valor = number_format($dados->valor, 2, 
                        ",", ".");

                        $d1 = minhaData($dados->dataC);
                        $d2 = minhaData($dados->dataA);
                        ?>
                            <tr>
                                <td><?=$dados->id?></td>
                                <td>R$<?=$valor?></td>
                                <td><?=$dados->tipo?></td>
                                <td><?=$d1?></td>
                                <td><?=$d2?></td>
                                <td><?=$dados->morador?></td>
                                <td><?=$dados->status_name?></td>
                                <td class="text-center">
                                    <a href="salvar/reenviar/<?=$dados->id?>"
                                    title="Reenviar Cobrança" class="btn btn-success"><i class="fas fa-paper-plane"></i>
                                    </a>
                                    <a href="cadastros/statusCobranca/<?=$dados->id?>" 
                                    title="Alterar Status de Cobranca" class="btn btn-primary"><i class="fas fa-edit"></i>
                                    </a>
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