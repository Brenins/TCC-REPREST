<?php
    if ( !isset ( $page ) ) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Funcionários</h2>
        <div class="float-right">
            <ul class="nav nav-pills">
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown" data-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-bars"></i>  Menu</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastros/funcionario">Cadastrar Funcionário</a>
                        <a class="dropdown-item" href="cadastros/funcao">Cadastro de Função</a>
                        <a class="dropdown-item" href="cadastros/usuarios">Definir Login de Funcionário</a>
                    </div>
                </li>
            </ul>
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
                        }else{
                            $ativo = "Sim";
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