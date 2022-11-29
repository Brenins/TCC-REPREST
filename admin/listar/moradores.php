<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Moradores</h2>
        <div class="float-right">
            <a href="cadastros/usuarios" title="Cadastrar Novo Usuário" class="btn btn-primary">
                Cadastrar Usuário
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Morador</td>
                    <td>Criado</td>
                    <td>Modificado</td>
                    <td>Ativo</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    $consulta = $pdo->prepare("select p.id as id, p.nome as morador, m.criado as criado, 
                    m.modificado as modificado, m.ativo as ativo from morador m inner join pessoa p on m.idpessoa = p.id order by id;");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        ?>
                            <tr>
                                <td width="70px"><?=$dados->id?></td>
                                <td><?=$dados->morador?></td>
                                <td><?=$dados->criado?></td>
                                <td><?=$dados->modificado?></td>
                                <td><?=$dados->ativo?></td>
                                <!-- <td width="100px">
                                    <a href="cadastros/pessoas/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                    </a>
                                     <a href="javascript:excluir(PASSAR O ID)" 
                                    title="Excluir" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                </td> -->
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