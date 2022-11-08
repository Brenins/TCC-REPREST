<?php


?>



<div class="card">
    <div class="card-header">
        <h2 class="float-left">Cadastrar Morador</h2>
        <div class="float-right">
            <a href="listar/moradores" 
            title="Listar Moradores" 
            class="btn btn-primary">Listar Moradores</a>
        </div>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/moradores" data-parsley-valdiate="">
            <input type="hidden" readonly name="id" id="id" class="form-control" value="<?=$id?>">

            <label for="morador">Selecione uma pessoa para cadastrar como morador:</label>
            <select name="morador" id="morador" required data-parsley-required-message="Selecione uma categoria." 
            class="form-control">
                <option value=""></option>
                <?php
                    $sql= "select id, nome from pessoa order by nome";
                    $consultaCategoria = $pdo->prepare($sql);
                    $consultaCategoria->execute();

                    while ($dadosCategoria = $consultaCategoria->fetch(PDO::FETCH_OBJ)){
                        //Separar dados
                        $id = $dadosCategoria->id;
                        $nome = $dadosCategoria->nome;

                        echo "<option value='{$id}'>{$nome}</option>";
                    }
                ?>
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>