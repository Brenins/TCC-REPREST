<?php
    if (!isset($page))exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Usuários</h2>
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
                    <td>Login</td>
                    <td>Funcionário</td>
                    <td>Ativo</td>
                    <td>Criado Por</td>
                    <td>Modificado Por</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select f.id as id, f.login as login, p.nome as funcionario, f.ativo as ativo, f.criado as criado, f.modificado as modificado  from funcionario f join pessoa p on f.idpessoa = p.id  order by id");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td width="20px"><?=$dados->id?></td>
                            <td width="120px"><?=$dados->login?></td>
                            <td width="120px"><?=$dados->funcionario?></td>
                            <td width="15px"><?=$dados->ativo?></td>
                            <td width="120px"><?=$dados->criado?></td>
                            <td width="120px"><?=$dados->modificado?></td>
                            <td width="200px">
                            <a href="cadastros/usuarios/<?=$dados->id?>" 
                            title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>Editar</a>
                            <a href="cadastros/habilitar/<?=$dados->id?>"class="btn btn-danger"><i class="fas fa-toggle-on"></i>Ativar</a>
                            </td>
                        </tr>
                        <?php
                    }
                ?>
            </tdbody>
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