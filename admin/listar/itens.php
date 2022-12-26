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
        <p>
            <a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Ajuda <i class="fas fa-question-circle"></i>
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="alert alert-info shadow">
                <button type="button" class="btn btn-warning"><i class="fas fa-edit"></i></button> <b>Edita as informações sobre os items.</b>  
                <hr>
                <button type="button" class="btn btn-secondary"><i class="fas fa-toggle-off"></i></button> <button type="button" class="btn btn-success"><i class="fas fa-toggle-on"></i></button> 
                    <b>
                        Ativa e desativa o item
                    </b>
            </div>
        </div>

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
                    $sql = "select i.id as id, i.nome as item, i.ativo as disponivel, i.vlitem as valor , c.descricao as categoria  from item i inner join categoria c on i.idcategoria  = c.id order by id";
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
            "emptyTable": "Nenhum registro encontrado",
            "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "infoFiltered": "(Filtrados de _MAX_ registros)",
            "loadingRecords": "Carregando...",
            "zeroRecords": "Nenhum registro encontrado",
            "search": "Pesquisar",
            "paginate": {
                "next": "Próximo",
                "previous": "Anterior",
                "first": "Primeiro",
                "last": "Último"
            },
            "lengthMenu": "Exibir _MENU_ resultados por página",
            "infoEmpty": "Mostrando 0 até 0 de 0 registro(s)",
        },
        
    });
</script>