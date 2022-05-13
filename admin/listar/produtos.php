<?php
    if ( !isset ( $page ) ) exit;
?>
<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Listar Produtos</h2>
        <div class="float-right">
            <a href="cadastros/produtos" title="Cadastrar Novo Produto" class="btn btn-primary">
                Cadastrar Produto
            </a>
        </div>
    </div>
    <div class="card-body">

        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nome do Produto</td>
                    <td>Categoria</td>
                    <td>Valor</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "select p.id, p.nome, c.nome categoria, p.valor
                    from produto p 
                    inner join categoria c on 
                    (c.id = p.categoria_id)
                    order by p.nome";
                    $consultaProdutos = $pdo->prepare($sql);
                    $consultaProdutos->execute();

                    while ($dadosProdutos = $consultaProdutos->fetch(PDO::FETCH_OBJ)) {

                        $valor = number_format($dadosProdutos->valor, 2, 
                        ",", ".");

                        ?>
                        <tr>
                            <td><?=$dadosProdutos->id?></td>
                            <td><?=$dadosProdutos->nome?></td>
                            <td><?=$dadosProdutos->categoria?></td>
                            <td>R$ <?=$valor?></td>
                            <td>
                                <a href="cadastros/produtos/<?=$dadosProdutos->id?>"
                                class="btn btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:excluir(<?=$dadosProdutos->id?>)" class="btn btn-danger">
                                    <i class="fas fa-trash"></i>
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
    $(".table").dataTable();
    function excluir(id) {
        Swal.fire({
            title: 'Você deseja realmente excluir este item?',
            showCancelButton: true,
            confirmButtonText: 'Excluir',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                location.href='excluir/produtos/'+id;
            } 
        })
    }
</script>