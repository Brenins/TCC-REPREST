<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Moradores</h2>
        <div class="float-right">
            <a href="cadastros/morador" title="Cadastrar Novo Morador" class="btn btn-primary">
                Cadastrar Morador
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
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    
                    $consulta = $pdo->prepare("select m.id as id, p.nome as morador, m.criado as criado, 
                    m.modificado as modificado, m.ativo as ativo from morador m inner join pessoa p on m.idpessoa = p.id order by morador;");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {

                        if($dados->ativo == "N"){
                            $ativo = "Não";
                        }else{
                            $ativo = "Sim";
                        }

                        ?>
                            <tr>
                                <td width="70px"><?=$dados->id?></td>
                                <td><?=$dados->morador?></td>
                                <td><?=$dados->criado?></td>
                                <td><?=$dados->modificado?></td>
                                <td><?=$ativo?></td>
                                <td class="text-center">
                                    <a href="cadastros/pessoas/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                    </a>
                                    <a href="salvar/ativarMorador/<?=$dados->id?>" 
                                    title="Ativar/Desativar" class="btn btn-primary"><i class="fas fa-power-off"></i>
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
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
        },
    });
</script>