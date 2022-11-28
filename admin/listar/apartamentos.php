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
                    $consulta = $pdo->prepare("select a.ID as id, a.NUMEROAP as apartamento,  b.NOME as bloco, p.nome as morador from  apartamento a  
                    join bloco b  on b.id = a.IDBLOCO join morador m  on m.ID = a.IDMORADOR join pessoa p  on p.ID = m.IDPESSOA");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td><?=$dados->id?></td>
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
    $(".table").dataTable();
</script>