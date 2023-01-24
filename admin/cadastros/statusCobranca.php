<?php
    if(!isset($page)) exit;
    foreach($_POST as $key => $value){
        $$key = trim ($value ?? NULL);
    }
    $sql = "select idstatus from cobranca where id = :id limit 1";
    $consulta = $pdo->prepare($sql);
    $consulta->bindParam(":id", $id);
    $consulta->execute();
    $dados = $consulta->fetch(PDO::FETCH_OBJ);

    if($dados->idstatus == 2){
        mensagemErro("Não é possível alterar registros finalizados.");
    }
?>
<div class="card shadow">
    <div class="card-header">
        <h2 class="float-left">
            Atualizar Status de Cobrança
        </h2>
    </div>
    <div class="card-body">
        <form name="formCadastro" method="post" action="salvar/statusCobranca" data-parsley-validate="">
        <input type="hidden" readonly name="idcobranca" id="idcobranca" class="form-control" value="<?=$id?>">
            <label for="status">Selecione o status:</label>
            <select name="status" id="status" required data-parsley-required-message="Selecione o status." 
                class="form-control">
                    <option value=""></option>
                    <?php
                        $sql= "select id, status from status order by id";
                        $consulta = $pdo->prepare($sql);
                        $consulta->execute();
                        while ($dados = $consulta->fetch(PDO::FETCH_OBJ)){
                            //Separar dados
                            $id = $dados->id;
                            $nome = $dados->status;
                            echo "<option value='{$id}'>$nome</option>";
                        }
                    ?>
                >
            </select>
            <br>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-check"></i> Salvar
            </button>
        </form>
    </div>
</div>