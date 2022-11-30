<?php
    if(!isset($page))exit;
?>

<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Pessoas</h2>
        <div class="float-right">
            <a href="cadastros/pessoas" title="Cadastrar Pessoas"
            class="btn btn-primary">
                Cadastrar Pessoas
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nome Completo</td>
                    <td>CPF</td>
                    <td>RG</td>
                    <td>Data de Nascimento</td>
                    <td>N° Celular</td>
                    <td>Criado Por</td>
                    <td>Modificado Por</td>
                    <td>Opções</td>
                </tr>
            </thead>

            <tbody>
                <?php
                    //Selecionar todas as categorias
                    
                    $consulta = $pdo->prepare("select id, nome, cpf, rg, dtnascimento, telefone, criado, modificado from pessoa order by id;");

                    $consulta->execute();

                    while($dados = $consulta->fetch(PDO::FETCH_OBJ)
                    ) {
                        $testeData = minhaData($dados->dtnascimento);
                        ?>
                            <tr>
                                <td width="30px"><?=$dados->id?></td>
                                <td><?=$dados->nome?></td>
                                <td data-inputmask="'mask': '999.999.999-99'"><?=$dados->cpf?></td>
                                <td ><?=$dados->rg?></td>
                                <td><?=$testeData?></td>
                                <td data-inputmask="'mask': '(99)99999-9999'"><?=$dados->telefone?></td>
                                <td><?=$dados->criado?></td>
                                <td><?=$dados->modificado?></td>
                                <td width="90px">
                                    <a href="cadastros/pessoas/<?=$dados->id?>" 
                                    title="Editar" class="btn btn-warning"><i class="fas fa-edit"></i>
                                    </a>
                                    <!-- <a href="javascript:excluir(PASSAR O ID)" 
                                    title="Excluir" class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
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
    function excluir(id){
        Swal.fire({
            title: 'Voce deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed){
            location.href='excluir/categorias/'+id;
        }
        })
    }
</script>