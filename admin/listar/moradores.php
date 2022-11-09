<div class="card">
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
                    <td>ID</td>
                    <td>Nome</td>
                    <td>Criado</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    $consulta = $pdo->prepare("select p.id as id, p.nome as nome, m.criado as criado from morador m inner join pessoa p on m.IDPESSOA = p.ID order by id;");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        ?>
                            <tr>
                                <td width="70px"><?=$dados->id?></td>
                                <td><?=$dados->nome?></td>
                                <td><?=$dados->criado?></td>
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