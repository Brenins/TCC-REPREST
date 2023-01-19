<?php
    if (!isset($page))exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de blocos habitacionais</h2>
        <div class="float-right">
            </ul>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Sigla</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select id, nome, sigla from bloco order by id");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td width="30px"><?=$dados->id?></td>
                            <td><?=$dados->nome?></td>
                            <td><?=$dados->sigla?></td>
                            <td width="200px"   class="text-center">
                                <a href="cadastros/blocos/<?=$dados->id?>" title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>Editar</a>
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