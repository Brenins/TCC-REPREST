<?php
    if(!isset($page)) exit;

?>

<div class="card">
    <div class="card-header">
        <h2 class="float-left">Gerar Cobranca</h2>
    </div>
    <div class="card-body">
    <form name="formCadastro" method="post" action="salvar/cobranca" data-parsley-validate="">
            <input type="hidden" readonly name="id" id="id"
            class="form-control" value="<?=$id?>">

            <label for="idApartamento">Selecione o apartamento:</label>
            <select name="idApartamento" id="idApartamento" required data-parsley-required-message="Selecione um apartamento." 
                class="form-control">
                    <option value=""></option>
                    <?php

                        if(!empty($id)){
                            $sql = "select a.ID as id, a.NUMEROAP as apartamento, 
                            b.NOME as bloco from apartamento a 
                            join bloco b on b.id = a.IDBLOCO where a.id = :id
                            limit 1";
                            $consulta = $pdo->prepare($sql);
                            $consulta->bindParam(":id",$id);
                        }else{
                            $sql= "select a.ID as id, a.NUMEROAP as apartamento, 
                            b.NOME as bloco from apartamento a 
                            join bloco b on b.id = a.IDBLOCO
                            order by b.nome, a.NUMEROAP";
                            $consulta = $pdo->prepare($sql);
                        }
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dados->id;
                            $ap = $dados->apartamento;
                            $bloco = $dados->bloco;
                            echo "<option value='{$id}'>$ap - $bloco</option>";
                        }
                    ?>
                >
            </select>

            <label for="tipo">Tipo de Cobrança:</label>
            <select name="tipo" id="tipo" required data-parsley-required-message="Selecione o tipo de cobrança." 
                class="form-control">
                    <option value="1">Taxa de Limpeza</option>
                    <option value="2">Multa por perda de item</option>
                    <option value="3">Multa por atraso de devolucão</option>
                >
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>