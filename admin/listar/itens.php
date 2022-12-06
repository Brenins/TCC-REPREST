<?php 
    if ( !isset ( $page ) ) exit;
    $disponivel = $cor = null;
?>


<div class="card shadow-lg">
    <div class="card-header">
        <h2 class="float-left">Lista de Itens</h2>
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

                        if($dadosProdutos->disponivel == "N"){
                            $disponivel = "Não";
                            $cor = 'secondary';
                            $switch = 'fa-toggle-off';
                        }elseif($dadosProdutos->disponivel == "S"){
                            $disponivel = "Sim";
                            $cor = 'success';
                            $switch = 'fa-toggle-on';
                        }
                        ?>
                        <tr>
                            <td><?=$dadosProdutos->id?></td>
                            <td><?=$dadosProdutos->item?></td>
                            <td><?=$disponivel?></td>
                            <td>R$ <?=$valor?></td>
                            <td><?=$dadosProdutos->categoria?></td>
                            <td class="text-center">
                                <a href="cadastros/itens/<?=$dadosProdutos->id?>"
                                class="btn btn-warning" title="Editar Item">
                                <i class="fas fa-edit"></i></a>

                                <a href="salvar/disponibilidadeItem/<?=$dadosProdutos->id?>"
                                class="btn btn-<?=$cor?>">
                                <i class="fas <?=$switch?>" title="Ativar/Desativar"></i>
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