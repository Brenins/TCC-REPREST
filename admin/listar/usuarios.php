<?php
    if (!isset($page))exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Usuarios</h2>
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
                    <td>Ativo</td>
                    <td>Criado Por</td>
                    <td>Modificado Por</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select id, login, ativo, criado, modificado from funcionario order by id");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td width="20px"><?=$dados->id?></td>
                            <td width="200px"><?=$dados->login?></td>
                            <td width="20px"><?=$dados->ativo?></td>
                            <td width="200px"><?=$dados->criado?></td>
                            <td width="200px"><?=$dados->modificado?></td>
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
    $(".table").dataTable();
</script>