<?php
    if ( !isset ( $page ) ) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Funcionários</h2>
        <div class="float-right">
            <a href="cadastros/funcionario" 
            title="Cadastrar Funcionário" 
            class="btn btn-primary">Cadastrar Funcionário</a>
        </div>
    </div>
    <div class="card-body">

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Funcionário</td>
                    <td>Funcao</td>
                    <td>Ativo</td>
                    <td>Criado</td>
                    <td>Modificado</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select f.id as id, p.nome as nome, fc.nome as funcao, f.ativo as ativo, f.criado as criado, f.modificado as modificado from pessoa p 
                    join funcionario f on p.id = f.idpessoa join funcao fc on f.idfuncao = fc.id");
                    
                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ){
                        if($dados->ativo == "N"){
                            $ativo = "Não";
                            $cor ="danger";
                            $botao = "fa fa-toggle-off";
                        }else{
                            $ativo = "Sim";
                            $cor = "success";
                            $botao = "fa fa-toggle-on";
                        }
                        ?>
                        <tr>
                            <td><?=$dados->id?></td>
                            <td><?=$dados->nome?></td>
                            <td><?=$dados->funcao?></td>
                            <td><?=$ativo?></td>
                            <td><?=$dados->criado?></td>
                            <td><?=$dados->modificado?></td>
                            <td class="text-center">
                                <a href="salvar/ativarFuncionario/<?=$dados->id?>" 
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