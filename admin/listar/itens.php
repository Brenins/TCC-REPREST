<?php 
    if ( !isset ( $page ) ) exit;

?>


<div class="card">
    <div class="card-header">
        <h2 class="float-left">Balanço de Itens</h2>
        <div class="float-right">
            <a href="cadastros/itens" title="Cadastrar Itens"
            class="btn btn-primary">
                Cadastrar Itens
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Item</td>
                    <td>Disponivel</td>
                    <td>Valor de Custo</td>
                    <td>Categoria do Item</td>
                    <td>Opções</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "select i.id as id, i.nome as item, i.ativo as disponivel, i.vlitem as valor , c.descricao as categoria  from item i inner join categoria c on i.idcategoria  = c.id order by i.id";
                    $consultaProdutos = $pdo->prepare($sql);
                    $consultaProdutos->execute();

                    while ($dadosProdutos = $consultaProdutos->fetch(PDO::FETCH_OBJ)) {

                        $valor = number_format($dadosProdutos->valor, 2, 
                        ",", ".");

                        ?>
                        <tr>
                            <td><?=$dadosProdutos->id?></td>
                            <td><?=$dadosProdutos->item?></td>
                            <td><?=$dadosProdutos->disponivel?></td>
                            <td>R$ <?=$valor?></td>
                            <td><?=$dadosProdutos->categoria?></td>
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