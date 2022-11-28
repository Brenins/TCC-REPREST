<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Configuração de Taxas</h2>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Tipo de Taxa</td>
                    <td>Valor</td>
                    <td>Opção</td>
                </tr>
            </thead>
            <tbody>
            <?php
                $consulta = $pdo->prepare("select id, descricao,valor from taxa order by id");
                $consulta->execute();
                while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                        ) {
                            ?>
                                <tr>
                                    <td><?=$dados->id?></td>
                                    <td><?=$dados->descricao?></td>
                                    <td><?=$dados->valor?></td>
                                    <td class="text-center" width="220px">
                                        <a href="cadastros/taxa/<?=$dados->id?>" 
                                        title="Editar" 
                                        class="btn btn-warning"><i class="fas fa-edit"></i>
                                        Alterar Taxa
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