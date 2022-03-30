<?php
    if(!isset($page))exit;
?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Listar Categorias</h2>
        <div class="float-right">
            <a href="cadastros/categorias" title="Cadastrar Nova Categoria"
            class="btn btn-primary">
                Cadastrar Categoria
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome da Categoria</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Selecionar todas as categorias
                    
                    $consulta = $pdo->prepare("select * from categoria order by id");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        ?>
                            <tr>
                                <td width="70px"><?=$dados->id?></td>
                                <td><?=$dados->nome?></td>
                                <td width="100px">
                                    <a href="cadastros/categorias/<?=$dados->id?>" 
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
            location.href='excluir/categoria/'+id;
        }
        })
    }
</script>