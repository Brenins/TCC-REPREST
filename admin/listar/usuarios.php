<?php
    if (!isset($page))exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Usuarios</h2>
        <div class="float-right">
            <a href="cadastros/produtos" title="Cadastrar Novo Produto" class="btn btn-primary">
                Cadastrar Usuario
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>E-mail</td>
                    <td>Login</td>
                    <td>Ativo</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $consulta = $pdo->prepare("select * from usuario order by id");
                    $consulta->execute();
                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        ?>
                        <tr>
                            <td width="70px"><?=$dados->id?></td>
                            <td><?=$dados->nome?></td>
                            <td><?=$dados->email?></td>
                            <td><?=$dados->login?></td>
                            <td><?=$dados->ativo?></td>
                            <td width="220px">
                            <a href="cadastros/usuarios/<?=$dados->id?>" 
                            title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                            </a>
                            <a title="Ativar" class="btn btn-danger"><i class="fas fa-toggle-on"></i> Ativo/Inativo</a>
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