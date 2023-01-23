<?php
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }

?>

<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">
            Gerar cobrança
        </h2>
    </div>
    <div class="card-body">
            <form name="formCadastro" method="post" action="salvar/cobranca" data-parsley-valdiate="">
                <label for="idmorador">Selecione o morador para cobrança:</label>
                <select name="idmorador" id="idmorador" required data-parsley-required-message="Selecione uma categoria." 
                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select m.id as idmorador, p.nome , p.telefone  from apartamento a join morador m on a.IDMORADOR = m.ID join pessoa p on m.idpessoa = p.id where m.ativo = 's'";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();

                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dados->idmorador;
                            $nome = $dados->nome;
                            $cell = $dados->telefone;
                            
                            echo "<option value='{$id}'>{$nome} - {$cell}</option>";
                        }         
                    ?>
                    <input type="hidden" readonly name="cell" id="cell" class="form-control" value="<?=$cell?>">
                </select>
                <label for="valor">Qual o valor da cobrança ?</label>
                <input type="text" name="valor" id="valor" class="form-control" onkeypress="$(this).mask('#.##0,00', {reverse: true});">
                <label for="tipo">Selecione o tipo da cobrança:</label>
                <select name="tipo" id="tipo" required data-parsley-required-message="Selecione o tipo de cobrança." 
                class="form-control">
                    <option value="Multa">Multa</option>
                    <option value="Taxa de Limpeza">Taxa de Limpeza</option>
                    <option value="Outros">Outros</option>
                </select>


                <br>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Salvar
                </button>
            </form>
    </div>
</div>