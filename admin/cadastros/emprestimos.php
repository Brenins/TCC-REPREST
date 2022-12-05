<?php 
    //se n existir variavel page
    if(!isset($page)) exit;
?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">Novo empréstimo</h2>
    </div>
    <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/emprestimos" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">
            
            <label for="item">Selecione o item para empréstimo:</label>
            <select name="item" id="item" required data-parsley-required-message="Selecione um item" 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select i.id as id, i.nome as nome from item i order by ID";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dados->id;
                        $nome = $dados->nome;
                        echo "<option value='{$id}'>$nome</option>";
                    }
                ?>
            </select>

            <label for="retirada">Data de Retirada:</label>
            <input type="date" name="retirada" id="retirada"
            class="form-control" required
            data-parsley-required-message="Data de retirada obrigatória."
            value="<?=$retirada?>">

            <label for="devolucao">Data de devolucao:</label>
            <input type="date" name="devolucao" id="devolucao"
            class="form-control" required
            data-parsley-required-message="Data de devolucao obrigatória."
            value="<?=$devolucao?>">
           
            <label for="apartamento">Selecione o morador:</label>
            <select name="apartamento" id="apartamento" required data-parsley-required-message="Selecione um morador" 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select a.id as id , a.numeroap as apartamento , p.nome as morador  
                    from apartamento a left join morador m on a.idmorador = m.id 
                    left join pessoa p on m.idpessoa = p.id ";
                    $consulta = $pdo->prepare($sql);
                    $consulta->execute();

                    while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dados->id;
                        $apartamento = $dados->apartamento;
                        $morador = $dados->morador;

                        echo "<option value='{$id}'>$morador - Apartamento: $apartamento</option>";
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