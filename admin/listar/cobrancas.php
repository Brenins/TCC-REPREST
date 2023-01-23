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
                    <td>Apartamento</td>
                    <td>Status</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Selecionar todas as categorias
                    
                    $consulta = $pdo->prepare("select id, valor, tipo, data_cobranca as dataC, data_atualizacao as dataA, pix_cc as pix, idapartamento as apartamento, idstatus as status 
                    from tcc.cobranca");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        $valor = number_format($dados->valor, 2, 
                        ",", ".");
                        ?>
                            <tr>
                                <td><?=$dados->id?></td>
                                <td>R$<?=$valor?></td>
                                <td><?=$dados->tipo?></td>
                                <td><?=$dados->dataC?></td>
                                <td><?=$dados->dataA?></td>
                                <td><?=$dados->apartamento?></td>
                                <td><?=$dados->status?></td>
                                <td class="text-center">
                                    <a href="cadastros/categorias/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                    </a>
                                    <a href="cadastros/categorias/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-primary"><i class="fas fa-edit"></i>
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