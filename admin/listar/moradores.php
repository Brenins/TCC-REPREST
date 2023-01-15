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
                            $botao = "fas fa-toggle-off";
                            $cor = "danger";
                        }else{
                            $ativo = "Sim";
                            $botao = "fas fa-toggle-on";
                            $cor = "success";
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
                                    title="Ativar/Desativar" class="btn btn-<?=$cor?>"><i class="<?=$botao?>"></i>
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