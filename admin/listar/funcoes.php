<?php
    if(!isset($page))exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Funcoes</h2>
        <div class="float-right">
            <a href="cadastros/funcao" title="Cadastrar Nova função"
            class="btn btn-primary">
                Cadastrar Função
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome da Função</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Selecionar todas as categorias
                    
                    $consulta = $pdo->prepare("select id, nome from funcao order by id");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        ?>
                            <tr>
                                <td width="70px"><?=$dados->id?></td>
                                <td><?=$dados->nome?></td>
                                <td width="100px">
                                    <a href="cadastros/funcao/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:excluir(<?=$dados->id?>)" 
                                    title="Excluir" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
    $(".table").dataTable();
    function excluir(id){
        Swal.fire({
            title: 'Voce deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed){
            location.href='excluir/funcao/'+id;
        }
        })
    }
</script>