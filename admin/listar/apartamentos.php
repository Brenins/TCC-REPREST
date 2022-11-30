<?php
    if(!isset($page)) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Apartamentos</h2>
        <div class="float-right">
            <ul class="nav nav-pills w-auto p-3 ">
                <li class="nav-item dropdown m-3">
                    <a class="nav-link active dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i> Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/blocos">Cadastrar blocos habitacionais</a>
                        <a class="dropdown-item" href="cadastros/apartamentos">Cadastrar apartamento</a>
                        <a class="dropdown-item" href="cadastros/lazer">Cadastrar area de lazer</a>
                        <a class="dropdown-item" href="listar/blocos">Listar blocos habitacionais</a>
                        <a class="dropdown-item" href="listar/apartamentos">Listar apartamentos</a>
                        <a class="dropdown-item" href="listar/lazer">Listar areas de lazer</a>

                    </div>
                </li>
            </ul>
        </div>
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
    $(".table").dataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
        },
    });
</script>