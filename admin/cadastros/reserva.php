<?php
    if ( !isset ( $page ) ) exit;
?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">
            Nova reserva
        </h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/reserva" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="descricao">Descrição do evento:</label>
            <input type="text" name="descricao" id="descricao"
            class="form-control" required
            data-parsley-required-message="Preencha este campo"
            value="<?=@$descricao?>">

            <label for="dtInicio">Inicio do evento:</label>
            <input type="date" name="dtInicio" id="dtInicio"
            class="form-control" required
            data-parsley-required-message="Data de inicio obrigatória."
            value="<?=$dtinicio?>">

            <label for="dtFim">Fim do evento:</label>
            <input type="date" name="dtFim" id="dtFim"
            class="form-control" required
            data-parsley-required-message="Data de fim obrigatória."
            value="<?=$dtfim?>">

            <label for="apartamento">Selecione o morador:</label>
            <select name="apartamento" id="apartamento" required data-parsley-required-message="Selecione um morador" 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "
                        select
                            a.id as id ,
                            a.numeroap as apartamento ,
                            b.nome as bloco,
                            p.nome as morador
                        from
                            apartamento a
                        left join bloco b 
                            on a.idbloco = b.id 
                        left join morador m on
                            a.idmorador = m.id
                        left join pessoa p on
                            m.idpessoa = p.id
                    ";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dados->id;
                        $apartamento = $dados->apartamento;
                        $morador = $dados->morador;
                        $bloco = $dados->bloco;

                        echo "<option value='{$id}'>$morador - Apartamento: $apartamento - Bloco: $bloco</option>";
                    }
                ?>
            </select>
            
            <label for="local">Selecione o local de lazer para reserva:</label>
            <select name="local" id="local" required data-parsley-required-message="Selecione um local" 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, nome from `local` l order by id";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dados->id;
                        $nome = $dados->nome;

                        echo "<option value='{$id}'>{$nome}</option>";
                    }
                ?>
            </select>

            <label for="obs">Observações:</label>
            <input type="text" name="obs" id="obs"
            class="form-control"
            value="<?=@$obs?>">

            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>